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

    });
</script>

<script>
    /////////////////////////////////////////
    //////////// box de frete página de checkout -> tab de frete
    ///////////////////////////////
    jQuery(document).ready(function($){
        $('#checkout-form tr.woocommerce-shipping-totals > th').remove();
        $('#checkout-form input[type="radio"]').css({'opacity': '0'});
        $( document ).ajaxComplete(function(){

            //////// MODIFICAÇÕES NO FRETE
            $('#checkout-form tr.woocommerce-shipping-totals > th').remove();
            $('#pac-days').remove();
            $('#sedex-days').remove();

            var pac = $('#shipping_method li:nth-child(1) > p > small').html();
            var sdx = $('#shipping_method li:nth-child(2) > p > small').html();
            $('#shipping_method li:nth-child(1) > p').css({'display': 'none'});
            $('#shipping_method li:nth-child(2) > p').css({'display': 'none'});

            $('label[for="shipping_method_0_correios-pac3"]').append('<span id="pac-days">  <small>  &nbsp;[ '+pac+' ]</small> </span>');
            $('label[for="shipping_method_0_correios-sedex4"]').append('<span id="sedex-days">  <small>  &nbsp;[ '+sdx+' ]</small> </span>');

            $("#shipping_method_0_correios-pac3").wrap('<span class="radio-box"></span>');
            $("#shipping_method_0_correios-sedex4").wrap('<span class="radio-box"></span>');
            $(".radio-box").append('<span class="checkmark"></span>');            


            ///////// MODIFICAÇÃO NO PAGAMENTO
            $('#payment input[id="payment_method_pagarme-credit-card"], #payment label[for="payment_method_pagarme-credit-card"]').wrapAll('<div class="radio-wrap"></div>');            
            $('#payment input[id="payment_method_pagarme-banking-ticket"], #payment label[for="payment_method_pagarme-banking-ticket"]').wrapAll('<div class="radio-wrap"></div>');
                 
            $('#payment input[type="radio"]').wrap('<div class="radio-box"></div>'); 
            $('#payment .radio-box').append('<span class="checkmark"></span>');      
            $('#payment .radio-wrap').wrapAll('<div id="radio-wrap"></div>');
            
        })

    });

    
</script>
</body>
</html>