<?php get_header() ?>

<section class="main">
    
    <section class="lineas">
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

    <section class="empresa">
        <div class="contenedor-titulo">
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
                    <p>Somos una empresa Colombiana con más de una década de trayectoria en el mercado en la línea de uniformes y accesorios para el área de la salud, Con un estilo de vanguardia. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi atque consectetur dolorum possimus debitis, odio assumenda quod, eos facere autem sunt reprehenderit facilis pariatur cumque distinctio officiis enim itaque perspiciatis.</p>
                </div>
            </div>

            <div class="valores row">
                <div class="titulo col-md-12">
                    <h3 class="titulo">Nuestos Valores</h3>
                </div>
                <ul class="row">
                    <li class="col-sm-6 col-md-3">
                        <p class="val1">honestidad</p>
                    </li>
                    <li class="col-sm-6 col-md-3">
                        <p class="val2">organización</p>
                    </li>
                    <li class="col-sm-6 col-md-3">
                        <p class="val3">excelencia</p>
                    </li>
                    <li class="col-sm-6 col-md-3">
                        <p class="val4">servicio</p>
                    </li>
                </ul>
            </div>

            <div class="mision-vision row">
                <div class="col-md-6">
                        <div class="mision">
                            <h3 class="titulo">Misión</h3>
                            <p>Somos una empresa Colombiana con más de una década de trayectoria en el mercado en la línea de uniformes y accesorios para el área de la salud, Con un estilo de vanguardia.</p>
                        </div>
                </div>

                <div class="col-md-6">
                        <div class="vision">
                            <h3 class="titulo">Visión</h3>
                            <p>Somos una empresa Colombiana con más de una década de trayectoria en el mercado en la línea de uniformes y accesorios para el área de la salud, Con un estilo de vanguardia.</p>
                        </div>
                </div>
            </div>
        </div>
    </section>
        
    <section class="contacto">

        <div class="contenedor-titulo">
            <div class="container">
                <div class="row textos">
                    <div class="col-md-12">
                        <h2 class="titulo">Contáctenos</h2>
                    </div>
                </div>
            </div>
            <!-- <div class="logo">
                <img src="img/logo-gray.png" alt="">
            </div> -->
        </div>

        <div class="container">
            <div class="row">
                <div class="contenedor-datos col-md-12">
                    <div class="datos">
                        <div class="logo">
                            <img src="img/logo.png" alt="">
                        </div>
                        
                        <div class="textos">
                            <strong>Uniformes Posmon</strong>
                            <p><i class="fa fa-envelope-o"></i> posmon@posmon.com</p>
                            <p><i class="fa fa-phone"></i> +57(4) 2569781</p>
                            <p><i class="fa fa-whatsapp"></i> 316 402 4564</p>
                            <p><i class="fa fa-map-marker"></i> Medellín - Colombia</p>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <form class="formulario row">
                        <div class="col-md-6">
                            <input class="input-6" type="text" placeholder="Nombre y Apellido" name="nombre" required>
                        </div>
                        <div class="col-md-6">
                            <input class="input-6" type="email" placeholder="Correo" name="correo" required>
                        </div>
                        <div class="col-md-6">
                            <input class="input-6" type="text" placeholder="Ciudad" name="ciudad" required>
                        </div>
                        <div class="col-md-6">
                            <input class="input-6" type="text" placeholder="Teléfono" name="telefono" required>
                        </div>
                        <div class="col-md-12">
                            <input type="text" placeholder="Asunto" name="asunto">
                        </div>
                        <div class="col-md-12">
                            <textarea name="mensaje" placeholder="Mensaje"></textarea>
                        </div>
                        <div class="col-md-12">
                            <input class="boton" type="submit" value="Enviar">
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>

</section>

<?php get_footer() ?>