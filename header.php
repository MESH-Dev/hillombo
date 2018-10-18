<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

<head>

	<meta charset="utf-8">
	<title><?php bloginfo('name'); ?></title>

	<!-- Meta / og: tags -->
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Mobile Specific Metas
	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
	================================================== -->
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

	<!-- Typography & Icon Fonts -->
	<?php

		$primary_font_css = get_field('primary_font_css', 'option');
		$secondary_font_css = get_field('secondary_font_css', 'option');
		$pf_css = '';
		$sf_css = '';

		$font_select = get_field('font_pairing', 'option');
		if ($font_select == 1) {
			echo '<link href="https://fonts.googleapis.com/css?family=Karla:400,700" rel="stylesheet">';
			$sf_css = "font-family: 'Karla', sans-serif;";
			$pf_css = "font-family: 'Karla', sans-serif;";
		} elseif($font_select == 2){
			echo '<link href="https://fonts.googleapis.com/css?family=Quando" rel="stylesheet">';
			echo '<link href="https://fonts.googleapis.com/css?family=Karla:400" rel="stylesheet">';
			$sf_css = "font-family: 'Karla', sans-serif;";
			$pf_css = "font-family: 'Quando', serif;";
		} elseif($font_select == 3){
			echo '<link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">';
			echo '<link href="https://fonts.googleapis.com/css?family=Karla:400" rel="stylesheet">';
			$sf_css = "font-family: 'Karla', sans-serif;";
			$pf_css = "font-family: 'Abel', sans-serif;";
		} elseif($font_select == 4){
			echo '<link href="https://fonts.googleapis.com/css?family=Noto+Serif+KR:300,400" rel="stylesheet">';
			$sf_css = "font-family: 'Noto Serif KR', sans-serif;";
			$pf_css = "font-family: 'Noto Serif KR', sans-serif;";
		} elseif ($font_select == 5) {
			echo '<link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">';
			echo '<link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">';
			$sf_css = "font-family: 'Cabin', sans-serif;";
			$pf_css = "font-family: 'Abril Fatface', serif;";
		} elseif ($font_select == 6) {
			echo '<link href="https://fonts.googleapis.com/css?family=Alfa+Slab+One|Bitter:400,400i,700" rel="stylesheet">';
			$sf_css = "font-family: 'Bitter', serif;";
			$pf_css = "font-family: 'Alfa Slab One', serif;";
		} else {
			echo '<link href="https://fonts.googleapis.com/css?family=Karla:400,700" rel="stylesheet">';
			$sf_css = "font-family: 'Karla', sans-serif;";
			$pf_css = "font-family: 'Karla', sans-serif;";
		};

		// $primary_font = get_field('primary_font_code', 'option');
		// //the_field('primary_font_code', 'option');
		// if($primary_font != '' && $primary_font_css != ''){
		// 	echo $primary_font;
		// }else{
		// 	echo '<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">';
		// }
		// $secondary_font = get_field('secondary_font_code', 'option');
		// //the_field('secondary_font_code', 'option');
		// if($secondary_font != '' && $primary_font_css != ''){
		// 	echo $secondary_font;
		// }else{
		// 	echo '<link href="https://fonts.googleapis.com/css?family=Merriweather:300,400,700" rel="stylesheet">';
		// }

	?>

	<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>

	<?php

		// if($primary_font != '' && $primary_font_css != ''){
		// 	$pf_css = $primary_font_css;
		// }else{
		// 	$pf_css = "font-family: 'Nunito Sans', sans-serif;";
		// }
		//
		// if($secondary_font != '' && $secondary_font_css != ''){
		// 	$sf_css = $secondary_font_css;
		// }else{
		// 	$sf_css = "font-family: 'Merriweather', serif;";
		// }

	?>

	<style>
		.pf,
		.panel.wysiwyg blockquote,
		.panel.wysiwyg blockquote p,
		.panel.wysiwyg,
		.main-navigation,
		#mobileMenuTrigger,
		footer .contact-media p,
		.main-navigation ul li a,
		.main-navigation ul li a,
		input,
		textarea{
			<?php echo $pf_css;?>
		}

		.sf,
		.breadcrumbs,
		.panel.wysiwyg .breadcrumbs,
		.panel.wysiwyg p,
		.panel.wysiwyg ul,
		.panel.wysiwyg li{
			<?php echo $sf_css;?>
		}
	</style>

	<!-- Favicons
	================================================== -->
	<?php
	$logo = get_field('site_logo', 'option');
	$logo_url = $logo['sizes']['medium'];
	$favicon_url = $logo['sizes']['small'];
	?>
	<link rel="shortcut icon" href="<?php echo $favicon_url ?>">
	<link rel="apple-touch-icon" href="<?php echo $favicon_url ?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $favicon_url ?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $favicon_url ?>">

	<!-- Analytics -->
	<?php the_field('google_analytics_code', 'option'); ?>

	<!-- SEO -->
	<?php the_field('google_sitemap_verification', 'option'); ?>
	<?php the_field('bing_sitemap_verification', 'option'); ?>

	<?php
		$primary_color = get_field('primary_color', 'option');
		$secondary_color = get_field('secondary_color', 'option');
		$tertiary_color = get_field('tertiary_color', 'options');
		$custom_color_switch = get_field('custom_color_on_or_off', 'option');
		$custom_footer_color = get_field('custom_footer_color', 'option');
		$wg_center = get_field('wg_center', 'option');
	?>

	<style>
		p.cta{
			/* background-color:<//?php echo $tertiary_color; ?>; */
			color: <?php echo $secondary_color; ?> !important;
		}
		p.cta:hover,
		p.cta:active,
		p.cta:focus{
			/* color: <//?php echo $tertiary_color; ?> !important; */
		}
		.main-navigation ul{
			background-color: <?php echo $primary_color; ?>;
		}
		input[type="submit"]{
			color: <?php if($custom_color_switch){echo $custom_footer_color;}else{echo $primary_color;};?>;
		}
		#sidebar h3{
			color:<?php echo $primary_color; ?>;
		}
		#sidebar input[type="submit"]{
			background-color:<?php echo $primary_color; ?>;
			color:#fff;
			border-color:<?php echo $primary_color; ?>;
		}
		#sidebar input[type="submit"]:hover{
			color:<?php echo $primary_color; ?>;
			background-color: #fff;
		}
		.panel.wysiwyg a{
			color: <?php echo $tertiary_color; ?>;
		}
		.panel.wysiwyg h1{
			color: <?php echo $primary_color; ?>;
		}
		.panel.wysiwyg h2{
			color: <?php echo $secondary_color; ?>;
		}
		.panel.wysiwyg h3{
			color: <?php echo $tertiary_color; ?>;
		}
		.panel.wysiwyg h4{
			color: <?php echo $primary_color; ?>;
		}
		.panel.wysiwyg h5{
			color: <?php echo $tertiary_color; ?>;
		}
		.panel.wysiwyg h6{
			color: #505050;
		}
		.listing-card h4{
			color: <?php echo $primary_color; ?>;
		}
		.listing-card a{
			color: <?php echo $secondary_color; ?>;
		}
		<?php
		// var_dump($wg_center);
		if ($wg_center) { ?>
			.welcome-gate .sign{
				text-align: center;
			}
		<?php } ?>
	</style>

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
	<?php
	$primary_color = get_field('primary_color', 'option');
	$nav_color_switch = get_field('custom_nav_color_on_or_off', 'option');
	$custom_nav_color = get_field('custom_nav_color', 'option');
	?>
	<header style="background:<?php if($nav_color_switch){echo $custom_nav_color;}else{echo $primary_color;};?>">
		<div class="container">
			<div class="row">
				<div class="columns-12">
					<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img src="<?php echo $logo_url ?>" alt="">
					</a>
					<nav id="main-nav" class="main-navigation">
						<style media="screen">
							.main-navigation ul{
								background-color: <?php if($nav_color_switch){echo $custom_nav_color;}else{echo $primary_color;};?>;
							}
						</style>
						<?php if(has_nav_menu('main_nav')){
									$defaults = array(
										'theme_location'  => 'main_nav',
										'menu'            => 'main_nav',
										'container'       => false,
										'container_class' => '',
										'container_id'    => '',
										'menu_class'      => 'menu',
										'menu_id'         => '',
										'echo'            => true,
										'fallback_cb'     => 'wp_page_menu',
										'before'          => '',
										'after'           => '',
										'link_before'     => '',
										'link_after'      => '',
										'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
										'depth'           => 0,
										'walker'          => ''
									); wp_nav_menu( $defaults );
								}else{
									echo "<p><em>main_nav</em> doesn't exist! Create it and it'll render here.</p>";
								} ?>
								<a id="mobileMenuTrigger">Menu</a>
					</nav>
				</div>
			</div>
		</div>
	</header>
