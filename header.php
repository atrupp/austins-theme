<?php
/**
 * The header for our theme
 *
 * @package Austin's_Theme
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="masthead" class="site-header">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" rel="home">
		<img
			src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/logo.png"
			alt="<?php bloginfo( 'name' ); ?>"
			class="site-logo-img"
		>
	</a>
	<?php if ( ! empty( $GLOBALS['site_back_btn'] ) ) : ?>
		<?php echo $GLOBALS['site_back_btn']; ?>
	<?php endif; ?>
</header>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'austins-theme' ); ?></a>
