<?php get_header() ?>

<section class="main">

    <section class="construccion" style="background-image: url(<?php echo get_template_directory_uri() . '/img/construccion.jpg' ?>)">
        <img src="<?php echo get_template_directory_uri() . '/img/construccion.jpg' ?>" style="visibility: hidden;" />
    </section>
    
    <section class="lineas hidden">
        <div class="container">
            <div class="row">

                <?php 
                    $args = array(
                        'posts_per_page'    => -1,
                        'post_type'         => 'lineas',
                        'order'           => 'ASC',
                    );

                    $lineas = new WP_Query( $args );
                ?>
                    
                
                <?php while($lineas->have_posts()): $lineas->the_post(); ?>

                <div class="linea col-sm-6 col-md-4">
                    <div class="contenedor">
                        <a href="<?php the_permalink() ?>">
                            <div class="fondo">
                                <?php
                                    $fondo = get_post_meta( get_the_ID(),'posmon_campos_lineas_index_bg_image', true);
                                    if($fondo) { 
                                ?>
                                    <img src="<?php echo $fondo ?>" alt="">

                                <?php } ?>
                            </div>
                            <div class="nombre" style="background: <?php echo get_post_meta( get_the_ID(),'posmon_campos_lineas_color_principal', true) ?>;">
                                <h2><?php the_title() ?></h2>
                            </div>

                            <?php 
                                $offset = intval(get_post_meta( get_the_ID(),'posmon_campos_lineas_index_pos_modelo', true));
                            
                                $left = 35 + $offset;
                            
                            ?>

                            <div class="persona" style="left: <?php echo $left ?>%">
                                <?php 
                                    $modelo = get_post_meta( get_the_ID(),'posmon_campos_lineas_index_modelo_image', true);
                                    if($modelo) { 
                                ?>
                                    <img src="<?php echo $modelo ?>" alt="">

                                <?php } ?>
                            </div>
                        </a>
                    </div>
                </div>

                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>

    <section class="empresa" id="empresa">
        <div class="contenedor-titulo" style="background-image: url(<?php echo cmb2_get_option( 'posmon_admin_empresa_options', 'fondo_empresa' );  ?>)">
            <div class="container">
                <div class="row textos">
                    <div class="col-md-12">
                        <h2 class="titulo">La Empresa</h2>
                    </div>
                </div>
            </div>
            <!-- <div class="logo">
                <img src="img/logo-gray.png" alt="">
            </div> -->
        </div>

        <div class="container">

            <div class="quienes-somos row">
                <div class="titulo col-md-12">
                    <h3 class="titulo">¿Quiénes Somos?</h3>
                </div>

                <div class="parrafo col-md-12">
                    <?php echo wpautop(cmb2_get_option( 'posmon_admin_empresa_options', 'quienes_somos' ));  ?>
                </div>
            </div>

            <div class="quienes-somos row">
                <div class="titulo col-md-12">
                    <h3 class="titulo">Nuestra Historia</h3>
                </div>

                <div class="parrafo col-md-12">
                    <?php echo wpautop(cmb2_get_option( 'posmon_admin_empresa_options', 'historia' ));  ?></p>
                </div>
            </div>

            <div class="valores row">
                <div class="titulo col-md-12">
                    <h3 class="titulo">Nuestos Valores</h3>
                </div>
                <ul class="row">

                    <?php 
                        $valores = cmb2_get_option( 'posmon_admin_empresa_options', 'nuestros_valores' );
                        
                        foreach ($valores as $value) { ?>
                            <li>
                                <p  class="valor"><?php echo mb_strtolower( $value['valor'] ) ?></p>
                                <div class="descripcion-valor-responsive hidden-lg hidden-md">
                                    <?php echo wpautop($value['desc'] ) ?>
                                </div>
                            </li>
                        <?php 
                        }
                    ?>
                </ul>
                <div class="descripcion-valor hidden-sm hidden-xs">
                    <?php 
                        $valores = cmb2_get_option( 'posmon_admin_empresa_options', 'nuestros_valores' );

                        foreach ($valores as $index => $value) { ?>
                            <p class="<?php if ($index != 0){ echo "hidden"; }  ?>"><?php echo $value['desc'] ?></p>
                        <?php 
                        }
                    ?>
                </div>
            </div>

            <div class="mision-vision row">
                <div class="col-md-6">
                        <div class="mision">
                            <h3 class="titulo">Misión</h3>
                            <p><?php echo cmb2_get_option( 'posmon_admin_empresa_options', 'mision' );  ?></p>
                        </div>
                </div>

                <div class="col-md-6">
                        <div class="vision">
                            <h3 class="titulo">Visión</h3>
                            <p><?php echo cmb2_get_option( 'posmon_admin_empresa_options', 'vision' );  ?></p>
                        </div>
                </div>
            </div>
        </div>
    </section>
        
    <section class="contacto" id="contacto">

        <div class="contenedor-titulo" style="background-image: url(<?php echo cmb2_get_option( 'posmon_admin_main_options', 'fondo_contacto' );  ?>)">
            <div class="container">
                <div class="row textos">
                    <div class="col-md-12">
                        <h2 class="titulo">Contáctenos</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="contenedor-datos col-md-12">
                    <div class="datos">
                        <div class="logo">
                            <img src="<?php echo cmb2_get_option( 'posmon_admin_main_options', 'logo' ); ?>" alt="">
                        </div>
                        
                        <div class="textos">
                            <strong>Uniformes Posmon</strong>
                            <p><i class="fa fa-envelope-o"></i> <?php echo cmb2_get_option( 'posmon_admin_main_options', 'email' );  ?></p>
                            <p><i class="fa fa-phone"></i> <?php echo cmb2_get_option( 'posmon_admin_main_options', 'telefono' );  ?></p>
                            <p><i class="fa fa-whatsapp"></i> <?php echo cmb2_get_option( 'posmon_admin_main_options', 'celular' );  ?></p>
                            <p><i class="fa fa-map-marker"></i> <?php echo cmb2_get_option( 'posmon_admin_main_options', 'ciudad_pais' );  ?></p>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="formulario row">
                        <?php 
                            $args = array(
                                'post_type' => 'page',
                                'pagename' => 'contacto',
                                );

                            $formulario = new WP_Query( $args );

                            if($formulario->have_posts()) {
                                while($formulario->have_posts()): $formulario->the_post(); 

                                    the_content( );

                                endwhile; wp_reset_postdata();
                            }
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </section>

</section>

<?php get_footer() ?>