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

                    $parent = get_term_by('slug', $post_slug, 'linea-categoria');

                    if ($parent) {
                        $parentId = $parent->term_id;

                        $categorias = get_terms(array(
                            'taxonomy'      => 'linea-categoria',
                            'hide_empty'    => false, 
                            'parent'        => $parentId,
                        ));
                    
                        foreach ($categorias as $categoria) {
                    
                            ?>
                                <div class="item">
                                    <div class="row header">
                                        <div class="sesg" style="background: <?php echo get_post_meta( get_the_ID(),'posmon_campos_lineas_color_catalogo', true) ?>">
                                        </div>
                                        <div class="textos">
                                            <h3><?php echo $categoria->name ?></h3>
                                            <p><?php echo $categoria->description ?></p>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <div class="product-category-grid">
                                            <div class="grid">
                                                <div class="row items">
                                                    <div class="col-lg-3 col-md-4 col-sm-6 item-container">
                                                        <div class="item">
                                                            <div class="featured-image">
                                                                <img src="img\productos\salud\1\1.jpg" alt="">
                                                            </div>
                                                            <div class="short-description">
                                                                <div class="reference">
                                                                    <span>Ref.</span>
                                                                    <h3 class="name">Mediclásica</h3>
                                                                </div>
                                                                <div class="gender">
                                                                    <div class="icon">
                                                                        <i class="fa fa-female"></i>
                                                                    </div>
                                                                    <div class="text">
                                                                        femenino
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-4 col-sm-6 item-container">
                                                        <div class="item">
                                                            <div class="featured-image">
                                                                <img src="img\productos\salud\2\1.jpg" alt="">
                                                            </div>
                                                            <div class="short-description">
                                                                <div class="reference">
                                                                    <span>Ref.</span>
                                                                    <h3 class="name">Básica</h3>
                                                                </div>
                                                                <div class="gender">
                                                                    <div class="icon">
                                                                        <i class="fa fa-male"></i>
                                                                    </div>
                                                                    <div class="text">
                                                                        masculino
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-4 col-sm-6 item-container">
                                                        <div class="item">
                                                            <div class="featured-image">
                                                                <img src="img\productos\salud\3\1.jpg" alt="">
                                                            </div>
                                                            <div class="short-description">
                                                                <div class="reference">
                                                                    <span>Ref.</span>
                                                                    <h3 class="name">Odontoclásica</h3>
                                                                </div>
                                                                <div class="gender">
                                                                    <div class="icon unisex">
                                                                        <i class="fa fa-female"></i>
                                                                        <i class="fa fa-male"></i>
                                                                    </div>
                                                                    <div class="text">
                                                                        unisex
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-4 col-sm-6 item-container">
                                                        <div class="item">
                                                            <div class="featured-image">
                                                                <img src="img\productos\salud\2\1.jpg" alt="">
                                                            </div>
                                                            <div class="short-description">
                                                                <div class="reference">
                                                                    <span>Ref.</span>
                                                                    <h3 class="name">Básica</h3>
                                                                </div>
                                                                <div class="gender">
                                                                    <div class="icon">
                                                                        <i class="fa fa-female"></i>
                                                                    </div>
                                                                    <div class="text">
                                                                        femenino
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-4 col-sm-6 item-container">
                                                        <div class="item">
                                                            <div class="featured-image">
                                                                <img src="img\productos\salud\2\1.jpg" alt="">
                                                            </div>
                                                            <div class="short-description">
                                                                <div class="reference">
                                                                    <span>Ref.</span>
                                                                    <h3 class="name">Básica</h3>
                                                                </div>
                                                                <div class="gender">
                                                                    <div class="icon">
                                                                        <i class="fa fa-female"></i>
                                                                    </div>
                                                                    <div class="text">
                                                                        femenino
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row paginator">
                                                <nav>
                                                    <a class="control prev" href="#" tabindex="-1">
                                                        <span class="icon-container"><i class="fa fa-angle-left"></i></span>
                                                        <span class="text-container">Anterior</span>
                                                    </a>
                                                    <div class="pages-container">
                                                        <ul class="pagination">
                                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                        </ul>
                                                    </div>
                                                    <a class="control next" href="#">
                                                        <span class="text-container">Siguiente</span>
                                                        <span class="icon-container"><i class="fa fa-angle-right"></i></span>
                                                    </a>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php 
                        }
                    }
				?>

                

                <!-- <div class="item">
                    <div class="row header">
                        <div class="sesg" style="background: #004777;">
                        </div>
                        <div class="textos">
                            <h3>batas cierre</h3>
                            <p>antifluidos</p>
                        </div>
                    </div>
                    <div class="content">
                        <div class="product-category-gallery">
                            <div class="row product-content">
                                <div class="col-md-5 product-description">
                                    <div class="row product-name">
                                        <span>Ref.</span>
                                        <h3>Mediclásica</h3>
                                    </div>
                                    <div class="row">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam dicta nam labore animi consequatur iure repellat ex doloremque placeat dolorem odit atque, deserunt quisquam perspiciatis numquam fugiat magni omnis facere.</p>
                                        <ul>
                                            <li>Lorem ipsum dolor sit amet.</li>
                                            <li>Lorem ipsum dolor sit amet.</li>
                                            <li>Lorem ipsum dolor sit amet.</li>
                                            <li>Lorem ipsum dolor sit amet.</li>
                                            <li>Lorem ipsum dolor sit amet.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-7  product-gallery">
                                    <div class="big-image-container">
                                        <img src="img\productos\salud\2\3.jpg" alt="">
                                    </div>
                                    <div class="thumbnail-gallery-container">
                                        <div class="product-thumbnail">
                                            <img src="img\productos\salud\2\1.jpg" alt="">
                                        </div>
                                        <div class="product-thumbnail">
                                            <img src="img\productos\salud\1\2.jpg" alt="">
                                        </div>
                                        <div class="product-thumbnail">
                                            <img src="img\productos\salud\1\3.jpg" alt="">
                                        </div>
                                        <div class="product-thumbnail">
                                            <img src="img\productos\salud\1\4.jpg" alt="">
                                        </div>
                                        <div class="product-thumbnail">
                                            <img src="img\productos\salud\1\6.jpg" alt="">
                                        </div>
                                        <div class="product-thumbnail">
                                                <img src="img\productos\salud\1\5.jpg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row paginator">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1">Anterior</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Siguiente</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- <div class="item">
                    <div class="row header">
                        <div class="sesg" style="background: #004777;">
                        </div>
                        <div class="textos">
                            <h3>scrub</h3>
                            <p>antifluidos</p>
                        </div>
                    </div>
                    <div class="content">
                        <div class="product-category-grid">
                            <div class="grid">
                                <div class="row items">
                                    <div class="col-lg-3 col-md-4 col-sm-6 item-container">
                                        <div class="item">
                                            <div class="featured-image">
                                                <img src="img\productos\salud\1\1.jpg" alt="">
                                            </div>
                                            <div class="short-description">
                                                <div class="reference">
                                                    <span>Ref.</span>
                                                    <h3 class="name">Mediclásica</h3>
                                                </div>
                                                <div class="gender">
                                                    <div class="icon">
                                                        <i class="fa fa-female"></i>
                                                    </div>
                                                    <div class="text">
                                                        femenino
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6 item-container">
                                        <div class="item">
                                            <div class="featured-image">
                                                <img src="img\productos\salud\2\1.jpg" alt="">
                                            </div>
                                            <div class="short-description">
                                                <div class="reference">
                                                    <span>Ref.</span>
                                                    <h3 class="name">Básica</h3>
                                                </div>
                                                <div class="gender">
                                                    <div class="icon">
                                                        <i class="fa fa-male"></i>
                                                    </div>
                                                    <div class="text">
                                                        masculino
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6 item-container">
                                        <div class="item">
                                            <div class="featured-image">
                                                <img src="img\productos\salud\3\1.jpg" alt="">
                                            </div>
                                            <div class="short-description">
                                                <div class="reference">
                                                    <span>Ref.</span>
                                                    <h3 class="name">Odontoclásica</h3>
                                                </div>
                                                <div class="gender">
                                                    <div class="icon unisex">
                                                        <i class="fa fa-female"></i>
                                                        <i class="fa fa-male"></i>
                                                    </div>
                                                    <div class="text">
                                                        unisex
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6 item-container">
                                        <div class="item">
                                            <div class="featured-image">
                                                <img src="img\productos\salud\2\1.jpg" alt="">
                                            </div>
                                            <div class="short-description">
                                                <div class="reference">
                                                    <span>Ref.</span>
                                                    <h3 class="name">Básica</h3>
                                                </div>
                                                <div class="gender">
                                                    <div class="icon">
                                                        <i class="fa fa-female"></i>
                                                    </div>
                                                    <div class="text">
                                                        femenino
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6 item-container">
                                        <div class="item">
                                            <div class="featured-image">
                                                <img src="img\productos\salud\2\1.jpg" alt="">
                                            </div>
                                            <div class="short-description">
                                                <div class="reference">
                                                    <span>Ref.</span>
                                                    <h3 class="name">Básica</h3>
                                                </div>
                                                <div class="gender">
                                                    <div class="icon">
                                                        <i class="fa fa-female"></i>
                                                    </div>
                                                    <div class="text">
                                                        femenino
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row paginator">
                                <nav>
                                    <a class="control prev" href="#" tabindex="-1">
                                        <span class="icon-container"><i class="fa fa-angle-left"></i></span>
                                        <span class="text-container">Anterior</span>
                                    </a>
                                    <div class="pages-container">
                                        <ul class="pagination">
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        </ul>
                                    </div>
                                    <a class="control next" href="#">
                                        <span class="text-container">Siguiente</span>
                                        <span class="icon-container"><i class="fa fa-angle-right"></i></span>
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- <div class="item">
                    <div class="row header">
                        <div class="sesg" style="background: #004777;">
                        </div>
                        <div class="textos">
                            <h3>pantalones</h3>
                            <p>caracteristica</p>
                        </div>
                    </div>
                    <div class="content">
                        <div class="product-category-gallery">
                            <div class="row controls">
                                <div class="col-md-5 back-button-container">
                                    <a class="control back" href="#" tabindex="-1">
                                        <span class="icon-container">
                                            <i class="fa fa-arrow-left"></i>
                                        </span>
                                        <span class="text-container"><p>Volver a <span>pantalones</span></p></span>
                                    </a>
                                </div>
                                <nav class="col-md-7 references-nav-controls">
                                    <a class="control prev" href="#" tabindex="-1">
                                        <span class="icon-container"><i class="fa fa-angle-left"></i></span>
                                        <span class="text-container">Referencia Anterior</span>
                                    </a>
                                    <a class="control next" href="#">
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
                                            <h3>Básica</h3>
                                            <div class="gender">
                                                <div class="icon unisex">
                                                    <i class="fa fa-female"></i>
                                                    <i class="fa fa-male"></i>
                                                </div>
                                                <div class="text">
                                                    unisex
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <p>Diseño corte clásico, con cierre chaquetero frontal, en color fondo entero.
                                            <br>Tallaje masculino y femenino.<br>
                                            Elaborado en tela antifluidos.</p>
                                        <h6>Opciones:</h6>
                                        <ul>
                                            <li>Con cuello camisero, militar o sin cuello.</li>
                                            <li>Cierre frontal visible o con solapa.</li>
                                            <li>Manga larga o manga corta.</li>
                                            <li>Puño resortado o recto.</li>
                                            <li>Con o sin bordado.</li>
                                        </ul>
                                        <a class="telas-button" href="telas.html" target="_blank">
                                            <img src="img\info\sub-info\telas.png">
                                            <span>Catálogo de telas</span>
                                        </a>
                                    </div>
                                    <div class="thumbnail-gallery-container v2">
                                        <a class="product-thumbnail" href="img\productos\salud\2\1.jpg">
                                            <img src="img\productos\salud\2\1.jpg" alt="Thumbnail">
                                        </a>
                                        <a class="product-thumbnail" href="img\productos\salud\2\2.jpg">
                                            <img src="img\productos\salud\2\2.jpg" alt="Thumbnail">
                                        </a>
                                        <a class="product-thumbnail" href="img\productos\salud\2\3.jpg">
                                            <img src="img\productos\salud\2\3.jpg" alt="Thumbnail">
                                        </a>
                                        <a class="product-thumbnail" href="img\productos\salud\2\4.jpg">
                                            <img src="img\productos\salud\2\4.jpg" alt="Thumbnail">
                                        </a>
                                        <a class="product-thumbnail" href="img\productos\salud\2\5.jpg">
                                            <img src="img\productos\salud\2\5.jpg" alt="Thumbnail">
                                        </a>
                                        <a class="product-thumbnail" href="img\productos\salud\2\6.jpg">
                                            <img src="img\productos\salud\2\6.jpg" alt="Thumbnail">
                                        </a>
                                        <a class="product-thumbnail" href="img\productos\salud\2\7.jpg">
                                            <img src="img\productos\salud\2\7.jpg" alt="Thumbnail">
                                        </a>
                                        <a class="product-thumbnail" href="img\productos\salud\2\8.jpg">
                                            <img src="img\productos\salud\2\8.jpg" alt="Thumbnail">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-7  product-gallery">
                                    <div class="big-image-container v2">
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
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="row header">
                        <div class="sesg" style="background: #004777;">
                        </div>
                        <div class="textos">
                            <h3>cirugía</h3>
                            <p>caracteristica</p>
                        </div>
                    </div>
                    <div class="content">
                            <div class="product-category-gallery">
                                <div class="row product-content">
                                    <div class="col-md-5 product-description">
                                        <div class="row product-name">
                                            <span>Ref.</span>
                                            <h3>Mediclásica</h3>
                                        </div>
                                        <div class="row">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam dicta nam labore animi consequatur iure repellat ex doloremque placeat dolorem odit atque, deserunt quisquam perspiciatis numquam fugiat magni omnis facere.</p>
                                            <ul>
                                                <li>Lorem ipsum dolor sit amet.</li>
                                                <li>Lorem ipsum dolor sit amet.</li>
                                                <li>Lorem ipsum dolor sit amet.</li>
                                                <li>Lorem ipsum dolor sit amet.</li>
                                                <li>Lorem ipsum dolor sit amet.</li>
                                            </ul>
                                        </div>
                                        <div class="thumbnail-gallery-container v2">
                                            <div class="product-thumbnail">
                                                <img src="img\productos\salud\2\6.jpg" alt="">
                                            </div>
                                            <div class="product-thumbnail">
                                                <img src="img\productos\salud\1\2.jpg" alt="">
                                            </div>
                                            <div class="product-thumbnail">
                                                <img src="img\productos\salud\1\3.jpg" alt="">
                                            </div>
                                            <div class="product-thumbnail">
                                                <img src="img\productos\salud\1\4.jpg" alt="">
                                            </div>
                                            <div class="product-thumbnail">
                                                <img src="img\productos\salud\1\6.jpg" alt="">
                                            </div>
                                            <div class="product-thumbnail">
                                                <img src="img\productos\salud\1\5.jpg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7  product-gallery">
                                        <div class="big-image-container v2">
                                            <img src="img\productos\salud\2\6.jpg" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row paginator">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-center">
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1">Anterior</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="#">Siguiente</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                    </div>
                </div>  -->

            </div>
        </div>

    </div>
</section>

</section>


<?php endwhile; ?>

<?php get_footer() ?>

