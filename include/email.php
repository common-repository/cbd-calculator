<?php

if ( ! function_exists( 'cbd_calc_email_fields' ) ) {
	function cbd_calc_email_fields() {
		$options = get_option( 'cbd_plugin' );
		$language = isset( $options['language'] ) ? $options['language'] : 'en';
		$email_option = isset( $options['email_option'] ) ? $options['email_option'] : 'enable';

		if ( $email_option == 'enable' ) {
			if ( $language == 'en' ) {
				?>
				<div class="cbd-row cbd-hide js-cbd-email-option-row">
					<div class="cbd-cell">
						<label><?php esc_html_e( 'Would you like to receive your dosage recommendation via email?', 'cbd-calculator' ); ?></label>
						<label>
							<input type="radio" class="js-cbd-email" name="cbd-send-email" value="no" /> <?php esc_html_e( 'No', 'cbd-calculator' ); ?>
						</label>
						<label>
							<input type="radio" class="js-cbd-email" name="cbd-send-email" value="yes" checked /> <?php esc_html_e( 'Yes', 'cbd-calculator' ); ?>
						</label>
					</div>
				</div>
				<div class="cbd-row cbd-hide js-cbd-email-row">
					<div class="cbd-cell">
						<label for="cbd-email"><?php esc_html_e( 'Enter your Email Address', 'cbd-calculator' ); ?></label>
						<input type="email" id="cbd-email" class="js-cbd-email-input" />
						<button type="button" class="js-cbd-email-button"><?php esc_attr_e( 'Send my dosage recommendation', 'cbd-calculator' ); ?></button>
					</div>
				</div>

				<?php
			} else {
				?>
				<div class="cbd-row cbd-hide js-cbd-email-option-row">
					<div class="cbd-cell">
						<label><?php esc_html_e( 'Möchten Sie Ihr Resultat per Email erhalten?', 'cbd-calculator' ); ?></label>
						<label>
							<input type="radio" class="js-cbd-email" name="cbd-send-email" value="no" /> <?php esc_html_e( 'Nein', 'cbd-calculator' ); ?>
						</label>
						<label>
							<input type="radio" class="js-cbd-email" name="cbd-send-email" value="yes" checked /> <?php esc_html_e( 'Ja', 'cbd-calculator' ); ?>
						</label>
					</div>
				</div>
				<div class="cbd-row cbd-hide js-cbd-email-row">
					<div class="cbd-cell">
						<label for="cbd-email"><?php esc_html_e( 'Ihre Email Addresse', 'cbd-calculator' ); ?></label>
						<input type="email" id="cbd-email" class="js-cbd-email-input" />
						<button type="button" class="js-cbd-email-button"><?php esc_attr_e( 'Dosierungsempfehlung per Email senden', 'cbd-calculator' ); ?></button>
					</div>
				</div>

				<?php
			}
		}
	}
}
add_action( 'cbd_dosage_calculator', 'cbd_calc_email_fields' );

if ( ! function_exists( 'cbd_calc_send_email' ) ) {
	function cbd_calc_send_email() {
		if ( ! empty( $_POST['form_data'] ) ) {
			$options = get_option( 'cbd_plugin' );
			$admin_email = ! empty( $options['email'] ) ? $options['email'] : get_option('admin_email');

			$types = array('human' => 'Mensch', 'pets' => 'Hund/Katze');
			$data = $_POST['form_data'];

			$severity_text = esc_html( $data['severity_text'] );
			$severity 	   = esc_html( $data['severity'] );

			if ( $data['type'] == 'human') {
				$purpose 	   = esc_html( $data['purpose'] );
				$purpose_text  = esc_html( $data['purpose_text'] );
				$weight 	   = esc_html( $data['weight'] );
			} else {
				$purpose 	   = 0.05;
				$purpose_text  = esc_html( $data['pets_purpose_text'] );
				$weight 	   = esc_html( $data['pets_weight'] );
			}

			$step3 = $weight * 2.20462262 * $purpose * $severity;

			$step2 = $step3 * 0.66;
			$step1 = $step3 * 0.33;
			
			$language = isset( $options['language'] ) ? $options['language'] : 'en';

			if ( $language == 'en' ) {
				$subject = 'CBD dosage recommendation';

				$text = '
				<p>Dear Visitor,</p><br/>

				<p>Your CBD dosage result is as follows.</p>

				<p>Specified values:</p>
				<ul>
				<li>User: ' . $types[ $data['type'] ] . '</li>
				<li>Application for: ' . $purpose_text . '</li>';

				if ( ! empty( $severity_text ) ) {
					$text .= '<li>Symptom strength: ' . $severity_text . '</li>';
				}

				$text .= '</ul>

				<p>Calculated results:</p>
				<ul>
					<li>Starting dose for the first week: ' . round( $step1 ) . ' MG CBD spread over the day</li>
					<li>Dose 2: after the first week if the symptoms did not get better: ' . round( $step2 ) . ' MG CBD spread over the day</li>
					<li>Dose 3: after the second week, if the symptoms did not get better: ' . round( $step3 ) . ' MG CBD spread over the day</li>
				</ul>

				<p>Kind regards!</p>';

			} else {
				$subject = 'CBD Dosierungsempfehlung';

				$text = '
				<p>Lieber Besucher,</p><br/>

				<p>Dein Resultat ist wie folgt.</p>

				<p>Angegebene Werte:</p>
				<ul>
				<li>Anwender: ' . $types[ $data['type'] ] . '</li>
				<li>Anwendung für: ' . $purpose_text . '</li>';

				if ( ! empty( $severity_text ) ) {
					$text .= '<li>Symptom Stärke: ' . $severity_text . '</li>';
				}

				$text .= '</ul>

				<p>Berechnete Resultate:</p>
				<ul>
					<li>Einstiegsdosis für die erste Woche: ' . round( $step1 ) . ' MG CBD über den Tag verteilt</li>
					<li>Dosis 2: nach der ersten Woche falls die Beschwerden noch nicht besser wurden: ' . round( $step2 ) . ' MG CBD über den Tag verteilt</li>
					<li>Dosis 3: nach der zweiten Woche falls die Beschwerden noch nicht besser wurden: ' . round( $step3 ) . ' MG CBD über den Tag verteilt</li>
				</ul>

				<p>Liebe Grüße!</p>';
			}
			
			$headers   = array();
			$headers[] = 'From: ' . get_option('blogname') . ' <' . $admin_email . '>';

			add_filter('wp_mail_content_type', 'cbd_calc_set_html_mail_content_type');

			// User email
			wp_mail( $data['email'], $subject, $text, $headers );

			// Admin email
			$text = esc_html__('User email: ', 'cbd-calculator') . $data['email'] . '<br><br>' . $text;
			wp_mail( $admin_email, $subject, $text, $headers );

			remove_filter('wp_mail_content_type', 'cbd_calc_set_html_mail_content_type');
		}
	}
}
add_action( 'wp_ajax_nopriv_cbd_calc_send_email', 'cbd_calc_send_email' );
add_action( 'wp_ajax_cbd_calc_send_email', 'cbd_calc_send_email' );

if ( ! function_exists( 'cbd_calc_set_html_mail_content_type' ) ) {
	function cbd_calc_set_html_mail_content_type() {
	    return 'text/html';
	}
}
