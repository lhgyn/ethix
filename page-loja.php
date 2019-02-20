<?php get_header();
// *
//  *
//  * Developer front-end: Peterson Macedo [https://www.behance.net/petersondma4c1]
//  * Developer back-end: Felipe Ribeiro
//  * Developer back-end: Jandimar
//  *
// *
?>

<main class="woocommerce">
	<div class="container-fluid" id="shop">
		<div class="container">
            <div class="row products">
                <div class="title-page-loja">
                    <h1>Nossos Produtos</h1>
                    <p>Nós mantemos a qualidade impecável de nossas fórmulas.</p>
                </div>
                <?php             
                /*///////////////////////////////////////////////////////
                ////////// PRODUTOS MAIS VENDIDOS
                ///////////////////////////*/
                $best_selling = array(
                   'post_type' => 'product',
                   'post_status' => 'publish',
                   'posts_per_page' => 6,
                   'meta_key' => 'total_sales',
                   'orderby' => 'meta_value_num'
                );
                $best_selling = new WP_Query($best_selling);

                if ( $best_selling->have_posts() ) :
                    $i = 0; $limite = 6;
                    while ($best_selling->have_posts()) : $best_selling->the_post();
                    $excludes[] = get_the_ID();
                    echo ($i == 0 || $i == $limite) ? '<div class="row">' : ''; ?>
                        <div class="col-sm col-md-4 col-lg-2">
                            <div class="my-inner content-product-loja">
                                <a href="<?php echo get_permalink($my_query->post->ID);?>" >
                                    <?php 
                                    if ( has_post_thumbnail( $best_selling->post->ID ) ) 
                                        echo get_the_post_thumbnail( $best_selling->post->ID, 'woocommerce_thumbnail' ); 
                                    else 
                                        echo '<img src="' . woocommerce_placeholder_img_src() . '" />'; 
                                    ?>
                                    <h2 class="woocommerce-loop-product__title titulo" style=""><?php the_title(); ?></h2>
                                </a>
                                <div class="detalhes"><?php echo $best_selling->post->post_excerpt; ?></div>
                                <?php get_star_rating(get_field('rating_star')); ?>
                                <a class="btn btn-default read-more" href="<?php echo get_permalink($best_selling->post->ID);?>">Saiba Mais</a>
                                <?php  ?>
                            </div>
                        </div>
                    <?php echo ($i == ($limite - 1) || $i == ($limite + 5)) ? '</div>' : '';
                    $i++;
                    endwhile;
                    ?>
                <?php endif; 
                wp_reset_postdata(); ?>

                <?php                
                /*///////////////////////////////////////////////////////
                ////////// PRODUTOS EM DESTAQUE
                ///////////////////////////*/
                $highlights = array(
                   'post_type' => 'product',
                   'post_status' => 'publish',
                   'posts_per_page' => 6,
                   'post__not_in' => $excludes,
                   'orderby' => 'rand'
                );
                $highlights = new WP_Query($highlights);

                if ( $highlights->have_posts() ) :
                    $i = 0; $limite = 6;
                    while ($highlights->have_posts()) : $highlights->the_post();
                    echo ($i == 0 || $i == $limite) ? '<div class="row">' : ''; ?>
                        <div class="col-sm col-md-4 col-lg-2">
                            <div class="my-inner content-product-loja">
                                <a href="<?php echo get_permalink($my_query->post->ID);?>" >
                                    <?php 
                                    if ( has_post_thumbnail( $highlights->post->ID ) ) 
                                        echo get_the_post_thumbnail( $highlights->post->ID, 'woocommerce_thumbnail' ); 
                                    else 
                                        echo '<img src="' . woocommerce_placeholder_img_src() . '" />'; 
                                    ?>
                                    <h2 class="woocommerce-loop-product__title titulo" style=""><?php the_title(); ?></h2>
                                </a>
                                <div class="detalhes"><?php echo $highlights->post->post_excerpt; ?></div>
                                <?php get_star_rating(get_field('rating_star')); ?>
                                <a class="btn btn-default read-more" href="<?php echo get_permalink($highlights->post->ID);?>">Saiba Mais</a>
                                <?php  ?>
                            </div>
                        </div>
                    <?php echo ($i == ($limite - 1) || $i == ($limite + 5)) ? '</div>' : '';
                    $i++;
                    endwhile;
                    ?>
                <?php endif; 
                wp_reset_postdata(); ?>

            </div>
        </div>
    </div>
    
    <?php              
    /*///////////////////////////////////////////////////////
    ////////// NEWSLETTER
    ///////////////////////////*/
        get_template_part('newsletter');
    ?>
                 
    <?php 
    /*///////////////////////////////////////////////////////
    ////////// BLOG 
    ///////////////////////////*/ ?>
    <div class="container" id="articles-loja">
        <div class="row">
            <div class="artigos" style="background-color: white; width: 100%; padding: 50px;">
                <h1 class="title-articles-loja">Artigos Principais</h1>
                <hr>
                <div class="row">
                    <?php
                    $args = array(
                        'post_type' => 'post'
                    );
                    $post_query = new WP_Query($args);
                    if($post_query->have_posts() ) {
                        $i = 0;
                        while(($post_query->have_posts()) and ($i < 3) ) {
                            $i++;
                            $post_query->the_post(); ?> 
                            <div class="col-sm content-article-loja" style="position: relative;">
                                <a href="<?php echo get_permalink($post_query->the_post->ID);?>">
                                <?php echo get_the_post_thumbnail( $post_id, 'thumbnail') ?>
                                    <h2 class="titulo"><?php the_title(); ?></h2>
                                    <p class="resumo-article"><?php echo wp_trim_words( get_the_excerpt(), 12); ?></p>
                                    <div class="saiba-mais">
                                        <a class="btn btn-default btn-article" href="<?php echo get_permalink($post_query->the_post->ID);?>" style="">Ler mais</a>
                                    </div>
                                </a>
                            </div>
                        <?php }
                    } ?>
                </div>
            </div>
        </div>
    </div>

</main>

<?php get_footer(); ?>
