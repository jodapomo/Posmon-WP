<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no,
	 initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <?php wp_head() ?>
</head>
<body  <?php body_class(); ?>>
	
	<header>
		<div class="container">
			<div class="row">
				<div class="logo col-sm-6 col-md-2">
					<a href="<?php echo get_home_url( ) ?>">
						<img src="<?php echo cmb2_get_option( 'posmon_admin_main_options', 'logo' ); ?>" alt="">
					</a>
				</div>
				
				<div class="redes col-sm-6 col-md-2 hidden-md hidden-lg">
					<div class="box">
						
						
						<?php 
							$args = array(
								'theme_location' 	=> 'social_menu',
								'container' 		=> 'nav',
								'container_class' 	=> 'sociales',
								'link_before'		=> '<span class="text">',
								'link_after'		=> '</span>'
							);

							wp_nav_menu( $args );
						?>

						<div class="telefono">
							<p><i class="fa fa-phone"></i> <?php echo cmb2_get_option( 'posmon_admin_main_options', 'telefono' );  ?></p>
                            <p><i class="fa fa-whatsapp"></i> <?php echo cmb2_get_option( 'posmon_admin_main_options', 'celular' );  ?></p>
							<p><i class="fa fa-envelope-o"></i> <?php echo cmb2_get_option( 'posmon_admin_main_options', 'email' );  ?></p>
						</div>
						
					</div>
				</div>

				<div class="mobile-menu col-xs-12 hidden-sm hidden-md hidden-lg">
					
					<div class="boton">
						<span class="bar"></span>
						<span class="bar"></span>
						<span class="bar"></span>
					</div>
				
				</div>


				<nav class="menu col-xs-12 col-sm-12 col-md-8">
					<ul class="row">
						<li><a class="inicio" href="<?php echo get_home_url( ) ?>">Inicio</a></li>
						<li><a id="btn-empresa" class="empresa" href="<?php echo get_home_url( ) ?>/#empresa">La Empresa</a></li>
						<li><a class="productos" href="<?php echo get_permalink( get_page_by_path( 'todas-las-lineas' ) ) ?>">Productos</a></li>
						<li><a class="telas" href="<?php echo get_permalink( get_page_by_path( 'insumos' ) ) ?>">Insumos</a></li>
						<li><a id="btn-contacto" class="contacto" href="<?php echo get_home_url( ) ?>/#contacto">Contáctenos</a></li>
					</ul>
				</nav>

				<div class="redes col-md-2 hidden-sm hidden-xs">
					<div class="box">
						
						<?php 
							$args = array(
								'theme_location' 	=> 'social_menu',
								'container' 		=> 'nav',
								'container_class' 	=> 'sociales',
								'link_before'		=> '<span class="text">',
								'link_after'		=> '</span>'
							);

							wp_nav_menu( $args );
						?>

						<!-- <nav class="sociales">
							<a class="facebook" href="https://www.facebook.com"><i class="fa fa-facebook"></i></a>
							<a class="twitter" href="https://www.twitter.com"><i class="fa fa-twitter"></i></a>
							<a class="instagram" href="https://www.instagram.com"><i class="fa fa-instagram "></i></a>
						</nav> -->
						
						<div class="telefono">
							<p><i class="fa fa-phone"></i> <?php echo cmb2_get_option( 'posmon_admin_main_options', 'telefono' );  ?></p>
                            <p><i class="fa fa-whatsapp"></i> <?php echo cmb2_get_option( 'posmon_admin_main_options', 'celular' );  ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>