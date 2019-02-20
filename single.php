<?php get_header(); ?>


<div id="single-post" class="container-fluid">
	<div class="main">
		<div class="container" id="articles-loja">
			<nav class="" aria-label="breadcrumb">
			  <ol class="breadcrumb bg-white d-flex justify-content-center">
			    <li class="breadcrumb-item"><a href="<?php echo home_url() ?>"><i class="fas falg fa-home"></i> Home</a></li>
			    <li class="breadcrumb-item"> <a href="<?php echo home_url('/blog') ?>">blog</a></li>
			    <li class="breadcrumb-item active" aria-current="page"> <?php the_title(); ?></li>
			  </ol>
			</nav>
	        <div class="row">
	            <div class="artigos" style="background-color: white; width: 100%; padding: 25px;">
	                <h1 class="title-articles-loja"><?php the_title(); ?></h1>
	                <hr>
	                <div class="row">
	                    <?php
	                    if( have_posts() ) {
                            the_post(); ?> 

                            <div class="col-12 single-content" style="position: relative;">

								<div class="d-flex justify-content-center">
									<figure>
										<img class="img-fluid" src="<?php the_post_thumbnail_url( 'full') ?>" alt="">
									</figure>
								</div>

                                <p class="resumo-article">
                                	<?php the_content(); ?>
                                </p>
                                    
	                        </div>

	                    <?php } ?>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</div>


<?php get_footer() ?>