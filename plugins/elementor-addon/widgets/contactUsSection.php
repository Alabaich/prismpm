<?php
class Elementor_contactUsSection extends \Elementor\Widget_Base {

	public function get_name() {
		return 'contactUsSection';
	}

	public function get_title() {
		return __( 'Contact Us Section', 'elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-mail';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_settings',
			[
				'label' => __( 'Settings', 'elementor-addon' ),
			]
		);

		$this->add_control(
			'is_first_section',
			[
				'label' => __( 'Is this the first section?', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'elementor-addon' ),
				'label_off' => __( 'No', 'elementor-addon' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$first_class = ($settings['is_first_section'] === 'yes') ? 'first-contact-section' : '';
		?>
		<section class="contact-us-section elementor-contact-section <?= esc_attr($first_class) ?>">
			<div class="contact-container">
				<div class="left-column">
					<iframe 
						src="https://www.google.com/maps?q=80+Bond+St+E,+Oshawa,+ON,+Canada&output=embed"
						width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy">
					</iframe>
					<div class="contact-info">
						<div><strong>Address</strong><br>80 Bond St E<br>Oshawa ON L1G 0E6</div>
						<div><strong>E-mail</strong><br>customercare@prismpm.ca<br>lease@prismpm.ca</div>
						<div><strong>Phone</strong><br>289-797-1604</div>
					</div>
				</div>
				<div class="right-column">
					<h2>Contact Us</h2>
					<p>fill out the contact form and we’ll get back to you as soon as possible</p>
					<form class="contact-form">
						<input type="text" name="name" placeholder="Name" required>
						<input type="text" name="phone" placeholder="Phone" required>
						<input type="email" name="email" placeholder="Email" required>
						<textarea name="message" placeholder="Message" required></textarea>
						<div class="submit-row">
							<button type="submit">Submit <span>&#8594;</span></button>
							<small>By clicking the Contact us button you agree to our<br><a href="#">Privacy Policy terms</a></small>
						</div>
					</form>
				</div>
			</div>
		</section>

		<style>
			.contact-us-section {
				background: #fff;
				border-radius: 12px;
				padding: 2rem;
				background: #F4F4F499;
			}

			.contact-container {
				display: flex;
				gap: 2rem 7rem;
				flex-wrap: wrap;
				justify-content: center;
				max-width: 1568px;
			}

			.left-column {
				flex: 1;
				min-height: 400px;
				min-width: 300px;
				max-width: 700px;
			}

			.contact-info {
				display: flex;
				justify-content: space-between;
				margin-top: 1rem;
				font-size: 0.9rem;
			}

			.contact-info div {
				flex: 1;
			}

			.right-column {
				flex: 1;
				min-width: 300px;
				max-width: 450px;
			}

			.right-column h2 {
				font-size: 1.8rem;
				margin-bottom: 0.5rem;
			}

			.right-column p {
				margin-bottom: 1.5rem;
				color: #555;
			}

			.contact-form input,
			.contact-form textarea {
				width: 100%;
				padding: 0.75rem;
				margin-bottom: 1rem;
				border: 1px solid #ccc;
				border-radius: 8px;
				font-size: 0.9rem;
			}

			.contact-form textarea {
				min-height: 100px;
			}

			.submit-row {
				display: flex;
				align-items: center;
				justify-content: space-between;
				flex-wrap: wrap;
				gap: 1rem;
			}

			.submit-row button {
				background: #0e3c55;
				color: #fff;
				border: none;
				border-radius: 999px;
				padding: 0.75rem 1.5rem;
				font-weight: 500;
				cursor: pointer;
			}

			.submit-row small {
				font-size: 0.7rem;
				color: #888;
			}

			.submit-row a {
				text-decoration: underline;
				color: #555;
			}

			.first-contact-section {
				margin-top: 200px;
			}
		</style>
		<?php
	}
}
