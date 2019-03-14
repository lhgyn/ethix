<?php get_header(); ?>

<main id="main-container" class="main-page-product">
	<?php if(have_posts()): the_post(); ?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="text-center title-page-product"><?php the_title(); ?></h1>
				<h4 class="text-center subtitle-page-product"><?php the_field('s1_subtitulo'); ?></h4>
			</div>
			<div class="col-md-12 content-img-offers-product">				
				
				<div class="row">
					<div class="col-xl-6">
						<?php the_post_thumbnail('woocommerce_single', array('class'=>'img-fluid')) ?>
					</div>
					<div class="col-xl-6 content-summary">
						<h6 class="title-summary"><?php the_field('s2_titulo') ?></h6>
						<hr>
						<?php
						if( get_field('s2_choose_field_type') == 2 ){
							the_field('s2_beneficios_text');
						}else{ ?>

							<ul id="list-beneficios-ul">
							<?php if( have_rows('s2_beneficios_list') ):
								while( have_rows('s2_beneficios_list') ):
								the_row(); ?>

								<li>
									<span>
										<i class="fas fa-check" style="color:#005165"></i>
										<strong style="color: #666666">
											<?php the_sub_field('titulo') ?>
										</strong>
										<?php the_sub_field('resumo') ?>
									</span>
								</li>

							<?php endwhile; endif;?>
							</ul>

						<?php } ?>

					<?php if(!get_field('stop_sell')): ?>
						<ul id="product-variations" class="pricing-selector col-12" style="padding: 0">
			              <!-- ID DO PRODUTO  -->
			              <?php 
			              $_product = wc_get_product($post->ID); 			              

			              // CHECA SE PRODUTO É SIMPLES
			              if( $_product->is_type( 'simple' ) ) :

			              else: 
			                $product_variations = $_product->get_available_variations();
			                //LOOP DAS VARIANTES
			                foreach ($product_variations as $variation): $i++;
			                  // PEGA VALORES DE VARIANTES
			                  $regular_price = get_product_regular_price($variation['variation_id']);
			                  $min_price = get_product_min_price($variation['variation_id']);
			                  $descri_prod = get_product_descricao($variation['variation_id']);
			                  $frascos = get_product_ref($variation['variation_id']);
			                  $economia = $regular_price - $min_price;
			                  if ($i % 2 === 0):
			                  	$faixa_desconto = "seller";
			                    $varicao_default = $variation['variation_id']; ?>
			                    <li class="selected variacao_id" value="<?php echo $variation['variation_id'] ?>">
			                  <?php else: ?>
			                    <li value="<?php echo $variation['variation_id'] ?>" class="variacao_id">
			                    <?php $faixa_desconto = "value"; ?>
			                  <?php endif; ?>
			                    <h2>
			                      <img class="not-checked chk-marca" src=<?php echo get_stylesheet_directory_uri(); ?>/images/checkbox.png>
			                      <img class="checked chk-marca" src=<?php echo get_stylesheet_directory_uri(); ?>/images/checkbox-checked.png>
			                      <div class="image">
			                        <img src="<?php echo $variation['image']['url']; ?>">
			                      </div>
			                      <p><?php echo $frascos ?></p>
			                    </h2>
			                    <div class="pricing">
			                      <div class="price">
			                        <div class="per-bottle">
			                          <b>R$ <?php echo number_format($min_price, 2, ',', ' '); ?>
			                          </b>
			                        </div>
			                        <div class="msrp">R$ <?php echo number_format($regular_price, 2, ',', ' '); ?>
			                        </div>
			                      </div>
			                      <div class="details">
			                        <p class="save">Você economiza <span>R$ <?php echo number_format($economia, 2, ',', ' '); ?>
			                          
			                        </span></p>
			                        <p class="shipping">ENVIO IMEDIATO</p>
			                        <span class="discount <?php echo $faixa_desconto ?>">
			                        	<em><?php echo abs(number_format((($min_price * 100) / $regular_price) - 100, 0)); ?></em>
			                        	<b>%</b>
			                        </span>
			                      </div>
			                      <div class="mobile">
			                        <span class="green"><i class="icon-tag"></i> Você economiza R$ <?php echo number_format($economia, 2, ',', ' '); ?></span> + <i class="icon-box"></i> ENVIO IMEDIATO
			                      </div>
			                    </div>
			                  </li>
			                <?php endforeach;
			              endif; ?>
			            </ul>

			            <div class="row">
			            	<div class="col btn_comprar">
			              		<a id="btn-comprar" class="btn btn-danger" href="" style="display: flex; align-items: center; justify-content: center;">Comprar</a>
			            	</div>
			            </div>
			        <?php endif; ?>

			        <?php if(get_field('stop_sell')): ?>
							<div class="pt-3">
								<h5 class="text-muted">Este produto está indisponível.</h5>
								<div class="card mt-3">
									<div class="card-header">
										<h6 class="text-muted">Avise-me quando chegar.</h6>
									</div>
									<div class="card-body">
										<form id="aviseme-form" action="" method="post">
												<div class="form-group">
														<label for="name">Nome</label>
														<input type="text" name="name" class="form-control" id="name" placeholder="Nome" required>
												</div>
												<div class="form-group">
													<label for="email">Email</label>
														<input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
												</div>
												<input type="hidden" name="subject" value="Avise-me - <?php echo get_the_title() ?>">
												<input type="hidden" name="product_id" value="<?php echo get_the_ID() ?>">
												<input type="hidden" name="product_name" value="<?php echo get_the_title() ?>">
												<input type="hidden" name="product_image" value="<?php echo get_the_post_thumbnail_url() ?>">
												<input type="hidden" name="product_link" value="<?php echo get_the_permalink() ?>">
												<input type="hidden" name="message" value="a equipe Ethix, informa que o produto <?php echo get_the_title() ?> já está disponível.">
												<button type="submit" class="btn btn-primary">Enviar</button>
												<span id="status-message" class="float-right"></span>
										</form>
									</div>
								</div>
							</div>
			        <?php endif; ?>

					</div>

				</div>
			</div>
		</div>
	</div>

	<?php get_template_part( 'selos' ); ?>

	<section id="product-description" class="info-section">					
			<div class="title-line">
				<div class="container title">
						<div class="col-12 p-0 pb-3"><h2>Descrição</h2></div>
				</div>
			</div>							
			<div class="content-line">
				<div class="container">
						<div class="col-12 p-0">
							<?php the_content(); ?>
						</div>
				</div>
			</div>
	</section>

	<section id="product-promisse" class="info-section">
			<div class="title-line">
				<div class="container title">
					<div class="col-12 p-0"><h2>Nossa Promessa</h2></div>
				</div>
			</div>
			<div class="container">
				<div class="col-12 p-0 pt-4">
						<?php echo get_field('nossa_promessa', get_the_ID()); ?>
				</div>
			</div>
	</section>

	<section id="product-ask" class="info-section">
			<div class="title-line">
				<div class="container title">
					<div class="col-12 p-0"><h2>Perguntas Frequentes</h2></div>
				</div>
			</div>
			<div class="container">
					<div class="col-12 p-0 pt-4">
							<?php echo get_field('perguntas_frequentes', get_the_ID()); ?>
					</div>
			</div>
	</section>

	<section id="product-referency" class="info-section">
			<div class="title-line">
				<div class="container title">
					<div class="col-12 p-0"><h2>Referências Clínicas</h2></div>
				</div>
			</div>
			<div class="container">
					<div class="col-12 p-0 pt-4">
							<?php echo get_field('referencias_clinicas', get_the_ID()); ?>
					</div>
			</div>
	</section>

	<section id="product-rating" class="info-section">			
			<div class="title-line">
				<div class="container">
						<div class="col-12 p-0">
							<h2>Avaliações</h2>
						</div>
				</div>
			</div>
				<div class="container">
						<div class="col-12 p-0 pt-4">
							<?php comments_template( 'woocommerce/single-product-reviews' ); ?>
						</div>
				</div>

	</section>




	<section id="shop" style="background: #f7f7f7 !important">
		<div class="container">
			<div class="col">
				<h2>Produtos Relacionados</h2>
			</div>
		</div>
		<div class="container woocommerce" style="margin-top: 60px;">	
		<?php /*///////////////////////////////////////////////////////
                ////////// PRODUTOS RELACIONADOS
                ///////////////////////////*/
                $relacionados = get_post_meta( get_the_ID(), '_upsell_ids', false );
                $relateds = array(
                   'post_type' => 'product',
                   'post_status' => 'publish',
                   'post__in' => $relacionados[0]
                );
                $norelateds = array(
                   'post_type' => 'product',
                   'post_status' => 'publish',
                   'post__not_in' => $relacionados[0]
                );

                $relateds = new WP_Query($relateds);
                $first = $relateds->posts;
                $norelateds = new WP_Query($norelateds);
                $last = $norelateds->posts;
                $carousel_items = array_merge($first, $last);

                //echo '<pre>'; print_r($carousel_items); '</pre>';
                ?>		
			<div class="row products owl-carousel">

                <?php foreach ($carousel_items as $key => $value) { ?>

                	<div class="col-sm coluns-carrousel-product">
                            <div class="my-inner content-product-loja content-colun-product">
                                <a href="<?php echo get_permalink($value->ID);?>" >
                                    <?php 
                                    if ( has_post_thumbnail( $value->ID ) ) 
                                        echo get_the_post_thumbnail( $value->ID, 'woocommerce_gallery_thumbnail' ); 
                                    else 
                                        echo '<img src="' . woocommerce_placeholder_img_src() . '" />'; 
                                    ?>
                                    <h2 class="woocommerce-loop-product__title titulo" style=""><?php echo $value->post_title; ?></h2>
                                </a>
                                <div class="detalhes"><?php echo $value->post_excerpt; ?></div>
                                <?php get_star_rating(get_field('rating_star', $value->ID)); ?>
                                <a class="btn btn-default read-more" href="<?php echo get_permalink($value->ID);?>">Saiba Mais</a>
                            </div>
                        </div>

                <?php } ?>

			</div>
		</div>
	</section>



	<?php endif; ?>
</main>

<script>
	jQuery(document).ready(function($) {
		
		var variation_default = $('#product-variations li.selected').val();
		var add_to_cart = '<?php echo get_site_url() . '/?add-to-cart=' . $post->ID . "&variation_id=" ?>'+variation_default;
		$('#btn-comprar').attr('href', add_to_cart);

		$(".variacao_id").click(function(event) {
			var variation_id = $(this).attr('value');
			var add_to_cart = '<?php echo get_site_url() . '/?add-to-cart=' . $post->ID . "&variation_id=" ?>'+variation_id;
			$('#btn-comprar').attr('href', add_to_cart);
		});

		$('#myTab a').on('click', function (e) {
		  e.preventDefault()
		  $(this).tab('show')
		});

    $('.btn-link').click(function (){
        let item = $(this).attr('data-id');
        $('html, body').animate({
          scrollTop: $(`#card-${item}`).offset().top
        }, 1000)
      })

	});
</script>

<?php get_footer(); ?>