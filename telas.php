<?php 

/* Template Name: Telas */ 

?>


<?php get_header() ?>

<?php while(have_posts()):the_post();  ?>

<section class="main">

<section class="info telas">
    <div class="info-1" style="background-image: url(<?php echo get_template_directory_uri() . '/img/texture.png'?>);">
        <div class="container-fluid">
            <div class="row">
                <div class="texto col-md-6">
                    <div class="content">
                        <h1 class="big-title"><?php the_title() ?></h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat.</p>	
                    </div>
                </div>
                <div class="imagen col-md-6">
                    <img src="<?php echo get_template_directory_uri() ?>/img/medico1.png">
                </div>
            </div>
        </div>
    </div>
    <div class="info-2" style="background-image: url(<?php echo get_template_directory_uri() . '/img/texture.png'?>);">
        <div class="container-fluid">
            <div class="row inner-container">
                <div class="imagen col-md-6">
                    <img src="<?php echo get_template_directory_uri() ?>/img/chef.png">
                </div>
                <div class="texto col-md-6">
                    <h2>Marcas</h2>
                    <div class="marcas-container">
                        <div class="row">
                            <div class="col-md-3 logo">
                                <img src="<?php echo get_template_directory_uri() ?>/img/logo-lafayette.png">
                            </div>
                            <div class="col-md-3 logo">
                                <img src="<?php echo get_template_directory_uri() ?>/img/logo-lafayette.png">
                            </div>
                            <div class="col-md-3 logo">
                                <img src="<?php echo get_template_directory_uri() ?>/img/logo-lafayette.png">
                            </div>
                            <div class="col-md-3 logo">
                                <img src="<?php echo get_template_directory_uri() ?>/img/logo-lafayette.png">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 logo">
                                <img src="<?php echo get_template_directory_uri() ?>/img/logo-lafayette.png">
                            </div>
                            <div class="col-md-3 logo">
                                <img src="<?php echo get_template_directory_uri() ?>/img/logo-lafayette.png">
                            </div>
                            <div class="col-md-3 logo">
                                <img src="<?php echo get_template_directory_uri() ?>/img/logo-lafayette.png">
                            </div>
                            <div class="col-md-3 logo">
                                <img src="<?php echo get_template_directory_uri() ?>/img/logo-lafayette.png">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 logo">
                                <img src="<?php echo get_template_directory_uri() ?>/img/logo-lafayette.png">
                            </div>
                            <div class="col-md-3 logo">
                                <img src="<?php echo get_template_directory_uri() ?>/img/logo-lafayette.png">
                            </div>
                            <div class="col-md-3 logo">
                                <img src="<?php echo get_template_directory_uri() ?>/img/logo-lafayette.png">
                            </div>
                            <div class="col-md-3 logo">
                                <img src="<?php echo get_template_directory_uri() ?>/img/logo-lafayette.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="catalogo-telas" class="catalogo-telas">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="titulo">Catálogo de Telas</h2>
            </div>
        </div>

        <div class="row">
            <div class="catalogo col-md-12">

                <?php 
                    $args = array(
                        'posts_per_page' => -1,
                        'post_type' 	=> 'telas',
                    );
                    
                    $telas = new WP_Query( $args );

                    if($telas->have_posts()) {
                        while($telas->have_posts()): $telas->the_post(); ?>
                        
                            <div class="item">
                                <div class="row header">
                                    <div class="sesg" style="background: <?php echo get_post_meta( get_the_ID(),'posmon_campos_telas_color_barra', true) ?>">
                                    </div>
                                    <div class="textos">
                                        <h3><?php echo mb_strtolower( get_the_title() ) ?></h3>
                                        <p><?php echo mb_strtolower(get_post_meta( get_the_ID(),'posmon_campos_telas_descripcion_tela', true)) ?></p>
                                    </div>
                                </div>
                                
                                <div class="content">
                                    <div class="flexslider flexslider-content">

                                    <?php 
                                        $gallery = get_post_meta( get_the_ID(), 'posmon_campos_telas_galeria_tela', true );
                                    ?>
                                        
                                        <ul class="slides">
                                            <?php 
                                                foreach ( (array) $gallery as $attachment_id => $attachment_url ) {
                                                    echo '<li>';
                                                    echo '<img src="' . $attachment_url . '" />';
                                                    echo '</li>';
                                                }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php 
                        endwhile; wp_reset_postdata();
                    }
                ?>


            </div>
        </div>

    </div>
</section>

</section>


<?php endwhile; wp_reset_postdata(); ?>

<?php get_footer() ?>