<?php get_header();
// *
//  *
//  * Developer front-end: Peterson Macedo [https://www.behance.net/petersondma4c1]
//  * Developer back-end: Jandimar
//  *
// *
?>

 
<?php
/////////// BUSCA OS SLIDES DOS CAMPOS PERSONALIZADOS 
    if( have_rows('slideshow') ){
        while( have_rows('slideshow') ){
            the_row();
            $titulo = get_sub_field('titulo');
            $description = get_sub_field('descricao');
            $category = get_sub_field('categoria');
            $imagem = get_sub_field('background');
            $slideshow[] = [ $titulo, $description, $category->slug, $imagem, $category->count ];
        }
    }

?>
<main class="woocommerce">
	<div class="row" id="home">
            <div class="slide-home container-fluid owl-carousel">
            
            <?php foreach ($slideshow as $key => $value): ?>
                <?php if($value[4]): ?>
                <div class="row content-slide-home" style="background: url('<?php echo $value[3] ?>') center center no-repeat; background-size: cover; ">
                    <div class="container">
                        <div class="col-lg-5 col-md-6 col-sm-12 content-info-slide-home">
                            <h3><?php echo $value[0] ?></h3>
                            <h4 class="subtitle-slide-home">
                                <?php echo $value[1] ?>
                            </h4>
                            <div class="row">
                            
                                <?php
                                $query = new WP_Query(array(
                                    'post_type'=>'product',
                                    'product_cat' => $value[2],
                                    'posts_per_page' => 2
                                    )
                                );
                                while($query->have_posts()){
                                    $query->the_post(); ?>
                                    <?php echo $value[4] < 2? '<div class="col-3"></div>':''?>
                                    <div class="col-6 product-slide-home">
                                        <div class="single-product-slide-home">
                                            <?php
                                            if ( has_post_thumbnail( $slides->post->ID ) ) 
                                                echo get_the_post_thumbnail( $slides->post->ID, 'woocommerce_gallery_thumbnail' ); 
                                            else 
                                                echo '<img src="' . woocommerce_placeholder_img_src() . '" />'; 
                                            ?>
                                            <h2 class="woocommerce-loop-product__title titulo" style="">
                                                <?php echo get_the_title( $slides->post->ID ); ?>
                                            </h2>
                                        </div>
                                    </div>

                                <?php } ?>
                                
                                <a class="btn cta-slide-home" href="<?php echo home_url('/categoria-produto/').$value[2];?>">Saiba Mais</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php endforeach; ?>

            </div>


    </div>

    <section id="mais-vendidos-home">
        <div class="container">
            <div class="row">
                <div class="content-best-products" id="content-best-saller">
                    <h3 class="text-center h3 title-best-seller-home">Sucesso de vendas</h3>
                    <?php
                    $best_selling = array(
                       'post_type' => 'product',
                       'post_status' => 'publish',
                       'posts_per_page' => 4,
                       'meta_key' => 'total_sales',
                       'orderby' => 'meta_value_num'
                    );
                    $best_selling = new WP_Query($best_selling);

                    if ( $best_selling->have_posts() ) :
                        $i = 0; $limite = 4;
                        while ($best_selling->have_posts()) : $best_selling->the_post();
                        $excludes[] = get_the_ID();
                        echo ($i == 0 || $i == $limite) ? '<div class="row row-products-home">' : ''; ?>
                            <div class="col-sm col-md-6 col-lg-3">
                                <div class="content-product-home">
                                    <a href="<?php echo get_permalink($my_query->post->ID);?>" >
                                        <?php 
                                        if ( has_post_thumbnail( $best_selling->post->ID ) ) 
                                            echo get_the_post_thumbnail( $best_selling->post->ID, 'woocommerce_gallery_thumbnail' ); 
                                        else 
                                            echo '<img src="' . woocommerce_placeholder_img_src() . '" />'; 
                                        ?>
                                        <h2 class="woocommerce-loop-product__title titulo title-product-home" style=""><?php the_title(); ?></h2>
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
                    <?php endif; ?>
                    <div class="col-12">
                        <a class="btn btn-all-products" href="<?php echo home_url('/produtos') ?>">VER TODOS PRODUTOS</a>
                    </div>
                    <?php wp_reset_postdata(); ?>       

                </div>
            </div>
        </div>
    </section>

    <?php              
    /*///////////////////////////////////////////////////////
    ////////// NEWSLETTER
    ///////////////////////////*/
        get_template_part('newsletter');
    ?>
    
    <section id="blog-home">
        <div class="container">
                <div id="content-latest-articles">
                    <h3 class="text-center h3 title-blog-home">Últimos artigos</h3>
                    <p class="text-center subtitle-blog-home">Confira nossos últimos artigos</p>
                    <div class="container">
                        <?php
                            if(have_rows('category_posts')){
                                while(have_rows('category_posts')){
                                    the_row();
                                    $categories[] = get_sub_field('category');
                                }
                            }
                            //echo '<pre>'; print_r($categories); echo '</pre>';
                        ?>
                        <?php ////////////////////// BLOCO 1
                        if($categories[0]->count >= 3):
                            $args = array( 'post_type' => 'post', 'posts_per_page' => 3, 'category_name' => $categories[0]->slug );
                            $posts = new WP_Query( $args );
                            if ( $posts->have_posts() ): ?>

                                <div class="content-line-cat-post row">
                                    <h3 class="text-center h3 title-cat-home col-12"><?php echo $categories[0]->name ?></h3>
                                    <?php while( $posts->have_posts() ): ?>
                                        <?php $posts->the_post(); ?>                                                         

                                    <div class="col-sm content-article-home" style="position: relative;">
                                        <a href="<?php the_permalink() ?>">
                                            <?php the_post_thumbnail( 'large', array('class'=>'img-fluid') ) ?>
                                            <h2 class="titulo title-article-home"><?php the_title() ?></h2>
                                            <p class="resumo-article-home"><?php echo get_excerpt(120) ?></p>
                                        </a>
                                        <div class="saiba-mais">
                                            <a class="btn btn-default btn-article" href="<?php the_permalink() ?>" style="">Ler mais</a>
                                        </div>                                
                                    </div>

                                    <?php endwhile; ?>                            

                                </div>
                        <?php endif; wp_reset_postdata(); 
                        endif; ?>


                        <?php ////////////////////// BLOCO 2
                        if($categories[1]->count >= 3):
                            $args = array( 'post_type' => 'post', 'posts_per_page' => 3, 'category_name' => $categories[1]->slug );
                            $posts = new WP_Query( $args );
                            if ( $posts->have_posts() ): ?>
                                
                                <div class="content-line-cat-post row">
                                    <h3 class="text-center h3 title-cat-home col-12"><?php echo $categories[1]->name ?></h3>
                                    <?php while( $posts->have_posts() ): ?>
                                        <?php $posts->the_post(); ?>                                                        

                                    <div class="col-sm content-article-home" style="position: relative;">
                                        <a href="<?php the_permalink() ?>">
                                            <?php the_post_thumbnail( 'large', array('class'=>'img-fluid') ) ?>
                                            <h2 class="titulo title-article-home"><?php the_title() ?></h2>
                                            <p class="resumo-article-home"><?php echo get_excerpt(120) ?></p>
                                        </a>
                                        <div class="saiba-mais">
                                            <a class="btn btn-default btn-article" href="<?php the_permalink() ?>" style="">Ler mais</a>
                                        </div>                                
                                    </div>

                                    <?php endwhile; ?>                            

                                </div>

                        <?php endif; wp_reset_postdata();
                        endif;?>


                        <?php ////////////////////// BLOCO 3
                        if($categories[2]->count >= 3):
                            $args = array( 'post_type' => 'post', 'posts_per_page' => 3, 'category_name' => $categories[2]->slug );
                            $posts = new WP_Query( $args );
                            if ( $posts->have_posts() ): ?>

                                <div class="content-line-cat-post row">
                                    <h3 class="text-center h3 title-cat-home col-12"><?php echo $categories[2]->slug ?></h3>
                                    <?php while( $posts->have_posts() ): ?>
                                        <?php $posts->the_post(); ?>                                                         

                                    <div class="col-sm content-article-home" style="position: relative;">
                                        <a href="<?php the_permalink() ?>">
                                            <?php the_post_thumbnail( 'large', array('class'=>'img-fluid') ) ?>
                                            <h2 class="titulo title-article-home"><?php the_title() ?></h2>
                                            <p class="resumo-article-home"><?php echo get_excerpt(120) ?></p>
                                        </a>
                                        <div class="saiba-mais">
                                            <a class="btn btn-default btn-article" href="<?php the_permalink() ?>" style="">Ler mais</a>
                                        </div>                                
                                    </div>

                                    <?php endwhile; ?>                            

                                </div>

                        <?php endif; wp_reset_postdata();
                        endif;?>


                        <?php ////////////////////// BLOCO 4
                        if($categories[3]->count >= 3):
                            $args = array( 'post_type' => 'post', 'posts_per_page' => 3, 'category_name' => $categories[3]->slug );
                            $posts = new WP_Query( $args );
                            if ( $posts->have_posts() ): ?>

                                <div class="content-line-cat-post row">
                                    <h3 class="text-center h3 title-cat-home col-12"><?php echo $categories[3]->slug ?></h3>
                                    <?php while( $posts->have_posts() ): ?>
                                        <?php $posts->the_post(); ?>                                                         

                                    <div class="col-sm content-article-home" style="position: relative;">
                                        <a href="<?php the_permalink() ?>">
                                            <?php the_post_thumbnail( 'large', array('class'=>'img-fluid') ) ?>
                                            <h2 class="titulo title-article-home"><?php the_title() ?></h2>
                                            <p class="resumo-article-home"><?php echo get_excerpt(120) ?></p>
                                        </a>
                                        <div class="saiba-mais">
                                            <a class="btn btn-default btn-article" href="<?php the_permalink() ?>" style="">Ler mais</a>
                                        </div>                                
                                    </div>

                                    <?php endwhile; ?>                            

                                </div>
                        <?php endif; wp_reset_postdata();
                        endif;
                        ?>

            <div class="col-12">
                <a class="btn btn-all-articles btn-show-blog" href="<?php echo home_url('/blog') ?>">VER TODOS ARTIGOS</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>


