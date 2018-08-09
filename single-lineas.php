<?php get_header() ?>

<?php while(have_posts()):the_post();  ?>

<section class="main">

<section class="info linea">
    <div class="info-1" style="background-image: url(<?php echo get_template_directory_uri() . '/img/texture.png'?>); background-color: <?php echo get_post_meta( get_the_ID(),'posmon_campos_lineas_color_principal', true)?>;">
        <div class="container-fluid">
            <div class="flexslider flexslider-big">
                <ul class="slides">
                    <li class="slider main">
                        <div class="sub-background" style="background-image: url(<?php echo get_post_meta( get_the_ID(),'posmon_campos_lineas_slider_principal_fondo_image', true)?>)"></div>
                        <div class="row contenedor">
                            <div class="texto col-md-6 col-sm-12">
                                <div class="content">
                                    <div class="titulo">
                                        <h1 class="big-title" style="color: <?php echo get_post_meta( get_the_ID(),'posmon_campos_lineas_color_titulo_slider_principal', true) ?>"><?php the_title() ?></h1>
                                    </div>
                                    <?php
                                    $main_desc = get_post_meta( get_the_ID(),'posmon_campos_lineas_slider_principal_desc', true);
                                    if($main_desc) { 
                                    ?>
                                        <p class="descripcion" style="color: <?php echo get_post_meta( get_the_ID(),'posmon_campos_lineas_color_desc_slider_principal', true) ?>"><?php echo $main_desc ?></p>
                                    <?php } ?>
                                </div>
                                    
                            </div>
                            <div class="imagen col-md-6 col-sm-12">
                                <?php
                                    $main_modelo = get_post_meta( get_the_ID(),'posmon_campos_lineas_slider_principal_modelo_image', true);
                                    if($main_modelo) { 
                                ?>
                                    <img src="<?php echo $main_modelo ?>" alt="">
                                <?php } ?>
                            </div>
                        </div>
                    </li>

                    <?php 
                        $sliders = get_post_meta( get_the_ID(), 'posmon_campos_lineas_sliders_group', true );

                        foreach ( (array) $sliders as $key => $slider ) {
                        
                            $type = $title = $col_title = $desc = $col_desc = $imagen = $imagen_modelo = '';
                        
                            if ( isset( $slider['type'] ) ) {
                                $type = esc_html( $slider['type'] );
                            }

                            if ( isset( $slider['title'] ) ) {
                                $title = wpautop( $slider['title'] );
                            }

                            if ( isset( $slider['color_title'] ) ) {
                                $col_title = esc_html( $slider['color_title'] );
                            }

                            if ( isset( $slider['desc'] ) ) {
                                $desc = esc_html( $slider['desc'] );
                            }

                            if ( isset( $slider['color_desc'] ) ) {
                                $col_desc = esc_html( $slider['color_desc'] );
                            }

                            if ( isset( $slider['image'] ) ) {
                                $imagen = esc_html( $slider['image'] );
                            }

                            if ( isset( $slider['image_modelo'] ) ) {
                                $imagen_modelo = esc_html( $slider['image_modelo'] );
                            }

                            if( $title && $imagen ) {

                                if ( $type == 'blur-bg' ) { ?>
                                    <li class="slider blur-bg" style="background-image: url(<?php echo $imagen ?>)">
                                        <div class="row contenedor">
                                            <div class="texto col-md-6">
                                                <div class="content">
                                                    <div class="titulo">
                                                        <h1 class="med-title" style="color: <?php echo $col_title ?>"><?php echo $title ?></h1>
                                                    </div>
                                                    <p class="descripcion" style="color: <?php echo $col_desc ?>"><?php echo $desc ?></p>
                                                </div>
                                            </div>
                                            <div class="imagen col-md-6">
                                                <img src="<?php echo $imagen_modelo ?>" alt="">
                                            </div>
                                        </div>
                                    </li>
                                <?php 
                                } else if ($type == 'full-bg' ) { ?>
                                    <li class="slider full-bg" style="background-image: url(<?php echo $imagen ?>)">
                                        <div class="row contenedor">
                                            <div class="texto col-md-12">
                                                <div class="content">
                                                    <div class="titulo">
                                                        <h1 class="med-title" style="color: <?php echo $col_title ?>"><?php echo $title ?></h1>
                                                    </div>
                                                    <p class="descripcion" style="color: <?php echo $col_desc ?>"><?php echo $desc ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php 
                                } else if ($type == 'half-img' ) { ?>
                                    <li class="slider half-img">
                                        <div class="row contenedor">
                                            <div class="texto col-md-5">
                                                <div class="content">
                                                    <div class="titulo">
                                                        <h1 class="med-title" style="color: <?php echo $col_title ?>"><?php echo $title ?></h1>
                                                    </div>

                                                    <p class="descripcion" style="color: <?php echo $col_desc ?>"><?php echo $desc ?></p>
                                                </div>	
                                            </div>
                                            <div class="imagen col-md-7" style="background-image: url(<?php echo $imagen ?>)"></div>
                                        </div>
                                    </li>
                                <?php 
                                }
                            }
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="info-2" style="background-image: url(<?php echo get_template_directory_uri() . '/img/texture.png'?>); background-color: <?php echo get_post_meta( get_the_ID(),'posmon_campos_lineas_color_secundario', true)?>;">
        <div class="catalog-button">
            <div class="sub-container">
                    <div class="icon">
                            <i class="fa fa-chevron-circle-down"></i>
                        </div>
                <p>Ver catálogo</p>
            </div>
        </div>
    </div>
</section>

<section class="catalogo catalogo-salud">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="titulo-catalogo" style="color: <?php echo get_post_meta( get_the_ID(),'posmon_campos_lineas_color_catalogo', true) ?>">Catálogo <?php the_title() ?></h2>
            </div>
        </div>

        <div class="row">
            <div class="catalogo col-md-12">

                <?php 
                    global $post;
                    $post_slug = $post->post_name;
                    $lineaID   = get_the_ID();

                    $parent = get_term_by('slug', $post_slug, 'linea-categoria');

                    if ($parent) {
                        $parentId = $parent->term_id;

                        $categorias = get_terms(array(
                            'taxonomy'      => 'linea-categoria',
                            'hide_empty'    => true, 
                            'parent'        => $parentId,
                        ));
                    
                        foreach ($categorias as $categoria) {
                            ?>
                                <div class="item">
                                    <div class="row header">
                                        <div class="sesg" style="background: <?php echo get_post_meta( get_the_ID(),'posmon_campos_lineas_color_catalogo', true) ?>">
                                        </div>
                                        <div class="textos">
                                            <h3><?php echo mb_strtolower($categoria->name) ?></h3>
                                            <p><?php echo mb_strtolower($categoria->description) ?></p>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <div class="product-category-grid">
                                            <div class="grid">
                                                <div id="itemContainer_<?php echo $categoria->term_id ?>" class="row items">
                                                    
                                                    <?php 
                                                        $args = array(
                                                            'posts_per_page' => -1,
                                                            'post_type' 	=> 'productos',
                                                            'tax_query' 	=> array(
                                                                'relation' => 'AND',
                                                                array(
                                                                    'taxonomy' 	=> 'linea-categoria',
                                                                    'field' 	=> 'slug',
                                                                    'terms'		=> array( $post_slug ),
                                                                ),
                                                                array(
                                                                    'taxonomy' 	=> 'linea-categoria',
                                                                    'field' 	=> 'slug',
                                                                    'terms'		=> array( $categoria->slug ),
                                                                ),
                                                            ),
                                                        );
                                                        
                                                        $productos = new WP_Query( $args );

                                                        if($productos->have_posts()) {
                                                            while($productos->have_posts()): $productos->the_post();
                                                                ?>
                                                                    <li class="col-lg-3 col-md-4 col-sm-6 item-container">
                                                                        <div class="item" id-producto="<?php the_ID() ?>" onmouseover="this.style.border='1px solid <?php echo get_post_meta( $lineaID,'posmon_campos_lineas_color_catalogo', true) ?>'" onmouseout="this.style.border='1px solid #ddd'">
                                                                            <div class="featured-image">
                                                                                <img src="<?php echo get_post_meta( get_the_ID() ,'posmon_campos_productos_imagen_destacada_producto', true) ?>" alt="">
                                                                            </div>
                                                                            <div class="short-description">
                                                                                <div class="reference">
                                                                                    <span>Ref.</span>
                                                                                    <h3 class="name"><?php echo the_title() ?></h3>
                                                                                </div>
                                                                                <div class="gender">
                                                                                    <?php 
                                                                                        $gender = get_post_meta( get_the_ID() ,'posmon_campos_productos_genero_producto', true);

                                                                                        if ( $gender == 'unisex' ) {
                                                                                            ?>
                                                                                                <div class="icon unisex">
                                                                                                    <i class="fa fa-female"></i>
                                                                                                    <i class="fa fa-male"></i>
                                                                                                </div>
                                                                                                <div class="text">
                                                                                                    unisex
                                                                                                </div>
                                                                                            <?php 
                                                                                        } else if ( $gender == 'femenino' ) {
                                                                                            ?>
                                                                                                <div class="icon">
                                                                                                    <i class="fa fa-female"></i>
                                                                                                </div>
                                                                                                <div class="text">
                                                                                                    femenino
                                                                                                </div>
                                                                                            <?php 
                                                                                        } else {
                                                                                            ?>
                                                                                                <div class="icon">
                                                                                                    <i class="fa fa-male"></i>
                                                                                                </div>
                                                                                                <div class="text">
                                                                                                    masculino
                                                                                                </div>
                                                                                            <?php 
                                                                                        }
                                                                                    ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>

                                                                <?php 
                                                            endwhile; wp_reset_postdata();
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                            
                                            <div class="row paginator">
                                                <nav>
                                                    <a class="control prev arrowPrev">
                                                        <span class="icon-container"><i class="fa fa-angle-left"></i></span>
                                                        <span class="text-container">Anterior</span>
                                                    </a>

                                                    <div class="pages-container holder"></div>

                                                    <a class="control next arrowNext">
                                                        <span class="text-container">Siguiente</span>
                                                        <span class="icon-container"><i class="fa fa-angle-right"></i></span>
                                                    </a>
                                                </nav>
                                            </div>
                                            <div class="loading" style="background-image: url(<?php echo get_template_directory_uri() . '/img/ajax-loader.gif' ?>)"></div>
                                        </div>

                                        <div class="product-category-gallery">
                                            <div class="row controls">
                                                <div class="col-md-5 back-button-container">
                                                    <a class="control back">
                                                        <span class="icon-container" style="background: <?php echo get_post_meta( get_the_ID(),'posmon_campos_lineas_color_catalogo', true) ?>">
                                                            <i class="fa fa-arrow-left"></i>
                                                        </span>
                                                        <span class="text-container" style="color: <?php echo get_post_meta( get_the_ID(),'posmon_campos_lineas_color_catalogo', true) ?>"><p>Volver a <span><?php echo $categoria->name ?></span></p></span>
                                                    </a>
                                                </div>
                                                <nav class="col-md-7 references-nav-controls">
                                                    <a class="control prev" style="color: <?php echo get_post_meta( get_the_ID(),'posmon_campos_lineas_color_catalogo', true) ?>">
                                                        <span class="icon-container"><i class="fa fa-angle-left"></i></span>
                                                        <span class="text-container">Referencia Anterior</span>
                                                    </a>
                                                    <a class="control next" style="color: <?php echo get_post_meta( get_the_ID(),'posmon_campos_lineas_color_catalogo', true) ?>">
                                                        <span class="text-container">Referencia Siguiente</span>
                                                        <span class="icon-container"><i class="fa fa-angle-right"></i></span>
                                                    </a>
                                                </nav>
                                            </div>
                                            <div class="row product-content">
                                                <div class="col-md-5 product-description">
                                                    <div class="row product-name">
                                                        <span class="row">Ref.</span>
                                                        <div class="row">
                                                            <h3 class="name"></h3>
                                                            <div class="gender">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="descripcion"></div>
                                                        
                                                        <h6>Opciones:</h6>
                                                        <ul class="options"></ul>

                                                        <a class="telas-button" href="<?php echo get_permalink( 165 ) ?>\#catalogo-telas" target="_blank">
                                                            <img src="<?php echo get_template_directory_uri() ?>\img\telas.png">
                                                            <span>Catálogo de telas</span>
                                                        </a>
                                                    </div>
                                                    <div class="thumbnail-gallery-container"></div>
                                                </div>
                                                <div class="col-md-7  product-gallery">
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
                                            </div>
                                            <div class="loading" style="background-image: url(<?php echo get_template_directory_uri() . '/img/ajax-loader.gif' ?>)"></div>
                                        </div>

                                        
                                    </div>
                                </div>
                            <?php 
                        }
                    }
				?>
            </div>
        </div>

    </div>
</section>

</section>


<?php endwhile; wp_reset_postdata(); ?>

<?php get_footer() ?>

