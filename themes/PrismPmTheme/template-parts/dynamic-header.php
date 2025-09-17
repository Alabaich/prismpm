<?php
if (! defined('ABSPATH')) {
	exit;
}

if (! hello_get_header_display()) {
	return;
}

$is_editor = isset($_GET['elementor-preview']);
$site_name = get_bloginfo('name');
$tagline   = get_bloginfo('description', 'display');
$header_class = did_action('elementor/loaded') ? hello_get_header_layout_class() : '';
$menu_args = [
	'theme_location' => 'menu-1',
	'fallback_cb' => false,
	'container' => false,
	'echo' => false,
];
$header_nav_menu = wp_nav_menu($menu_args);
$header_mobile_nav_menu = wp_nav_menu($menu_args);
?>

<style>
	@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap');
	
	.headr {
		position: fixed;
		top: 0;
		left: 0;
		right: 0;
		z-index: 1000;
		background: #fff;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
		padding: 1rem 0;
		transition: all 0.3s ease;
		font-family: 'Playfair Display', serif;
	}

	.headr-container {
		display: flex;
		align-items: center;
		width: 100%;
		padding: 0 10%;
		box-sizing: border-box;
	}

	.left-block {
		display: flex;
		align-items: center;
		gap: 2rem;
		flex: 1;
	}

	.right-block {
		display: flex;
		align-items: center;
		gap: 8px;
		margin-left: auto;
	}

	.right-block .btn.phone {
		display: flex;
		gap: 8px;
	}

	.headr-logo {
		display: flex;
		align-items: center;
	}

	.site-logo {
		max-width: 180px;
		width: 100%;
		height: auto;
	}

	.site-logo img {
		width: 100%;
		height: auto;
		max-height: 50px;
		object-fit: contain;
		transition: all 0.3s ease;
	}

	.headr-nav {
		display: flex;
		gap: 1.5rem;
	}

	.headr-nav a {
		color: #2A2A2A;
		text-decoration: none;
		font-family: 'Playfair Display', serif;
		font-weight: 400;
		font-style: normal;
		font-size: 16px;
		line-height: 1;
		transition: color 0.2s ease;
	}

	.headr-nav a:hover {
		color: #0e3c55;
	}

	.headr .btn {
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
		line-height: 1;
		letter-spacing: 0;
		vertical-align: middle;
		white-space: nowrap;
	}

	.headr .btn.phone {
		background: #f4f4f4;
		color: #000;
		border-color: transparent;
	}

	.headr .btn.email {
		background: #0e3c55;
		color: #fff;
		border-color: #0e3c55;
	}

	.headr .btn.phone:hover {
		background: transparent;
		color: #000;
		border-color: #000;
	}

	.headr .btn.email:hover {
		background: transparent;
		color: #0e3c55;
		border-color: #0e3c55;
	}

	.is-first-page .headr {
		background: transparent;
		box-shadow: none;
	}

	.is-first-page .headr .headr-nav a {
		color: #fff;
	}

	.is-first-page .headr .btn.phone {
		background: rgba(255, 255, 255, 0.1);
		color: #fff;
		border-color: rgba(255, 255, 255, 0.2);
	}

	.is-first-page .headr .btn.email {
		background: #fff;
		color: #0e3c55;
		border-color: #fff;
	}

	.is-first-page .headr .btn.phone:hover {
		background: transparent;
		color: #fff;
		border-color: rgba(255, 255, 255, 0.2);
	}

	.is-first-page .headr .btn.email:hover {
		background: transparent;
		color: #fff;
		border-color: #fff;
	}

	.is-first-page .headr .site-logo img {
		filter: brightness(0) invert(1);
	}

	.site-navigation-toggle-holder {
		display: none;
		margin-left: 15px;
	}

	.site-navigation-toggle {
		background: none !important;
		border: none !important;
		padding: 0 !important;
		cursor: pointer;
		display: flex;
		align-items: center;
		justify-content: center;
		width: 24px;
		height: 24px;
	}

	.site-navigation-toggle svg {
		width: 100%;
		height: 100%;
	}

	.site-navigation-toggle svg path {
		stroke: #1E1E1E;
		transition: stroke 0.3s ease;
	}

	.is-first-page .site-navigation-toggle svg path {
		stroke: #fff;
	}

	.site-navigation-dropdown {
		position: fixed;
		top: 80px;
		left: 0;
		right: 0;
		background: #fff;
		z-index: 999;
		max-height: 0;
		overflow: hidden;
		transition: max-height 0.3s ease;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
	}

	.is-first-page .site-navigation-toggle svg {
		stroke: #fff !important;
	}

	.site-navigation-toggle {
		opacity: 1 !important;
		visibility: visible !important;
	}

	.site-navigation-dropdown[aria-hidden="false"] {
		max-height: calc(100vh - 80px);
		overflow-y: auto;
	}

	@media (max-width: 1600px) {
		.headr-container {
			padding: 0 25px;
		}
	}

	@media (max-width: 1024px) {
		.headr {
			padding: 1rem 0;
		}

		.headr-nav {
			display: none;
		}

		.site-logo {
			max-width: 150px;
		}

		.headr .btn {
			padding: 8px 16px;
			font-size: 0.9rem;
		}
	}

	@media (max-width: 768px) {
		.headr-container {
			padding: 0 15px;
			flex-wrap: nowrap;
		}

		.site-logo {
			max-width: 120px;
			display: block !important;
		}

		.right-block {
			margin-left: auto;
			margin-top: 0;
			order: 2;
			width: auto;
		}

		.site-navigation-toggle-holder {
			display: block;
			order: 3;
		}

		.headr .btn {
			padding: 6px 12px;
			font-size: 0.8rem;
		}

		.headr .btn span {
			display: inline;
		}

		.site-navigation-dropdown {
			top: 70px;
		}

		.site-navigation-dropdown[aria-hidden="false"] {
			max-height: calc(100vh - 70px);
		}
	}

	@media (max-width: 480px) {
		.headr {
			padding: 0.8rem 0;
		}

		.headr-container {
			padding: 0 10px;
		}

		.site-logo {
			max-width: 100px;
		}

		.headr .btn {
			padding: 6px;
			min-width: 36px;
			height: 36px;
			font-size: 0;
		}

		.headr .btn.phone span,
		.headr .btn.email span {
			display: none;
		}

		.headr .btn.email {
			display: none;
		}

		.headr .btn.phone svg {
			margin: 0;
		}

		.site-navigation-dropdown {
			top: 60px;
		}

		.site-navigation-dropdown[aria-hidden="false"] {
			max-height: calc(100vh - 60px);
		}
	}

	.site-navigation-toggle-holder {
		display: none;
		margin-left: 15px;
	}

	.site-navigation-toggle {
		background: none;
		border: none;
		padding: 0;
		cursor: pointer;
		display: flex;
		align-items: center;
		justify-content: center;
		width: 36px;
		height: 36px;
	}

	.site-navigation-toggle svg {
		width: 100%;
		height: 100%;
		stroke: #1E1E1E;
		transition: stroke 0.3s ease;
	}

	.is-first-page .site-navigation-toggle svg {
		stroke: #fff;
	}

	.site-navigation-toggle-holder .site-navigation-toggle {
		background: none;
	}

	@media (max-width: 768px) {
		.site-navigation-toggle-holder {
			display: block;
			order: 3;
			margin-left: 8px;
		}
	}

	@media (max-width: 480px) {
		.site-navigation-toggle-holder {
			margin-left: 4px;
		}
	}
</style>

<header id="site-header" class="headr site-header dynamic-header <?php echo esc_attr($header_class); ?>">
	<div class="headr-container">
		<div class="left-block">
			<div class="headr-logo site-branding show-<?php echo esc_attr(hello_elementor_get_setting('hello_header_logo_type')); ?>">
				<?php if (has_custom_logo()) : ?>
					<div class="site-logo">
						<?php the_custom_logo(); ?>
					</div>
				<?php endif; ?>
			</div>

			<?php if ($header_nav_menu) : ?>
				<nav class="site-navigation headr-nav" aria-label="<?php echo esc_attr__('Main menu', 'hello-elementor'); ?>">
					<?php echo $header_nav_menu; ?>
				</nav>
			<?php endif; ?>
		</div>

		<div class="right-block">
			<a class="btn phone" href="tel:2894992632">
				<svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M15.1467 12.72C15.1467 12.96 15.0934 13.2067 14.98 13.4467C14.8667 13.6867 14.72 13.9134 14.5267 14.1267C14.2 14.4867 13.84 14.7467 13.4334 14.9134C13.0334 15.08 12.6 15.1667 12.1334 15.1667C11.4534 15.1667 10.7267 15.0067 9.96004 14.68C9.19337 14.3534 8.42671 13.9134 7.66671 13.36C6.90004 12.8 6.17337 12.18 5.48004 11.4934C4.79337 10.8 4.17337 10.0734 3.62004 9.31337C3.07337 8.55337 2.63337 7.79337 2.31337 7.04004C1.99337 6.28004 1.83337 5.55337 1.83337 4.86004C1.83337 4.40671 1.91337 3.97337 2.07337 3.57337C2.23337 3.16671 2.48671 2.79337 2.84004 2.46004C3.26671 2.04004 3.73337 1.83337 4.22671 1.83337C4.41337 1.83337 4.60004 1.87337 4.76671 1.95337C4.94004 2.03337 5.09337 2.15337 5.21337 2.32671L6.76004 4.50671C6.88004 4.67337 6.96671 4.82671 7.02671 4.97337C7.08671 5.11337 7.12004 5.25337 7.12004 5.38004C7.12004 5.54004 7.07337 5.70004 6.98004 5.85337C6.89337 6.00671 6.76671 6.16671 6.60671 6.32671L6.10004 6.85337C6.02671 6.92671 5.99337 7.01337 5.99337 7.12004C5.99337 7.17337 6.00004 7.22004 6.01337 7.27337C6.03337 7.32671 6.05337 7.36671 6.06671 7.40671C6.18671 7.62671 6.39337 7.91337 6.68671 8.26004C6.98671 8.60671 7.30671 8.96004 7.65337 9.31337C8.01337 9.66671 8.36004 9.99337 8.71337 10.2934C9.06004 10.5867 9.34671 10.7867 9.57337 10.9067C9.60671 10.92 9.64671 10.94 9.69337 10.96C9.74671 10.98 9.80004 10.9867 9.86004 10.9867C9.97337 10.9867 10.06 10.9467 10.1334 10.8734L10.64 10.3734C10.8067 10.2067 10.9667 10.08 11.12 10C11.2734 9.90671 11.4267 9.86004 11.5934 9.86004C11.72 9.86004 11.8534 9.88671 12 9.94671C12.1467 10.0067 12.3 10.0934 12.4667 10.2067L14.6734 11.7734C14.8467 11.8934 14.9667 12.0334 15.04 12.2C15.1067 12.3667 15.1467 12.5334 15.1467 12.72Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" />
				</svg>
				<span>289.499.2632</span>
			</a>
			<a class="btn email" href="mailto:lease@prismpm.ca">
				lease@prismpm.ca
			</a>

			<?php if ($header_mobile_nav_menu) : ?>
				<div class="site-navigation-toggle-holder">
					<button type="button" class="site-navigation-toggle" aria-label="<?php echo esc_attr('Menu', 'hello-elementor'); ?>">
						<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M31.5 15H10.5M31.5 9H4.5M31.5 21H4.5M31.5 27H10.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
						</svg>
					</button>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<?php if ($header_mobile_nav_menu) : ?>
		<nav class="site-navigation-dropdown" aria-label="<?php echo esc_attr__('Mobile menu', 'hello-elementor'); ?>" aria-hidden="true" inert>
			<?php echo $header_mobile_nav_menu; ?>
		</nav>
	<?php endif; ?>
</header>