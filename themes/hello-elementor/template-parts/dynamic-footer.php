<?php

/**
 * The template for displaying footer.
 *
 * @package HelloElementor
 */

if (! defined('ABSPATH')) {
	exit;
}

$is_editor     = isset($_GET['elementor-preview']);
$site_name     = get_bloginfo('name');
$tagline       = get_bloginfo('description', 'display');
$footer_class  = did_action('elementor/loaded') ? hello_get_footer_layout_class() : '';
$footer_nav_menu = wp_nav_menu([
	'theme_location' => 'menu-2',
	'fallback_cb'    => false,
	'container'      => false,
	'echo'           => false,
]);
?>
<footer id="site-footer" class="site-footer prism-footer">
	<div class="footer-container">
		<div class="footer-left">
			<div class="footer-map">
				<iframe
					src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2878.486062681586!2d-78.8634727241364!3d43.82485397101098!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89d4f6e5a3c5f1a1%3A0x3d8a9c20c8f1b1a8!2s80%20Bond%20St%20E%2C%20Oshawa%2C%20ON%20L1G%200E5%2C%20Canada!5e0!3m2!1sen!2sus!4v<?php echo time(); ?>!5m2!1sen!2sus"
					width="100%"
					height="300"
					style="border:0;"
					allowfullscreen=""
					loading="lazy">
				</iframe>
			</div>
		</div>

		<div class="footer-right">
			<div class="footer-row">
				<div class="footer-col">
					<h4>Customer Care</h4>
					<p><a href="mailto:customercare@prismpm.ca">customercare@prismpm.ca</a></p>
				</div>
				<div class="footer-col">
					<h4>Leasing Inquiries</h4>
					<p>80 Bond<br>100 Bond<br>Y Lofts</p>
				</div>
				<div class="footer-col">
					<h4>Location</h4>
					<p>80 Bond St E<br>Oshawa ON L1G 0E5</p>
				</div>
			</div>

			<div class="footer-row">
				<div class="footer-col">
					<h4>Contacts</h4>
					<p><a href="mailto:lease@prismpm.ca">lease@prismpm.ca</a><br>289-797-1604</p>
				</div>
				<div class="footer-col">
					<h4>Office Hours</h4>
					<p>
						Mon. 9:00 am – 5:00 pm<br>
						Tue. 9:00 am – 5:00 pm<br>
						Wed. 9:00 am – 5:00 pm<br>
						Thu. 9:00 am – 8:00 pm<br>
						Fri. 9:00 am – 5:00 pm<br>
						Sat. 10:00 am – 2:00 pm<br>
						Sun. by appointment only
					</p>
				</div>
			</div>

			<div class="footer-row newsletter-row">
				<div class="footer-col full-width">
					<h4>Latest News & Events</h4>
					<form class="newsletter-form" action="#" method="post">
						<input type="email" placeholder="Enter your email address" required>
						<button type="submit">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="footer-bottom-wrapper">
		<div class="footer-bottom">
			<div class="footer-top-row">
				<?php if (has_custom_logo()): ?>
					<div class="footer-logo"><?php the_custom_logo(); ?></div>
				<?php endif; ?>
				<div class="footer-contact-buttons">
					<a class="btn phone" href="tel:2894992632">
						<svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M15.1467 12.72C15.1467 12.96 15.0934 13.2067 14.98 13.4467C14.8667 13.6867 14.72 13.9134 14.5267 14.1267C14.2 14.4867 13.84 14.7467 13.4334 14.9134C13.0334 15.08 12.6 15.1667 12.1334 15.1667C11.4534 15.1667 10.7267 15.0067 9.96004 14.68C9.19337 14.3534 8.42671 13.9134 7.66671 13.36C6.90004 12.8 6.17337 12.18 5.48004 11.4934C4.79337 10.8 4.17337 10.0734 3.62004 9.31337C3.07337 8.55337 2.63337 7.79337 2.31337 7.04004C1.99337 6.28004 1.83337 5.55337 1.83337 4.86004C1.83337 4.40671 1.91337 3.97337 2.07337 3.57337C2.23337 3.16671 2.48671 2.79337 2.84004 2.46004C3.26671 2.04004 3.73337 1.83337 4.22671 1.83337C4.41337 1.83337 4.60004 1.87337 4.76671 1.95337C4.94004 2.03337 5.09337 2.15337 5.21337 2.32671L6.76004 4.50671C6.88004 4.67337 6.96671 4.82671 7.02671 4.97337C7.08671 5.11337 7.12004 5.25337 7.12004 5.38004C7.12004 5.54004 7.07337 5.70004 6.98004 5.85337C6.89337 6.00671 6.76671 6.16671 6.60671 6.32671L6.10004 6.85337C6.02671 6.92671 5.99337 7.01337 5.99337 7.12004C5.99337 7.17337 6.00004 7.22004 6.01337 7.27337C6.03337 7.32671 6.05337 7.36671 6.06671 7.40671C6.18671 7.62671 6.39337 7.91337 6.68671 8.26004C6.98671 8.60671 7.30671 8.96004 7.65337 9.31337C8.01337 9.66671 8.36004 9.99337 8.71337 10.2934C9.06004 10.5867 9.34671 10.7867 9.57337 10.9067C9.60671 10.92 9.64671 10.94 9.69337 10.96C9.74671 10.98 9.80004 10.9867 9.86004 10.9867C9.97337 10.9867 10.06 10.9467 10.1334 10.8734L10.64 10.3734C10.8067 10.2067 10.9667 10.08 11.12 10C11.2734 9.90671 11.4267 9.86004 11.5934 9.86004C11.72 9.86004 11.8534 9.88671 12 9.94671C12.1467 10.0067 12.3 10.0934 12.4667 10.2067L14.6734 11.7734C14.8467 11.8934 14.9667 12.0334 15.04 12.2C15.1067 12.3667 15.1467 12.5334 15.1467 12.72Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" />
						</svg>
						<span>289.499.2632</span>
					</a>
					<a class="btn email" href="mailto:lease@prismpm.ca">
						lease@prismpm.ca
					</a>
				</div>
			</div>

			<div class="footer-bottom-content">
				<div class="footer-menu-row">
					<?php echo $footer_nav_menu; ?>
				</div>
				<div class="footer-copyright-row">
					©2025 by Prism Property Management. All rights reserved. Designed by Enjoyable Agency.
				</div>
			</div>
		</div>
	</div>

	<style>
		.prism-footer {
			background: #0e3c55;
			color: #fff;
			padding: 3rem 0 0;
			width: 100% !important;
			max-width: 100% !important;
			margin: 0;
			box-sizing: border-box;
		}

		.footer-container {
			display: flex;
			flex-wrap: wrap;
			padding: 0 10% 2rem;
			gap: 3rem;
		}

		@media screen and (max-width: 1600px) {
			.footer-container {
				padding: 0 25px 2rem;
			}
		}

		@media screen and (max-width: 768px) {
			.footer-container {
				padding: 0 15px 2rem;
			}
		}

		.footer-bottom-wrapper {
			width: 100%;
			background: #fff;
			padding: 2rem 10%;
		}

		@media screen and (max-width: 1600px) {
			.footer-bottom-wrapper {
				padding: 2rem 25px;
			}
		}

		@media screen and (max-width: 768px) {
			.footer-bottom-wrapper {
				padding: 2rem 15px;
			}
		}

		.footer-bottom {
			display: flex;
			flex-direction: column;
			gap: 1.5rem;
		}

		.footer-left {
			flex: 1;
			min-width: 40%;
		}

		.footer-right {
			flex: 2;
			display: flex;
			flex-direction: column;
			gap: 2rem;
			min-width: 300px;
		}

		.footer-map {
			width: 100%;
			height: 100%;
			min-height: 400px;
			border-radius: 12px;
			overflow: hidden;
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
		}

		.footer-map iframe {
			width: 100%;
			height: 100%;
			min-height: 400px;
			border: none;
		}

		.footer-row {
			display: flex;
			flex-wrap: wrap;
			gap: 2rem;
			justify-content: flex-start;
		}

		.footer-col {
			flex: 0 0 calc(33.333% - 2rem);
			min-width: 180px;
		}

		.footer-col h4 {
			font-size: 16px;
			font-weight: 600;
			margin-bottom: 0.75rem;
			color: #fff;
		}

		.footer-col p {
			line-height: 1.5;
			margin: 0.5rem 0;
		}

		.footer-col a {
			color: #fff;
			text-decoration: none;
			transition: opacity 0.3s ease;
		}

		.footer-col a:hover {
			opacity: 0.8;
		}

		.newsletter-row .footer-col.full-width {
			width: 100%;
			max-width: 100%;
		}

		.newsletter-form {
			display: flex;
			gap: 0.75rem;
			margin-top: 1rem;
			width: 100%;
			max-width: 100%;
		}

		.newsletter-form input {
			flex: 1;
			min-width: 0;
			width: 100%;
			max-width: 100%;
			padding: 10px 18px;
			border-radius: 30px;
			border: 1px solid #fff;
			background: transparent;
			color: #fff;
			font-size: 14px;
			box-sizing: border-box;
		}

		.newsletter-form input::placeholder {
			color: rgba(255, 255, 255, 0.7);
		}

		.newsletter-form button {
			background: #fff;
			color: #0e3c55;
			border: none;
			padding: 10px 20px;
			border-radius: 30px;
			cursor: pointer;
			display: flex;
			align-items: center;
			gap: 6px;
			font-weight: 600;
			font-size: 14px;
			transition: all 0.3s ease;
			flex-shrink: 0;
		}

		.newsletter-form button:hover {
			background: #f0f0f0;
		}

		.footer-top-row {
			display: flex;
			justify-content: space-between;
			align-items: center;
			flex-wrap: wrap;
			gap: 2rem;
		}

		.footer-logo img {
			height: 40px;
			width: auto;
		}

		.footer-contact-buttons {
			display: flex;
			gap: 1rem;
			align-items: center;
		}

		.footer-bottom-content {
			display: flex;
			justify-content: space-between;
			align-items: center;
			flex-wrap: wrap;
			gap: 2rem;
		}

		.footer-menu-row ul {
			display: flex;
			gap: 1.5rem;
			flex-wrap: wrap;
			list-style: none;
			padding: 0;
			margin: 0;
		}

		.footer-menu-row a {
			color: #333;
			text-decoration: none;
			transition: color 0.3s ease;
			font-size: 14px;
		}

		.footer-menu-row a:hover {
			color: #0e3c55;
		}

		.footer-copyright-row {
			font-size: 14px;
			color: #333;
			order: 2;
		}

		.footer-bottom .btn {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			border-radius: 66px;
			padding: 10px 20px;
			font-size: 1rem;
			font-weight: 500;
			text-decoration: none;
			font-family: "Inter Tight", sans-serif;
			border: 2px solid;
			cursor: pointer;
			transition: all 0.3s ease;
		}

		.footer-bottom .btn.phone {
			background: #f4f4f4;
			color: #000;
			border-color: transparent;
		}

		.footer-bottom .btn.email {
			background: #0e3c55;
			color: #fff;
			border-color: #0e3c55;
		}

		.footer-bottom .btn.phone:hover {
			background: transparent;
			color: #000;
			border-color: #000;
		}

		.footer-bottom .btn.email:hover {
			background: transparent;
			color: #0e3c55;
			border-color: #0e3c55;
		}

		@media (max-width: 1024px) {
			.footer-container {
				flex-direction: column;
			}

			.footer-row {
				gap: 1.5rem;
			}
		}

		@media (max-width: 768px) {
			.footer-col {
				min-width: 100%;
			}

			.footer-top-row,
			.footer-bottom-content {
				flex-direction: column;
				align-items: flex-start;
				gap: 1.5rem;
			}

			.footer-contact-buttons {
				width: 100%;
				flex-direction: column;
				gap: 1rem;
			}

			.footer-menu-row ul {
				flex-direction: column;
				gap: 1rem;
			}

			.newsletter-form {
				flex-direction: column;
			}
		}
	</style>
</footer>