<?php get_header(); ?>


	<div id="main-container" class="main">
		<div class="container">
	        <div id="blog" class="row">
                <div class="col-md">
                	<?php
		                if( have_posts() ) {
	                    while( have_posts() ) {
	                        the_post(); ?> 
	                        <div class="col-md blog-item">
                            	<div class="img">
                            		<!-- <a href="<?php the_permalink(); ?>">
                            			<?php //echo get_the_post_thumbnail( $post_id, 'large') ?>
                            		</a> -->
                            		<div class="grid">
										<figure class="effect-apollo">
											<?php echo get_the_post_thumbnail( $post_id, 'large') ?>
											<figcaption>
												<!-- <h2>Strong <span>Apollo</span></h2>
												<p>Apollo's last game of pool was so strange.</p>
												<a href="#">View more</a> -->
											</figcaption>			
										</figure>
									</div>
                            	</div>
                                <div class="content">
                                	<h3><?php the_title(); ?></h3>
	                                <p><?php echo get_excerpt(120); ?></p>
	                                <a class="btn btn-primary" href="<?php the_permalink(); ?>">Leia mais</a>
                                </div>
	                        </div>
	                    <?php }
	                } ?>
                </div>
                <div class="col-md-4">
                	<?php get_sidebar() ?>
                </div>

	        </div>

	        <div class="row">
	        	<div class="col">
	        		
	        		<div id="blog-nav" class="d-flex justify-content-center">
	        			<?php
						  if ( function_exists('wp_bootstrap_pagination') )
						    wp_bootstrap_pagination();
						?>
	        		</div>

	        	</div>
	        </div>
	    </div>
	</div>


<?php get_footer() ?>