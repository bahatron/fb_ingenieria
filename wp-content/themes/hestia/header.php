<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the page header div.
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */
?>
	<!DOCTYPE html>
	<html <?php language_attributes(); ?>>

	<head>
		<meta charset='<?php bloginfo( ' charset ' );?>'>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif; ?>
		<?php wp_head(); ?>
		<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="<?php echo FBINGENIERIA_URL.'/src/assets/dependencies/vuetify.min.css' ?>" rel="stylesheet" type="text/css">
		<script src="<?php echo FBINGENIERIA_URL.'/src/assets/dependencies/vue.min.js' ?>"></script>
		<script src="<?php echo FBINGENIERIA_URL.'/src/assets/dependencies/vuetify.min.js' ?>"></script>
		<?php
		global $FBIngenieria;
    $lang = isset($_GET['lang']) ? $_GET['lang'] : 'es';
		$translations = $FBIngenieria->setLanguage($lang);
	?>
	</head>
	
	<body <?php body_class(); ?>>
		<div class="wrapper">
			<header class="header" id="fbi_header">
				<nav class="navbar navbar-default navbar-transparent navbar-fixed-top navbar-color-on-scroll">
					<div class="container">
						<div class="navbar-header" style="padding:5px;width:100vw">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navigation">
							<span class="sr-only"><?php esc_html_e( 'Toggle Navigation', 'hestia' ); ?></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
							<div class="title-logo-wrapper">
								<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
									<?php echo hestia_logo(); ?>
								</a>
							</div>
						</div>
						<div id="main-navigation" class="navbar-collapse collapse" aria-expanded="false" style="height: 0px;">
							<ul id="menu-header" class="nav navbar-nav navbar-right">
								<li id="menu-item-12" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item menu-item-home menu-item-12 active">
									<a title="Inicio" href="#home"><?php echo $FBIngenieria->translate('home', $lang) ?></a>
								</li>
								<li id="menu-item-13" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item menu-item-home menu-item-13 active">
									<a title="Qué hacemos?" href="#about"><?php echo $FBIngenieria->translate('about-us', $lang) ?></a>
								</li>
								<li id="menu-item-14" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item menu-item-home menu-item-14 active">
									<a title="Por qué nosotros?" href="#whyus"><?php echo $FBIngenieria->translate('why-us', $lang) ?></a>
								</li>
								<li id="menu-item-16" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item menu-item-home menu-item-16 active">
									<a title="Portafolio" href="#portfolio"><?php echo $FBIngenieria->translate('portfolio', $lang) ?></a>
								</li>
								<li id="menu-item-17" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item menu-item-home menu-item-17 active">
									<a title="Trayectoria" href="#journey"><?php echo $FBIngenieria->translate('journey', $lang) ?></a>
								</li>
								<li id="menu-item-15" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item menu-item-home menu-item-15 active">
									<a title="Clientes" href="#clients"><?php echo $FBIngenieria->translate('clients', $lang) ?></a>
								</li>
								<li id="menu-item-18" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item menu-item-home menu-item-18 active">
									<a title="Contacto" href="#contact"><?php echo $FBIngenieria->translate('contact', $lang) ?></a>
									</li>
								<li id="menu-item-19" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item menu-item-home menu-item-19 active">
									<a title="" href="#fbi_footer"><i class="fa fa-map-marker"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</nav>
			</header>
		</div>
	</body>

	<script>
		new Vue({
			el: '#fbi_header',
			data: {
				translations: JSON.parse('<?php echo $translations ?>')
			},
			methods: {
				translate(str) {
					return (this.translations[str]) ? this.translations[str] : str;
				}
			}
		})
	</script>