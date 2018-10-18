<?php get_header() ?>

<?php while(have_posts()):the_post();  ?>

<section class="main">

<div class="container single-product mobile">
    <div class="row product-content">
        <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 col-lg-push-5 product-gallery">
            <div class="big-image-container">
                <img src="">
                <div class="controls-container">
                    <div class="control prev">
                        <i class="fa fa-angle-left"></i>
                    </div>
                    <div class="control next">
                        <i class="fa fa-angle-right"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 col-lg-pull-7 product-description">
            <div class="row product-name">
                <?php 
                    $id = get_the_ID();
                    $gender = get_post_meta( $id , 'posmon_campos_productos_genero_producto', true );
                ?>
                <span class="row">Ref.</span>
                <div class="row">
                    <h3 class="name" <?php if ( $gender == "oculto" ) { echo "style='width: 100%'";} ?>><?php the_title() ?></h3>
                    <?php

                        if ( $gender != "oculto" ) {
                            ?>

                            <div class="gender">
                                <?php if ( $gender == "unisex" ) { ?>
                                    <div class="icon unisex">
                                        <i class="fa fa-female"></i>
                                        <i class="fa fa-male"></i>
                                    </div>
                                    <div class="text">unisex</div>
                                <?php } else if ( $gender == "femenino" ) { ?>
                                    <div class="icon">
                                        <i class="fa fa-female"></i>
                                    </div>
                                    <div class="text">femenino</div>
                                <?php } else if ( $gender == "masculino" ) { ?>
                                    <div class="icon">
                                        <i class="fa fa-male"></i>
                                    </div>
                                    <div class="text">masculino</div>
                                <?php } ?>
                            </div>
                            <?php 
                        }
                    ?>
                    
                </div>
            </div>
            <div class="product-details row">
                <div class="descripcion"><?php echo posmon_producto_desc(); ?></div>
                
                <h6>Opciones:</h6>
                <ul class="options">
                    <?php 
                        $options = posmon_producto_opciones();

                        foreach ($options as $option) {
                            ?>
                                <li><?php echo $option ?></li>
                            <?php 
                        }
                    ?>
                </ul>

                <div class="button-container">

                    <?php if ( posmon_producto_boton_telas() == 'si') { ?>
                        <a class="telas-button" href="<?php echo get_permalink( get_page_by_path( 'insumos' ) ) ?>\#catalogo-telas" target="_blank">
                            <img src="<?php echo get_template_directory_uri() ?>\img\telas.png">
                            <span>Catálogo de telas</span>
                        </a>
                    <?php } ?>
                    <a class="contacto-button" href="<?php echo get_home_url( ) ?>/#contacto" target="_blank">
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        <span>Contacto</span>
                    </a>
                </div>
                
            </div>
            <div class="thumbnail-gallery-container">
                <?php 
                    $gallery = posmon_producto_galeria();

                    if ($gallery != "") {
                        $fullSizeImage = $gallery['galeria'];
                        $thumbnails = $gallery['thumbnails'];

                        foreach ($fullSizeImage as $key => $image) {
                            ?>
                                <a class="product-thumbnail" full-image="<?php echo $image ?>">
                                    <img src="<?php echo $thumbnails[$key][0] ?>">
                                </a>
                            <?php 
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</div>

</section>


<?php endwhile; wp_reset_postdata(); ?>

<?php get_footer() ?>

