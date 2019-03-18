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
                        <h3>Sobre a Ethix</h3>
						<?php dynamic_sidebar( 'footer-1' ) ?>
					</div>
					<div class="col-md">
                        <h3>Empresa</h3>
						<?php dynamic_sidebar( 'footer-2' ) ?>
					</div>
                    <div class="col-md">
                        <h3>Atendimento</h3>
                        <?php dynamic_sidebar( 'footer-3' ) ?>
                    </div>
                    <div class="col-md">
                        <h3>Informações</h3>
                        <?php dynamic_sidebar( 'footer-4' ) ?>
                    </div>
                </div>
			</div>
		</div>
		<a href="#" id="back-to-top" title="Back to top"><i class="fas fa-sort-up icon-back-to-top"></i></a>
	</div>
	<?php endif; ?>

	<div id="footer-copy">
		<div class="col text-center">
            <p><small>N1 SUPPLEMENTS COMÉRCIO E DISTRIBUIÇÃO LTDA: CNPJ: 32.017.806/0001-89 | &copy; <?php echo date("Y"); ?> Ethix Nutracêuticos – Todos direitos reservados</small></p>
			<p> </p>
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

    $('#toggle-mobile').toggle(function() {
        $('.mobile-collapse').show('800');
        $('#menu-closed').hide();
        $('#menu-opened').show();
    }, function() { 
        $('.mobile-collapse').css({"min-width": "inherit", "transition": "none"});       
        $('.mobile-collapse').hide('800');
        $('#menu-closed').show();
        $('#menu-opened').hide();
    });
    $('#nav-mobile .dropdown-toggle').click(function(event) {
        event.preventDefault();
        var menuName = $(this).html();
        var hashMenuName = 1 + Math.floor(Math.random() * 100);
        $(this).parent('li').attr('id', hashMenuName);
        $('.dropdown-close a').html(`<div><span>Voltar</span><span style="float:right; padding-right:15px"><b>${menuName}</b></span></div>`);
        $('.mobile-collapse').css({"display": "block", "min-width": "100%", "margin-left": "-110%", "transition": "ease-in-out .6s"});
        $(`#${hashMenuName} .dropdown-menu`).css({"left": "0", "transition": "ease-in-out .6s"});
    });
    $('.dropdown-close').click(function(event) {
        event.preventDefault();
        $('.dropdown-menu').css({"left": "100%", "transition": "ease-in-out .6s"});
        $('.mobile-collapse').css({"display": "block", "min-width": "100%", "margin-left": "0", "transition": "ease-in-out .6s"});
    });

});

</script>

<script>
    jQuery(document).ready(function($) {
        var hidden = '<input type="hidden" name="produto" value="<?php echo get_the_title() ?>">';
        $(hidden).insertBefore('#aviseme-button');

        $('#aviseme-form').submit(function(event) {

            event.preventDefault();
            var formData = $(this).serialize();
            var http = '<?php echo get_template_directory_uri()."/includes/avisar-produto.php" ?>';

            $.ajax({
                url: http,
                type: 'POST',
                data: formData,
            }).success(function(data){
                console.log(data);
                var response = JSON.parse(data);
                $('#status-message').html(response.message).css({"color": "orange"});
                $('#aviseme-form').each(function(){
                  this.reset();
                });
                //alert(response);
            });
            
        });


        //$('label[for="shipping_method_0_correios-pac3"]').append('<span>  15 dias   </span>');
        //$('label[for="shipping_method_0_correios-sedex4"]').append('<span>  5 dias   </span>');
        
        
		$( document ).ajaxComplete(function(){
            $('label[for="shipping_method_0_correios-pac3"]').append('<span>  15 dias úteis   </span>');
            $('label[for="shipping_method_0_correios-sedex4"]').append('<span>  5 dias úteis   </span>');
        })

    });
</script>


</body>
</html>