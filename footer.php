<?php if(!is_page('finalizar-compra')){
	get_template_part('newsletter');
	}
?>

<footer>
	<?php if(!is_page('finalizar-compra')): ?>
	<div class="container-fluid">		
		<div id="footer-widgets" class="row">
			<div class="container">
				<div class="row">
					<div class="col-md">
                        <h3>Ethix</h3>
						<?php dynamic_sidebar( 'footer-1' ) ?>
					</div>
					<div class="col-md">
                        <h3>Informações</h3>
						<?php dynamic_sidebar( 'footer-2' ) ?>
					</div>
					<div class="col-md">
                        <h3>Produtos</h3>
                        <div class="row">
                            <div class="col-md">
                                <?php dynamic_sidebar( 'footer-3' ) ?>
                            </div>
                            <div class="col-md">
                                <?php dynamic_sidebar( 'footer-4' ) ?>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
		<a href="#" id="back-to-top" title="Back to top"><i class="fas fa-sort-up icon-back-to-top"></i></a>
	</div>
	<?php endif; ?>

	<div id="footer-copy">
		<div class="col text-center">
			<p>© <?php echo date("Y"); ?> Ethix Nutracêuticos – Todos direitos reservados </p>
		</div>
	</div>
</footer>


<?php wp_footer(); ?>

<script>
jQuery(document).ready(function($) {
	/*////////////////////////////////////////////////
/////// Remove itens do carrinho
///////////////////////*/
    $('.remove-item-cart').click(function(event) {
        event.preventDefault();
        var id = $(this).attr('data-id');
        var url = "<?php echo get_template_directory_uri() ?>/includes/cart_actions.php";

        $.ajax({
            type: "POST",
            url: url,
            data: {id : id},
            success: function (res) {
                var obj = JSON.parse(res);
                console.log(obj.id);
                if(obj.status == 'success'){
                    alert(obj.msg);
                    $(`#item-${obj.id}`).remove();
                    $(`#cartqty`).remove();
                    $('#cart-subtotal').html(obj.subtotal);
                    $('#cart-qty').html(obj.cart_qty);
                    if(obj.cart_qty === 0){
                        $('.empty-cart').show();
                        $('.cart-items').hide();
                    }
                    
                    location.reload();
                }

            }
        });
    });


});

</script>

</body>
</html>