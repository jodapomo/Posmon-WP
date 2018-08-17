<?php 

/* Template Name: Insumos */ 

?>


<?php get_header() ?>

<?php while(have_posts()):the_post();  ?>

<section class="main">

<section class="info telas">
    <div class="info-intro" style="background-image: url(<?php echo get_template_directory_uri() . '/img/texture.png'?>);">
        <div class="container-fluid">
            <div class="row" style="background-image: url(<?php echo get_post_meta( get_the_ID(),'posmon_campos_insumos_principal_fondo_1', true) ?>)">
                <div class="prenda" style="background-image: url(<?php echo get_post_meta( get_the_ID(),'posmon_campos_insumos_principal_fondo_2', true) ?>)"></div>
                <div class="texto col-lg-5 col-md-8 col-sm-12 col-xs-12">
                    <div class="content">
                        <div class="first-p">
                            <?php echo wpautop( get_post_meta( get_the_ID(),'posmon_campos_insumos_principal_parrafo_1', true) ) ?>
                        </div>
                        <div class="second-p">
                        <?php echo wpautop( get_post_meta( get_the_ID(),'posmon_campos_insumos_principal_parrafo_2', true) ) ?>
                        </div>

                        <div class="third-p">
                            <?php echo wpautop( get_post_meta( get_the_ID(),'posmon_campos_insumos_principal_parrafo_3', true) ) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="info-1" style="background-image: url(<?php echo get_template_directory_uri() . '/img/texture.png'?>);">
        <div class="container-fluid">
            <div class="row">
                <div class="texto col-md-6 col-sm-12">
                    <div class="content">
                        <h2 class="title"><?php the_title() ?></h2>
                        <?php echo wpautop( get_post_meta( get_the_ID(),'posmon_campos_insumos_insumos_desc', true) ) ?>
                    </div>
                </div>
                <div class="imagen col-md-6 col-sm-12">
                    <img  src="<?php echo get_post_meta( get_the_ID(),'posmon_campos_insumos_insumos_image', true) ?>" draggable="false" style="-moz-user-select: none;"> 
                </div>
            </div>
        </div>
    </div>
    <div class="info-2" style="background-image: url(<?php echo get_template_directory_uri() . '/img/texture.png'?>);">
        <div class="container-fluid">
            <div class="row inner-container">
                <div class="tecnologias col-md-12 col-lg-6">
                    <h3>Tecnologías Textiles</h3>
                    <?php echo wpautop( get_post_meta( get_the_ID(),'posmon_campos_insumos_tecnologias_desc', true) ) ?>
                    <div class="grafico">
                        <img src="<?php echo get_post_meta( get_the_ID(),'posmon_campos_insumos_tecnologias_image_1', true) ?>" alt="" draggable="false" style="-moz-user-select: none;">
                    </div>
                </div>
                <div class="beneficios col-md-12 col-lg-6">
                    <h4>Beneficios adicionales</h4>
                    <div class="grafico">
                        <img src="<?php echo get_post_meta( get_the_ID(),'posmon_campos_insumos_tecnologias_image_2', true) ?>" alt="" draggable="false" style="-moz-user-select: none;">
                    </div>
                    <div class="respaldo">
                        <span>con el respaldo de</span>
                        <img src="<?php echo get_post_meta( get_the_ID(),'posmon_campos_insumos_tecnologias_logo', true) ?>" alt="" draggable="false" style="-moz-user-select: none;">
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
                <h2 class="titulo" style="color: <?php echo get_post_meta( get_the_ID(),'posmon_campos_insumos_color_titulo_catalogo', true) ?>">Catálogos</h2>
            </div>
        </div>

        <div class="row">
            <?php 
                $tipos = get_terms(array(
                    'taxonomy'      => 'tipo-insumo',
                    'order' =>  'DESC',
                    'hide_empty'    => true, 
                ));
            
            foreach ($tipos as $tipo) {
            ?>

                <div class="tipo-insumo">
                    <h3 style="color: <?php echo get_post_meta( get_the_ID(),'posmon_campos_insumos_color_titulo_catalogo', true) ?>"><?php echo $tipo->name ?></h3>
                </div>
                <div class="catalogo col-md-12">

                    <?php 
                        $args = array(
                            'posts_per_page' => -1,
                            'post_type' 	=> 'telas',
                            'tax_query' 	=> array(
                                array(
                                    'taxonomy' 	=> 'tipo-insumo',
                                    'terms'		=> array( $tipo->term_id ),
                                ),
                            ),
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
            <?php } ?>
        </div>

    </div>
</section>

</section>


<?php endwhile; wp_reset_postdata(); ?>

<?php get_footer() ?>