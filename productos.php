<?php 

/* Template Name: Productos */ 

?>

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


</section>

<?php get_footer() ?>