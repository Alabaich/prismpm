<?php
/**
 * The template for displaying footer.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$is_editor     = isset( $_GET['elementor-preview'] );
$site_name     = get_bloginfo( 'name' );
$tagline       = get_bloginfo( 'description', 'display' );
$footer_class  = did_action( 'elementor/loaded' ) ? hello_get_footer_layout_class() : '';
$footer_nav_menu = wp_nav_menu( [
	'theme_location' => 'menu-2',
	'fallback_cb'    => false,
	'container'      => false,
	'echo'           => false,
] );
?>
<footer id="site-footer" class="site-footer prism-footer">
	<div class="footer-container">
		<div class="footer-left">
			<?php if ( has_custom_logo() ) : ?>
				<div id="ref" class="site-logo"><?php the_custom_logo(); ?></div>
			<?php endif; ?>
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
				<div class="footer-col">
					<h4>Social Media</h4>
					<p><a href="#">Facebook</a><br><a href="#">Instagram</a></p>
				</div>
			</div>

			<div class="footer-row newsletter-row">
				<div class="footer-col full-width">
					<h4>Latest News & Events</h4>
					<form class="newsletter-form" action="#" method="post">
						<input type="email" placeholder="enter your email address" required>
						<button type="submit">Submit <span>&rarr;</span></button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="footer-bottom">
		<div class="footer-copy">
			©2025 by Prism Property Management. All rights reserved. Designed by Enjoyable Agency.
		</div>
		<div class="footer-links">
			<a href="#">Terms of use</a>
			<a href="#">Privacy Policy</a>
			<a href="#">Accessibility</a>
		</div>
	</div>

	<style>
		#site-footer .site-logo img {
	content: url('/wp-content/themes/hello-elementor/assets/images/Logo_foot.png');
}
		#ref {
			color:white;
			fill:white;
		}
		#site-footer {
			max-width:1568px;
			
		}
		.prism-footer {
			background: #0e3c55;
			color: #fff;
			padding: 60px 80px;
		}
		.newsletter-form {
			max-width:780px;
		}

		.footer-container {
			display: flex;
			flex-wrap: wrap;
			justify-content: space-between;
			margin: 0 auto 2rem;
			gap: 3rem;
		}

		.footer-left {
			flex: 1;
		}

		.footer-left .site-logo img {
			height: 108px;
			width: 428px;
			color:white;
			fill:white;
		}

		.footer-right {
			flex: 2;
			display: flex;
			flex-direction: column;
			gap: 2rem;
			min-width: 320px;
			max-width:780px;
		}

		.footer-row {
			display: flex;
			gap: 2rem;
			flex-wrap: wrap;
		}

		.footer-col {
			flex: 1;
			min-width: 180px;
		}

		.footer-col h4 {
			font-size: 14px;
			font-weight: 600;
			margin-bottom: 0.5rem;
			color: #fff;
		}

		.footer-col a {
			color: #fff;
			text-decoration: none;
		}

		.footer-col a:hover {
			text-decoration: underline;
		}

		.newsletter-form {
			display: flex;
			flex-wrap: nowrap;
			gap: 10px;
			margin-top: 10px;
		}

		.newsletter-form input {
			flex: 1;
			padding: 10px 12px;
			border-radius: 30px;
			border: 1px solid #fff;
			background: transparent;
			color: #fff;
		}

		.newsletter-form input::placeholder {
			color: #ccc;
		}

		.newsletter-form button {
			background: #fff;
			color: #0e3c55;
			border: none;
			padding: 10px 18px;
			border-radius: 30px;
			cursor: pointer;
			display: flex;
			align-items: center;
			gap: 5px;
			font-weight: 600;
		}

		.footer-bottom {
			border-top: 1px solid rgba(255,255,255,0.2);
			margin-top: 30px;
			padding-top: 20px;
			display: flex;
			justify-content: space-between;
			flex-wrap: wrap;
			font-size: 12px;
			color: #ccc;
			margin-left: auto;
			margin-right: auto;
		}

		.footer-links a {
			color: #ccc;
			margin-left: 20px;
			text-decoration: none;
		}

		.footer-links a:hover {
			text-decoration: underline;
		}
		@media (max-width: 768px) {
	.prism-footer {
		padding: 40px 20px;
	}

	.footer-container {
		flex-direction: column;
		align-items: center;
		gap: 2rem;
	}

	.footer-left {
		text-align: center;
	}

	.footer-left .site-logo img {
		height: auto;
		width: 220px;
	}

	.footer-right {
		width: 100%;
		max-width: 100%;
	}

	.footer-row {
		flex-direction: column;
		gap: 1.5rem;
	}

	.footer-col {
		width: 100%;
		text-align: center;
	}

	.newsletter-form {
		gap: 10px;
	}

	.newsletter-form input,
	.newsletter-form button {
		text-align: center;
	}

	.footer-bottom {
		flex-direction: column;
		align-items: center;
		text-align: center;
		gap: 10px;
	}

	.footer-links a {
		display: block;
		margin: 5px 0;
	}
}

	</style>
</footer>
