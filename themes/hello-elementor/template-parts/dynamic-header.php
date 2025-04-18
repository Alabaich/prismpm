<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! hello_get_header_display() ) {
	return;
}

$is_editor = isset( $_GET['elementor-preview'] );
$site_name = get_bloginfo( 'name' );
$tagline   = get_bloginfo( 'description', 'display' );
$header_class = did_action( 'elementor/loaded' ) ? hello_get_header_layout_class() : '';
$menu_args = [
	'theme_location' => 'menu-1',
	'fallback_cb' => false,
	'container' => false,
	'echo' => false,
];
$header_nav_menu = wp_nav_menu( $menu_args );
$header_mobile_nav_menu = wp_nav_menu( $menu_args ); 
?>

<header id="site-header" class="headr site-header dynamic-header <?php echo esc_attr( $header_class ); ?>">
	<div class="headr-container">
		
		<div class="left-block">
			<div class="headr-logo site-branding show-<?php echo esc_attr( hello_elementor_get_setting( 'hello_header_logo_type' ) ); ?>">
				<?php if ( has_custom_logo() ) : ?>
					<div class="site-logo">
						<?php the_custom_logo(); ?>
					</div>
				<?php endif; ?>
			</div>

			<?php if ( $header_nav_menu ) : ?>
				<nav class="site-navigation headr-nav" aria-label="<?php echo esc_attr__( 'Main menu', 'hello-elementor' ); ?>">
					<?php echo $header_nav_menu; ?>
				</nav>
			<?php endif; ?>
		</div>

		<div class="right-block">
			<a class="btn phone" href="tel:2894992632">
				<i class="fa fa-phone"></i> 289.499.2632
			</a>
			<a class="btn email" href="mailto:lease@prismpm.ca">
				lease@prismpm.ca
			</a>
		</div>
	</div>

	<?php if ( $header_mobile_nav_menu ) : ?>
		<div class="site-navigation-toggle-holder">
			<button type="button" class="site-navigation-toggle" aria-label="<?php echo esc_attr( 'Menu', 'hello-elementor' ); ?>">
				<span class="site-navigation-toggle-icon" aria-hidden="true"></span>
			</button>
		</div>

		<nav class="site-navigation-dropdown" aria-label="<?php echo esc_attr__( 'Mobile menu', 'hello-elementor' ); ?>" aria-hidden="true" inert>
			<?php echo $header_mobile_nav_menu; ?>
		</nav>
	<?php endif; ?>

	<style>
		#site-header{
			max-width:1728px;
			margin:auto;
			border-radius:8px;
		}
	.headr {
		position: fixed;
		top: 0;
		left: 0;
		right: 0;
		z-index: 1000;
		background: transparent;
		box-shadow: 0 2px 8px rgba(0,0,0,0.06);
		padding: 2rem;
		padding-bottom:1.5rem;
	}

	.headr-container {
		padding-top:1rem;
		display: flex;
		align-items: center;
		justify-content: space-between;
		margin: 0 auto;
		width: 100%;
	}

	.left-block {
		display: flex;
		align-items: center;
		gap: 2rem;
		flex-shrink: 0;
	}

	.headr-logo img {
		max-height: 40px;
	}

	.headr-nav {
		display: flex;
		gap: 1.5rem;
	}

	.headr-nav a {
		color: #2A2A2A;
		text-decoration: none;
		font-weight: 500;
	}

	.right-block {
		margin-left: auto; 
		display: flex;
		align-items: center;
		gap: 1rem;
	}

	.btn {
		display: inline-flex;
		align-items: center;
		padding: 0.5rem 1.2rem;
		border-radius: 999px;
		font-size: 0.9rem;
		font-weight: 500;
		text-decoration: none;
		white-space: nowrap;
	}

	.phone {
		background: #f4f4f4;
		display:flex;
		align-items:center;
		gap:4px;
		color: #000;
	}

	.email {
		background: #0e3c55;
		color: #fff;
	}

	.email:hover,
	.phone:hover {
		opacity: 0.9;
	}
	.email:hover {
		background: #0e3c55;
		color: #fff;
	}
	.phone:hover {
		background: #f4f4f4;
		color: #000;
	}
</style>

</header>
