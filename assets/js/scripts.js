;(function ($, window, document, undefined) {
	"use strict";
	
	// CBD Conversion
	$('form.cbd-conversion input').on('change keyup', function(){
		var bottle = parseInt( $('.js-cbd-bottle').val() ),
			bottle_amount = parseInt( $('.js-cbd-bottle-amount').val() ),
			take = parseInt( $('.js-cbd-take').val() );

		if ( isNaN( bottle ) || isNaN( bottle_amount ) || isNaN( take ) ) {
			return;
		}

		var result_desire = bottle / bottle_amount * 20 * take;

		$('.cbd-result-desire-amount').text( parseInt( result_desire ) );
		$('.cbd-result-milliliters').text( parseInt( result_desire / 20 ) );
	});


	// CBD Dosage
	function cbd_dosage_calculation() {
		var weight,
			purpose,
			step3 = 0,
			severity = 1,
			weight_unit = $('.cbd-dosage').attr('data-weight');

		if ( $('.js-cbd-type').find('option:selected').attr('data-value') == 'human' ) {
			weight = parseInt( $('.js-cbd-weight').val() );
			purpose = parseFloat( $('.js-cbd-purpose').find('option:selected').attr('data-value') );
			if ( ! $('.js-cbd-purpose').find('option:first-child').is(':selected') ) {
				severity = parseFloat( $('.js-cbd-severity').find('option:selected').attr('data-value') );
			}
		} else {
			weight = parseInt( $('.js-cbd-pets-weight').val() );
			purpose = parseFloat( $('.js-cbd-pets-purpose').find('option:selected').attr('data-value') );
			if ( ! $('.js-cbd-pets-purpose').find('option:first-child').is(':selected') ) {
				severity = parseFloat( $('.js-cbd-pets-severity').find('option:selected').attr('data-value') );
			}
		}

		if ( isNaN( weight ) ) {
			return;
		}

		weight = weight_unit != 'kg' ? weight * 0.45359237 : weight;
		//0.45359237

		$('.js-cbd-email-option-row, .js-cbd-email-row').show();

		step3 = weight * 2.20462262 * purpose * severity;

		$('.cbd-result-step-1').text( Math.round( step3 * .33 ) );
		$('.cbd-result-step-2').text( Math.round( step3 * .66 ) );
		$('.cbd-result-step-3').text( Math.round( step3 ) );
	}

	$('.cbd-dosage .js-cbd-type').on('change', function() {

		$('.js-cbd-purpose').val($('.js-cbd-purpose option:first').val());
		$('.js-cbd-pets-purpose').val($('.js-cbd-pets-purpose option:first').val());

		if ( $(this).find('option:selected').attr('data-value') == 'human' ) {
			$('.js-cbd-pets-purpose-row').hide();
			$('.js-cbd-pets-weight-row').hide();
			$('.js-cbd-pets-severity-row').hide();

			$('.js-cbd-purpose-row').show();
			$('.js-cbd-weight-row').show();
		} else {
			$('.js-cbd-pets-purpose-row').show();
			$('.js-cbd-pets-weight-row').show();

			$('.js-cbd-purpose-row').hide();
			$('.js-cbd-weight-row').hide();
			$('.js-cbd-severity-row').hide();
		}
		cbd_dosage_calculation();
	});

	$('.cbd-dosage .js-cbd-purpose').on('change', function(){
		if ( $(this).find('option:first-child').is(':selected') ) {
			$('.js-cbd-severity-row').hide();
		} else {
			$('.js-cbd-severity-row').show();
		}
		cbd_dosage_calculation();
	});

	$('.cbd-dosage .js-cbd-pets-purpose').on('change', function(){
		if ( $(this).find('option:first-child').is(':selected') ) {
			$('.js-cbd-pets-severity-row').hide();
		} else {
			$('.js-cbd-pets-severity-row').show();
		}
		cbd_dosage_calculation();
	});

	$('.cbd-dosage input').on('change keyup', function(){
		cbd_dosage_calculation();
	});

	$('.js-cbd-pets-severity, .js-cbd-severity').on('change', function(){
		cbd_dosage_calculation();
	});

	$('.js-cbd-email').on('change', function(){
		var choice = $(this).val();
		if ( choice == 'yes' ) {
			$('.js-cbd-email-row').show();
		} else {
			$('.js-cbd-email-row').hide();
		}
	});


	$('.js-cbd-email-button').on('click', function(){
		var email = $('.js-cbd-email-input').val(),
			button = $(this),
			regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/,
			severity = 1, 
			severity_text = '',
			form = button.closest('form');

		if ( form.find('option:selected').attr('data-value') == 'human' && ! form.find('.js-cbd-purpose').find('option:first-child').is(':selected') ) {
			severity = form.find('.js-cbd-severity').find('option:selected').attr('data-value');
			severity_text = form.find('.js-cbd-severity').find('option:selected').val();
		}

		if ( form.find('option:selected').attr('data-value') != 'human' && ! form.find('.js-cbd-pets-purpose').find('option:first-child').is(':selected') ) {
			severity: form.find('.js-cbd-pets-severity').find('option:selected').attr('data-value');
			severity_text: form.find('.js-cbd-pets-severity').find('option:selected').val();
		}

		button.text(cbd_calc.sending);

		if ( email.length && regex.test( email ) ) {

			var data = {
				email: email,
				type: $('.js-cbd-type').find('option:selected').attr('data-value'),
				purpose: $('.js-cbd-purpose').find('option:selected').attr('data-value'),
				purpose_text: $('.js-cbd-purpose').find('option:selected').val(),
				pets_purpose: $('.js-cbd-pets-purpose').find('option:selected').attr('data-value'),
				pets_purpose_text: $('.js-cbd-pets-purpose').find('option:selected').val(),
				severity: severity,
				severity_text: severity_text,
				weight: $('.js-cbd-weight').val(),
				pets_weight: $('.js-cbd-pets-weight').val()
			};			
			
			$.ajax({
				type: "POST",
				url: cbd_calc.ajaxurl,
				data: ({
					action: 'cbd_calc_send_email',
					form_data: data
				}),
				success: function( data ) {
					button.text(cbd_calc.sent);
				}
			});
		} else {
			button.text(cbd_calc.incorrect_email);
		}

		return false;
	});
	
	$('.cbd-dosage').on('submit', function(){
		return false;
	});

})(jQuery, window, document);