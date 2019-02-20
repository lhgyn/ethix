<?php $rout = home_url( add_query_arg(array(), $wp->request) ); ?>
<?php if( is_page('finalizar-compra') ){
    //echo '<script>alert("Pagina de Checkout")</script>';
    // if( strpos( $current_url, '/payment-method' ) ) {
    //     echo '<script>alert("Pagamento")</script>';
    // }
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php bloginfo(); ?></title>
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">

    <?php wp_head(); ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/tonystar/bootstrap-float-label/v4.0.1/dist/bootstrap-float-label.min.css">
</head>
<body <?php body_class()?>>
    
<header>
	<?php if(!is_page('finalizar-compra')): ?>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <div class="container">
  		  <a class="navbar-brand" href="<?php echo home_url() ?>">
		    <img src="<?php echo get_template_directory_uri() ?>/images/logo4.png" alt="">
		  </a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <?php 
			  	wp_nav_menu( array(
					'theme_location'  => 'primary',
					'depth'	          => 2, // 1 = no dropdowns, 2 = with dropdowns.
					'container'       => '',
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'navbar-nav ml-auto',
					'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
					'walker'          => new WP_Bootstrap_Navwalker(),
				) );
 			?>
 			<ul class="navbar-nav nav-icons ml">
 				<li class="nav-item d-block d-sm-none">
 					<a class="nav-link" href="<?php echo home_url('/carrinho') ?>">MEU CARRINHO</a>
 				</li>
 				<li class="d-block d-sm-none">
 					<form action="">
		            	<div class="input-group input-group-sm mb-3">
						  <input type="text" name="s" class="form-control" placeholder="Faça uma busca" aria-label="Recipient's username" aria-describedby="button-addon2">
						  <div class="input-group-append">
						    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Pesquisar</button>
						  </div>
						</div>
		            </form>
		        </li>
 				<li class="nav-item dropdown  d-none d-lg-block">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          <i class="fas fa-sm fa-search"></i>
			        </a>
			        <div id="search-form" class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			            <form action="<?php echo home_url() ?>" method="GET">
			            	<div class="input-group input-group-sm">
							  <input type="text" name="s" class="form-control" placeholder="Faça uma busca" aria-label="Recipient's username" aria-describedby="button-addon2">
							  <div class="input-group-append">
							    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Pesquisar</button>
							  </div>
							</div>
			            </form>
			        </div>
			    </li>
 				<li class="nav-item dropdown  d-none d-lg-block">
 					 <a class="nav-link dropdown-toggle" href="#" id="navbarCart" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          <i class="fas fa-sm fa-shopping-cart"></i>
			        </a>
			        <span id="cart-qty" class="count-cart"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
			        <div id="header-cart" class="dropdown-menu" aria-labelledby="navbarCart">
			            <div class="card">
			            	<ul>
			            		<?php $items = WC()->cart->get_cart(); ?>
			            		<?php foreach($items as $k => $v): //print_r($v['data'])?>
			            		<li id="item-<?= $v['product_id'] ?>">
			            			<div id="cart-items">		            				
				            			<img src="<?php echo get_the_post_thumbnail_url( $v['product_id'], 'thumbnail' ) ?>" alt="">
				            			<div>				            				
					            			<p><?php echo $v['data']->name; ?></p>
					            			<p>R$ <?php echo $v['data']->sale_price ?
					            				number_format($v['data']->sale_price, 2, ',', '.') :
					            				number_format($v['data']->regular_price, 2, ',', '.'); ?>
					            			</p>
				            			</div>
				            			<div>
				            				<?php $key = $v['key']; ?>
				            				<a class="remove-item-cart" data-id="<?php echo $v['product_id'] ?>" href="">remover</a>
				            			</div>
				            		</div>
				            	</li>
				            	<?php endforeach; ?>

				            	<?php if($items): ?>
				            	<li class="cart-items">
				            		<div>
				            			<h5 class="text-center text-primary subtotal-text">
				            				Subtotal: <span id="cart-subtotal"><?php echo WC()->cart->get_total() ?></span>
				            			</h5>
				            		</div>
				            	</li>
				            	<li class="cart-items content-btn-cart">
				            		<a href="<?php echo home_url('/carrinho') ?>" class="btn btn-primary btn-block btn-view-cart">Ver Carrinho</a>
				            	</li>
				            	<li class="cart-items content-btn-checkout">
				            		<a href="<?php echo home_url('/finalizar-compra') ?>" class="btn btn-primary btn-block btn-view-checkout">Finalizar Compra <i class="fas fa-sm fa-arrow-right"></i></a>
				            	</li>
				            	<?php else: ?>
				            		<li class="empty-cart empty-cart-php">O carrinho está vazio</li>
				            	<?php endif; ?>
				            	<li class="empty-cart empty-cart-ajax" style="display: none">O carrinho está vazio</li>
			            	</ul>
			            </div>
			        </div>
			    </li>
 			</ul>
		  </div>
	  </div>
	</nav>
	<?php endif; ?>

	<?php if(is_page('finalizar-compra')): ?>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container">
	  			<div class="content-icon-checkout">
	  				<h4 class="icon-secure">
	  					<i class="fas fa-lock icon-lock"></i>
	  					CHECKOUT SEGURO
	  				</h4>
	  			</div>
	  			<div class="content-icon-loja">
	  				<img src="<?php echo get_template_directory_uri() ?>/images/logo4.png" width="90" alt="">
	  			</div>
		 	</div>
		 </nav>
	<?php endif; ?>
</header>