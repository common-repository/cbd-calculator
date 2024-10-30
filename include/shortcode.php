<?php

if ( ! function_exists( 'cbd_calc_conversion_shortctcode' ) ) {
	function cbd_calc_conversion_shortctcode( $atts, $content = null ) {
		wp_enqueue_style( 'cbd_calc-styles' );
		wp_enqueue_script( 'cbd_calc-scripts' );

		$options = get_option( 'cbd_plugin' );
		$language = isset( $options['language'] ) ? $options['language'] : 'en';
		if ( $language == 'en' ) {

			ob_start(); ?>

			<div class="cbd-wrapper">
				<form class="cbd-conversion">
					<div class="cbd-row">
						<div class="cbd-cell">
							<label for="cbd-bottle"><?php esc_html_e( 'How large is your CBD Bottle (in millilitres)?', 'cbd-calculator' ); ?></label>
							<input type="number" min="0" id="cbd-bottle" class="js-cbd-bottle" placeholder="<?php esc_html_e( 'Millilitres', 'cbd-calculator' ); ?>" />
						</div>
					</div>
					<div class="cbd-row">
						<div class="cbd-cell">
							<label for="cbd-bottle-amount"><?php esc_html_e( 'How much CBD is in the whole bottle (in milligram)?', 'cbd-calculator' ); ?></label>
							<input type="number" min="0" id="cbd-bottle-amount" class="js-cbd-bottle-amount" placeholder="<?php esc_html_e( 'Milligram', 'cbd-calculator' ); ?>" />
						</div>
					</div>
					<div class="cbd-row">
						<div class="cbd-cell">
							<label for="cbd-take"><?php esc_html_e( 'How much CBD would you like to take (in milligram)?', 'cbd-calculator' ); ?></label>
							<input type="number" min="0" id="cbd-take" class="js-cbd-take" placeholder="<?php esc_html_e( 'Milligram', 'cbd-calculator' ); ?>" />
						</div>
					</div>
					<div class="cbd-row cbd-result-row">
						<div class="cbd-cell">
							<p><?php esc_html_e( 'Number of drops to take for desired CBD amount:', 'cbd-calculator' ); ?> <span class="cbd-result-desire-amount">0</span> <?php esc_html_e( 'drops', 'cbd-calculator' ); ?></p>
						</div>
					</div>
					<div class="cbd-row cbd-result-row">
						<div class="cbd-cell">
							<p><?php esc_html_e( 'Number of millilitres required to reach desired CBD amount:', 'cbd-calculator' ); ?> <span class="cbd-result-milliliters">0</span> <?php esc_html_e( 'ml', 'cbd-calculator' ); ?></p>
						</div>
					</div>
					<div class="cbd-row">
						<div class="cbd-cell cbd-copyright">
							<p><?php printf( esc_html__( 'Add this calculator to your website: powered by %s.', 'cbd-calculator' ), '<a href="https://cbd-reviewed.com/">CBD Reviewed</a>'); ?></p>
						</div>
					</div>
				</form>
			</div>
			<?php
			return ob_get_clean();

		} else {

			ob_start(); ?>

			<div class="cbd-wrapper">
				<form class="cbd-conversion">
					<div class="cbd-row">
						<div class="cbd-cell">
							<label for="cbd-bottle"><?php esc_html_e( 'Wie groß ist dein CBD Fläschchen in Millilitern?', 'cbd-calculator' ); ?></label>
							<input type="number" min="0" id="cbd-bottle" class="js-cbd-bottle" placeholder="<?php esc_html_e( 'Milliliter', 'cbd-calculator' ); ?>" />
						</div>
					</div>
					<div class="cbd-row">
						<div class="cbd-cell">
							<label for="cbd-bottle-amount"><?php esc_html_e( 'Wie viel CBD befindet sich im ganzen Fläschchen (in Milligramm)?', 'cbd-calculator' ); ?></label>
							<input type="number" min="0" id="cbd-bottle-amount" class="js-cbd-bottle-amount" placeholder="<?php esc_html_e( 'Milligram', 'cbd-calculator' ); ?>" />
						</div>
					</div>
					<div class="cbd-row">
						<div class="cbd-cell">
							<label for="cbd-take"><?php esc_html_e( 'Wieviel Milligramm an CBD möchtest du einnehmen?', 'cbd-calculator' ); ?></label>
							<input type="number" min="0" id="cbd-take" class="js-cbd-take" placeholder="<?php esc_html_e( 'Trofen', 'cbd-calculator' ); ?>" />
						</div>
					</div>
					<div class="cbd-row cbd-result-row">
						<div class="cbd-cell">
							<p><?php esc_html_e( 'Anzahl der Tropfen um gewünschte CBD Menge einzunehmen:', 'cbd-calculator' ); ?> <span class="cbd-result-desire-amount">0</span> <?php esc_html_e( 'Tropfen', 'cbd-calculator' ); ?></p>
						</div>
					</div>
					<div class="cbd-row cbd-result-row">
						<div class="cbd-cell">
							<p><?php esc_html_e( 'Anzahl Milliliter um gewünschte CBD Menge einzunehmen:', 'cbd-calculator' ); ?> <span class="cbd-result-milliliters">0</span> <?php esc_html_e( 'mL', 'cbd-calculator' ); ?></p>
						</div>
					</div>
					<div class="cbd-row">
						<div class="cbd-cell cbd-copyright">
							<p><?php printf( esc_html__( 'Fügen Sie diesen Rechner ganz einfach auf Ihrer Webseite ein: powered by %s.', 'cbd-calculator' ), '<a href="https://cbd-reviewed.com/">CBD Reviewed</a>' ); ?></p>
						</div>
					</div>
				</form>
			</div>
			<?php
			return ob_get_clean();
		}
	}
}
add_shortcode( 'cbd_conversion_calculator', 'cbd_calc_conversion_shortctcode' );

if ( ! function_exists( 'cbd_calc_dosage_shortctcode' ) ) {
	function cbd_calc_dosage_shortctcode( $atts, $content = null ) {
		wp_enqueue_style( 'cbd_calc-styles' );
		wp_enqueue_script( 'cbd_calc-scripts' );

		$options = get_option( 'cbd_plugin' );
		$language = isset( $options['language'] ) ? $options['language'] : 'en';
		$weight_unit = ! empty( $options['weight_unit'] ) ? $options['weight_unit'] : 'kg';
		
		if ( $language == 'en' ) {
			ob_start(); ?>
			<div class="cbd-wrapper">
				<form class="cbd-dosage" data-weight="<?php echo esc_attr( $weight_unit );?>">
					<div class="cbd-row">
						<div class="cbd-cell">
							<label for="cbd-type"><?php esc_html_e( 'Would you like to get the CBD dosage recommendation for a human or a pet?', 'cbd-calculator' ); ?></label>
							<select class="js-cbd-type cbd-select" id="cbd-type">
								<option data-value="human"><?php esc_html_e( 'Human', 'cbd-calculator' ); ?></option>
								<option data-value="pets"><?php esc_html_e( 'Pet', 'cbd-calculator' ); ?></option>
							</select>
						</div>
					</div>
					<div class="cbd-row js-cbd-purpose-row">
						<!-- Human -->
						<div class="cbd-cell">
							<label for="cbd-purpose"><?php esc_html_e( 'Application for', 'cbd-calculator' ); ?></label>
							<select class="js-cbd-purpose cbd-select" id="cbd-purpose">
								<option data-value=".13"><?php esc_html_e( 'General' , 'cbd-calculator' ); ?></option>
								<option data-value=".26"><?php esc_html_e( 'Alzheimer\'s' , 'cbd-calculator' ); ?></option>
								<option data-value=".16"><?php esc_html_e( 'Anxiety / Phobias / Stress' , 'cbd-calculator' ); ?></option>
								<option data-value=".26"><?php esc_html_e( 'Arthritis' , 'cbd-calculator' ); ?></option>
								<option data-value=".26"><?php esc_html_e( 'Autism' , 'cbd-calculator' ); ?></option>
								<option data-value=".26"><?php esc_html_e( 'Bipolar Disorder' , 'cbd-calculator' ); ?></option>
								<option data-value=".79"><?php esc_html_e( 'Cancer' , 'cbd-calculator' ); ?></option>
								<option data-value=".26"><?php esc_html_e( 'Dementia' , 'cbd-calculator' ); ?></option>
								<option data-value=".39"><?php esc_html_e( 'Depression' , 'cbd-calculator' ); ?></option>
								<option data-value="1.2"><?php esc_html_e( 'Epilepsy' , 'cbd-calculator' ); ?></option>
								<option data-value=".25"><?php esc_html_e( 'High Blood Pressure' , 'cbd-calculator' ); ?></option>
								<option data-value=".1"><?php esc_html_e( 'Inflammation' , 'cbd-calculator' ); ?></option>
								<option data-value=".1"><?php esc_html_e( 'Migraine' , 'cbd-calculator' ); ?></option>
								<option data-value=".13"><?php esc_html_e( 'Multiple Sclerosis' , 'cbd-calculator' ); ?></option>
								<option data-value=".08"><?php esc_html_e( 'Nausea' , 'cbd-calculator' ); ?></option>
								<option data-value=".25"><?php esc_html_e( 'Pain (general)' , 'cbd-calculator' ); ?></option>
								<option data-value=".785"><?php esc_html_e( 'Parkinsons' , 'cbd-calculator' ); ?></option>
								<option data-value=".0937"><?php esc_html_e( 'Period Pain' , 'cbd-calculator' ); ?></option>
								<option data-value=".13"><?php esc_html_e( 'Rheumatism' , 'cbd-calculator' ); ?></option>
								<option data-value=".79"><?php esc_html_e( 'Shizophrenia' , 'cbd-calculator' ); ?></option>
								<option data-value=".26"><?php esc_html_e( 'Sleeplessness' , 'cbd-calculator' ); ?></option>
								<option data-value=".26"><?php esc_html_e( 'Tremors' , 'cbd-calculator' ); ?></option>
							</select>
						</div>
					</div>
					<div class="cbd-row cbd-hide js-cbd-pets-purpose-row">
						<!-- Pets -->
						<div class="cbd-cell">
							<label for="cbd-pets-purpose"><?php esc_html_e( 'Application for', 'cbd-calculator' ); ?></label>
							<select class="js-cbd-pets-purpose cbd-select" id="cbd-pets-purpose">
								<option data-value=".05"><?php esc_html_e( 'General', 'cbd-calculator' ); ?></option>
								<option data-value=".05"><?php esc_html_e( 'Anxiety / Phobias / Stress', 'cbd-calculator' ); ?></option>
								<option data-value=".05"><?php esc_html_e( 'Arthritis', 'cbd-calculator' ); ?></option>
								<option data-value=".05"><?php esc_html_e( 'Cancer', 'cbd-calculator' ); ?></option>
								<option data-value=".05"><?php esc_html_e( 'Dementia', 'cbd-calculator' ); ?></option>
								<option data-value=".05"><?php esc_html_e( 'Depression', 'cbd-calculator' ); ?></option>
								<option data-value=".05"><?php esc_html_e( 'Seizures', 'cbd-calculator' ); ?></option>
							</select>
						</div>
					</div>
					<div class="cbd-row cbd-hide js-cbd-severity-row">
						<div class="cbd-cell">
							<!-- Human - all except the first value -->
							<label for="cbd-severity"><?php esc_html_e( 'Severity of Symptoms', 'cbd-calculator' ); ?></label>
							<select class="js-cbd-severity cbd-select" id="cbd-severity">
								<option data-value=".33"><?php esc_html_e( 'Light', 'cbd-calculator' ); ?></option>
								<option data-value="1"><?php esc_html_e( 'Medium', 'cbd-calculator' ); ?></option>
								<option data-value="2"><?php esc_html_e( 'Severe', 'cbd-calculator' ); ?></option>
							</select>
						</div>
					</div>
					<div class="cbd-row cbd-hide js-cbd-pets-severity-row">
						<!-- Pets - all except the first value -->
						<div class="cbd-cell">
							<label for="cbd-pets-severity"><?php esc_html_e( 'Severity of Symptoms', 'cbd-calculator' ); ?></label>
							<select class="js-cbd-pets-severity cbd-select" id="cbd-pets-severity">
								<option data-value="1"><?php esc_html_e('Light', 'cbd-calculator' ) ?></option>
								<option data-value="6"><?php esc_html_e('Medium', 'cbd-calculator' ) ?></option>
								<option data-value="3"><?php esc_html_e('Severe', 'cbd-calculator' ) ?></option>
							</select>
						</div>
					</div>
					<div class="cbd-row js-cbd-weight-row">
						<div class="cbd-cell">
							<label for="cbd-weight"><?php printf( esc_html__( 'Weight in %s', 'cbd-calculator' ),  strtoupper( $weight_unit ) ); ?></label>
							<input type="number" min="0" id="cbd-weight" class="js-cbd-weight" />
						</div>
					</div>
					<div class="cbd-row cbd-hide js-cbd-pets-weight-row">
						<div class="cbd-cell">
							<label for="cbd-pets-weight"><?php printf( esc_html__( 'Weight in %s', 'cbd-calculator' ), strtoupper( $weight_unit ) ); ?></label>
							<input type="number" min="0" id="cbd-pets-weight" class="js-cbd-pets-weight" />
						</div>
					</div>

					<div class="cbd-row cbd-result-row">
						<div class="cbd-cell">
							<p><?php printf( esc_html__( 'Initial dosage for the first week: %s MG CBD. This is the preferred dosage of most users for the selection you have made. It is recommended to start with this dosage and spread the intake throughout the day with each meal. If there is no improvement in symptoms, the next dosage recommendation can be applied below.', 'cbd-calculator' ), '<span class="cbd-result-step-1">0</span>' ); ?></p>
						</div>
					</div>
					<div class="cbd-row cbd-result-row">
						<div class="cbd-cell">
							<p><?php printf( esc_html__( 'Follow-up dosage after initial dosage did not improve symptoms: %s MG CBD. It is recommended to spread the dosage throughout the day with each meal. This dosage is the permanent dosage for many users. If there is no improvement of symptoms, the next dosage recommendation can be applied.', 'cbd-calculator'), '<span class="cbd-result-step-2">0</span>' ); ?></p>
						</div>
					</div>
					<div class="cbd-row cbd-result-row">
						<div class="cbd-cell">
							<p><?php printf( esc_html__( 'Follow-up dosage if symptoms did not improve: %s MG CBD.', 'cbd-calculator'), '<span class="cbd-result-step-3">0</span>' ); ?></p>
						</div>
					</div>
					<div class="cbd-row cbd-result-row">
						<div class="cbd-cell">
							<p><?php esc_html_e( 'This dosage should be applied after about 3 weeks if symptoms still have not improved. It is recommended to take the CBD throughout the day with each meal.', 'cbd-calculator' ); ?></p>
						</div>
					</div>
					<?php do_action( 'cbd_dosage_calculator' ); ?>
					<div class="cbd-row">
						<div class="cbd-cell cbd-copyright">
							<p><?php printf( esc_html__( 'Add this simple CBD calculator to your own website: powered by %s.', 'cbd-calculator' ), '<a href="https://cbd-reviewed.com/">CBD Reviewed</a>' ); ?></p>
						</div>
					</div>
				</form>
			</div>

			<?php

			return ob_get_clean();
		} else {
			ob_start(); ?>
			<div class="cbd-wrapper">
				<form class="cbd-dosage">
					<div class="cbd-row">
						<div class="cbd-cell">
							<label for="cbd-type"><?php esc_html_e( 'Möchten Sie die CBD Dosierung für Mensch oder Haustiere ermitteln?', 'cbd-calculator' ); ?></label>
							<select class="js-cbd-type cbd-select" id="cbd-type">
								<option data-value="human"><?php esc_html_e( 'Mensch', 'cbd-calculator' ); ?></option>
								<option data-value="pets"><?php esc_html_e( 'Hund / Katze', 'cbd-calculator' ); ?></option>
							</select>
						</div>
					</div>
					<div class="cbd-row js-cbd-purpose-row">
						<!-- Human -->
						<div class="cbd-cell">
							<label for="cbd-purpose"><?php esc_html_e( 'Anwendung für', 'cbd-calculator' ); ?></label>
							<select class="js-cbd-purpose cbd-select" id="cbd-purpose">
								<option data-value=".13"><?php esc_html_e( 'Generell' , 'cbd-calculator' ); ?></option>
								<option data-value=".26"><?php esc_html_e( 'Alzheimer\'s' , 'cbd-calculator' ); ?></option>
								<option data-value=".16"><?php esc_html_e( 'Angst / Panik / Phobien' , 'cbd-calculator' ); ?></option>
								<option data-value=".26"><?php esc_html_e( 'Artrhitis' , 'cbd-calculator' ); ?></option>
								<option data-value=".26"><?php esc_html_e( 'Autismus' , 'cbd-calculator' ); ?></option>
								<option data-value=".26"><?php esc_html_e( 'Bipolare Störung' , 'cbd-calculator' ); ?></option>
								<option data-value=".79"><?php esc_html_e( 'Krebs' , 'cbd-calculator' ); ?></option>
								<option data-value=".26"><?php esc_html_e( 'Demenz' , 'cbd-calculator' ); ?></option>
								<option data-value=".39"><?php esc_html_e( 'Depression' , 'cbd-calculator' ); ?></option>
								<option data-value="1.2"><?php esc_html_e( 'Epilepsie' , 'cbd-calculator' ); ?></option>
								<option data-value=".25"><?php esc_html_e( 'Bluthochdruck' , 'cbd-calculator' ); ?></option>
								<option data-value=".1"><?php esc_html_e( 'Entzündungen' , 'cbd-calculator' ); ?></option>
								<option data-value=".1"><?php esc_html_e( 'Migräne' , 'cbd-calculator' ); ?></option>
								<option data-value=".13"><?php esc_html_e( 'Multiple Sklerose' , 'cbd-calculator' ); ?></option>
								<option data-value=".08"><?php esc_html_e( 'Übelkeit' , 'cbd-calculator' ); ?></option>
								<option data-value=".25"><?php esc_html_e( 'Schmerzen (generell)' , 'cbd-calculator' ); ?></option>
								<option data-value=".785"><?php esc_html_e( 'Parkinsons' , 'cbd-calculator' ); ?></option>
								<option data-value=".0937"><?php esc_html_e( 'Periodenbeschwerden' , 'cbd-calculator' ); ?></option>
								<option data-value=".13"><?php esc_html_e( 'Rheuma' , 'cbd-calculator' ); ?></option>
								<option data-value=".79"><?php esc_html_e( 'Schizophrenie' , 'cbd-calculator' ); ?></option>
								<option data-value=".26"><?php esc_html_e( 'Schlaflosigkeit' , 'cbd-calculator' ); ?></option>
								<option data-value=".26"><?php esc_html_e( 'Zittern' , 'cbd-calculator' ); ?></option>
							</select>
						</div>
					</div>
					<div class="cbd-row cbd-hide js-cbd-pets-purpose-row">
						<!-- Pets -->
						<div class="cbd-cell">
							<label for="cbd-pets-purpose"><?php esc_html_e( 'Anwendung für', 'cbd-calculator' ); ?></label>
							<select class="js-cbd-pets-purpose cbd-select" id="cbd-pets-purpose">
								<option data-value=".05"><?php esc_html_e( 'Generell', 'cbd-calculator' ); ?></option>
								<option data-value=".05"><?php esc_html_e( 'Angst / Panik / Phobien', 'cbd-calculator' ); ?></option>
								<option data-value=".05"><?php esc_html_e( 'Arthritis', 'cbd-calculator' ); ?></option>
								<option data-value=".05"><?php esc_html_e( 'Krebs', 'cbd-calculator' ); ?></option>
								<option data-value=".05"><?php esc_html_e( 'Demenz', 'cbd-calculator' ); ?></option>
								<option data-value=".05"><?php esc_html_e( 'Depression', 'cbd-calculator' ); ?></option>
								<option data-value=".05"><?php esc_html_e( 'Krampfanfälle', 'cbd-calculator' ); ?></option>
							</select>
						</div>
					</div>
					<div class="cbd-row cbd-hide js-cbd-severity-row">
						<div class="cbd-cell">
							<!-- Human - all except the first value -->
							<label for="cbd-severity"><?php esc_html_e( 'Schwere der Symptome', 'cbd-calculator' ); ?></label>
							<select class="js-cbd-severity cbd-select" id="cbd-severity">
								<option data-value=".33"><?php esc_html_e( 'Leicht', 'cbd-calculator' ); ?></option>
								<option data-value="1"><?php esc_html_e( 'Mittel', 'cbd-calculator' ); ?></option>
								<option data-value="2"><?php esc_html_e( 'Schwer', 'cbd-calculator' ); ?></option>
							</select>
						</div>
					</div>
					<div class="cbd-row cbd-hide js-cbd-pets-severity-row">
						<!-- Pets - all except the first value -->
						<div class="cbd-cell">
							<label for="cbd-pets-severity"><?php esc_html_e( 'Schwere der Symptome', 'cbd-calculator' ); ?></label>
							<select class="js-cbd-pets-severity cbd-select" id="cbd-pets-severity">
								<option data-value="1"><?php esc_html_e('Leicht', 'cbd-calculator' ) ?></option>
								<option data-value="6"><?php esc_html_e('Mittel', 'cbd-calculator' ) ?></option>
								<option data-value="3"><?php esc_html_e('Schwer', 'cbd-calculator' ) ?></option>
							</select>
						</div>
					</div>
					<div class="cbd-row js-cbd-weight-row">
						<div class="cbd-cell">
							<label for="cbd-weight"><?php printf( esc_html__( 'Gewicht in KG', 'cbd-calculator' ), strtoupper( $weight_unit ) ); ?></label>
							<input type="number" min="0" id="cbd-weight" class="js-cbd-weight" />
						</div>
					</div>
					<div class="cbd-row cbd-hide js-cbd-pets-weight-row">
						<div class="cbd-cell">
							<label for="cbd-pets-weight"><?php printf( esc_html__( 'Gewicht in KG', 'cbd-calculator' ), strtoupper( $weight_unit ) ); ?></label>
							<input type="number" min="0" id="cbd-pets-weight" class="js-cbd-pets-weight" />
						</div>
					</div>

					<div class="cbd-row cbd-result-row">
						<div class="cbd-cell">
							<p><?php printf( esc_html__( 'Einstiegsdosierung für erste Woche: %s MG CBD. Dies ist die bevorzugte Dosierung der meisten Nutzer bei den von Ihnen gewählten Eingaben. Es empfiehlt sich mit dieser Dosierung zu starten und die Einnahme über den Tag zu verteilen mit jeder Mahlzeit. Falls keine Besserung der Symptome eintritt, kann zur Folgedosierung unten fortgeschritten werden.', 'cbd-calculator' ), '<span class="cbd-result-step-1">0</span>' ); ?></p>
						</div>
					</div>
					<div class="cbd-row cbd-result-row">
						<div class="cbd-cell">
							<p><?php printf( esc_html__( 'Folgedosierung nach Einstiegsdosierung falls Symptome nicht besser wurden: %s MG CBD. Es empfiehlt sich die Einnahme über den Tag zu verteilen mit jeder Mahlzeit. Diese Dosierung ist oftmals die Dauerdosierung für viele Anwender. Falls keine Besserung der Symptome eintritt, kann zur Folgedosierung unten fortgeschritten werden.', 'cbd-calculator' ), '<span class="cbd-result-step-2">0</span>'); ?></p>
						</div>
					</div>
					<div class="cbd-row cbd-result-row">
						<div class="cbd-cell">
							<p><?php printf( esc_html__( 'Folgedosierung falls Symptome nicht besser werden: %s MG CBD.', 'cbd-calculator' ), '<span class="cbd-result-step-3">0</span>' ); ?></p>
						</div>
					</div>
					<div class="cbd-row cbd-result-row">
						<div class="cbd-cell">
							<p><?php esc_html_e( 'Diese Dosierung sollte erst nach etwa 3 Wochen gewählt werden, falls sich die Symptome immer noch nicht verbessert haben. Es empfiehlt sich die Einnahme über den Tag zu verteilen mit jeder Mahlzeit.', 'cbd-calculator' ); ?></p>
						</div>
					</div>
					<?php do_action( 'cbd_dosage_calculator' ); ?>
					<div class="cbd-row">
						<div class="cbd-cell cbd-copyright">
							<p><?php printf( esc_html__( 'Fügen Sie diesen Rechner ganz einfach auf Ihrer Webseite ein: powered by %s.', 'cbd-calculator' ), '<a href="https://cbd-reviewed.com/">CBD Reviewed</a>' ); ?></p>
						</div>
					</div>
				</form>
			</div>

			<?php
			return ob_get_clean();
		}
	}
}
add_shortcode( 'cbd_dosage_calculator', 'cbd_calc_dosage_shortctcode' );
