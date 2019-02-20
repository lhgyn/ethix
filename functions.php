<?php

function get_excerpt($count){
  $permalink = get_permalink($post->ID);
  $excerpt = get_the_excerpt();
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, $count);
  $excerpt = $excerpt.'  [...]';
  return $excerpt;
}

/*///////////////////////////////////////////////
////////// WORDPRESS DEFAULT SETTINGS
////////////////////////////*/
show_admin_bar(false);
add_theme_support('post-thumbnails');
add_theme_support('menus');
add_theme_support('woocommerce', array(
    'thumbnail_image_width' => 300,
    'gallery_thumbnail_image_width' => 200,
    'single_image_width' => 450,
    )
);
add_theme_support('html5', array(
'search-form',
'comment-form',
'comment-list',
'gallery',
'caption',
));



/*///////////////////////////////////////////////
////////// IMPORT DE LIBS
////////////////////////////*/
// Register Custom Navigation Walker
require_once('includes/wp_bootstrap_navwalker.php');
// Register Custom Navigation Walker
require_once('includes/wp_bootstrap_pagination.php');


/*///////////////////////////////////////////////
////////// LOAD DE SCRIPTS
////////////////////////////*/
function medrx_scripts()
{   
    //wp_deregister_script( 'jquery' );
    //wp_enqueue_script('jquery-3.3.1', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js');
    wp_enqueue_script('bootstrap4', get_template_directory_uri() . '/assets/libs/bootstrap4/js/bootstrap.min.js');
    wp_enqueue_script('inputmask', get_template_directory_uri() . '/assets/libs/inputmask/jquery.mask.min.js');
    wp_enqueue_script('owlcarousel', get_template_directory_uri() . '/assets/libs/owl-carousel/owl.carousel.min.js');
    //wp_enqueue_script('wocoaccordion', get_template_directory_uri() . '/assets/libs/woco-accordion/js/woco.accordion.min.js');
    wp_enqueue_script('fontawesome', get_template_directory_uri() . '/assets/libs/font-awesome5/js/all.min.js');
    wp_enqueue_script('custom', get_template_directory_uri() . '/assets/js/custom.js');
    wp_enqueue_script('products', get_template_directory_uri() . '/assets/js/products.js');
    wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js');
    //wp_enqueue_script('reloadr', get_template_directory_uri() . '/reloadr.js');

    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/libs/bootstrap4/css/bootstrap.min.css');
    wp_enqueue_style('rubik', 'https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900');
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/libs/font-awesome5/css/all.min.css');
    wp_enqueue_style('animate', get_template_directory_uri() . '/assets/libs/animate/animate.css');
    wp_enqueue_style('hovereffects', get_template_directory_uri() . '/assets/libs/hover-effects/set2.css');
    wp_enqueue_style('owlcarousel', get_template_directory_uri() . '/assets/libs/owl-carousel/assets/owl.carousel.min.css');
    //wp_enqueue_style('wocoaccordion', get_template_directory_uri() . '/assets/libs/woco-accordion/css/woco-accordion.min.css');
    wp_enqueue_style('header', get_template_directory_uri() . '/assets/css/header.css');
    wp_enqueue_style('footer', get_template_directory_uri() . '/assets/css/footer.css');
    wp_enqueue_style('loja', get_template_directory_uri() . '/assets/css/loja.css');
    wp_enqueue_style('products', get_template_directory_uri() . '/assets/css/products.css');
    wp_enqueue_style('cart', get_template_directory_uri() . '/assets/css/cart.css');
    wp_enqueue_style('home', get_template_directory_uri() . '/assets/css/home.css');
    wp_enqueue_style('main', get_template_directory_uri() . '/assets/css/main.css');
    wp_enqueue_style('blog', get_template_directory_uri() . '/assets/css/blog.css');
    wp_enqueue_style('newsletter', get_template_directory_uri() . '/assets/css/newsletter.css');
    wp_enqueue_style('selos', get_template_directory_uri() . '/assets/css/selos.css');
    wp_enqueue_style('woocommerce', get_template_directory_uri() . '/assets/css/woocommerce.css');
    wp_enqueue_style('checkout', get_template_directory_uri() . '/assets/css/checkout.css');
    wp_enqueue_style('theme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'medrx_scripts');



/*///////////////////////////////////////////////
////////// REGISTRA OS MENUS DO SITE
////////////////////////////*/
register_nav_menus(array(
    'primary' => __('Principal', 'medrx'),
    'footer-left' => __('MedRx', 'medrx'),
    'footer-center-left' => __('Informações', 'medrx'),
    'footer-center-right' => __('Produtos 1', 'medrx'),    
    'footer-right' => __('Produtos 2', 'medrx')
));


/*///////////////////////////////////////////////
////////// REGISTRA OS WIDGETS
////////////////////////////*/
function footer_widgets_init() {
    register_sidebar( array(
    'name'          => esc_html__( 'Loja 1', 'medrx' ),
    'id'            => 'loja-1',
    'description'   => esc_html__( 'Menu Institucional', 'medrx' ),
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );
  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar loja', 'medrx' ),
    'id'            => 'loja',
    'description'   => esc_html__( 'Sidebar loja', 'medrx' ),
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );
  register_sidebar( array(
    'name'          => esc_html__( 'Footer MedRx', 'medrx' ),
    'id'            => 'footer-1',
    'description'   => esc_html__( 'Menu Institucional', 'medrx' ),
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );
  register_sidebar( array(
    'name'          => esc_html__( 'Footer Informações', 'medrx' ),
    'id'            => 'footer-2',
    'description'   => esc_html__( 'Menu de Páginas', 'medrx' ),
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
  register_sidebar( array(
    'name'          => esc_html__( 'Footer Produtos 1', 'medrx' ),
    'id'            => 'footer-3',
    'description'   => esc_html__( 'Menu de Produtos coluna 1', 'medrx' ),
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
  register_sidebar( array(
    'name'          => esc_html__( 'Footer Produtos 2', 'medrx' ),
    'id'            => 'footer-4',
    'description'   => esc_html__( 'Menu de Produtos coluna 2', 'medrx' ),
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', 'footer_widgets_init' );
    

/*///////////////////////////////////////////////
////////// REMOVE ITEM DO CARRINHO VIA AJAX
////////////////////////////*/


/*///////////////////////////////////////////////
////////// CLASSIFICAÇÃO ESTRELAS DOS PRODUTOS
////////////////////////////*/
function get_star_rating($val)
{
    echo '<hr/><div class="star-rating stars-loja" ><span class="verificar-star" style="width:'.( ( $val / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$val.'</strong> '.__( 'coisa/5', 'woocommerce' ).'</span></div>'.'<div class="nota-estrela"> <span>'.$val.'/5</span></div>';
}


/*///////////////////////////////////////////////
////////// DEFININDO VARIAÇÃO DO PRODUTO
////////////////////////////*/
function get_product_regular_price($variation_id) {
    global $woocommerce; 
    $product = new WC_Product_Variation($variation_id);
    return $product->get_regular_price(); 
}
function get_product_min_price($variation_id) {
    global $woocommerce; 
    $product = new WC_Product_Variation($variation_id);
    return $product->get_price(); 
}
function get_product_descricao($variation_id) {
    global $woocommerce; 
    $product = new WC_Product_Variation($variation_id);
    return $product->get_variation_attributes(); 
}
function get_product_ref($variation_id) {
    global $woocommerce; 
    $product = new WC_Product_Variation($variation_id);
    return $product->get_description(); 
}

//ADICONA NOVAS TABS
add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
function woo_new_product_tab( $tabs ) {
    
    // Adds the new tab
    
    $tabs['nossa_promessa'] = array(
        'title'     => __( 'Nossa Promessa', 'woocommerce' ),
        'priority'  => 10,
        'callback'  => 'woo_new_product_tab_nossa_promessa'
    );
    $tabs['perguntas_frequentes'] = array(
        'title'     => __( 'Perguntas Frequentes', 'woocommerce' ),
        'priority'  => 15,
        'callback'  => 'woo_new_product_tab_perguntas_frequentes'
    );
    $tabs['referencias_clinicas'] = array(
        'title'     => __( 'Referências Clínicas', 'woocommerce' ),
        'priority'  => 20,
        'callback'  => 'woo_new_product_tab_referencias_clinicas'
    );
    
    return $tabs;

}

function woo_new_product_tab_nossa_promessa()  {
    // The new tab content
    $prod_id = get_the_ID();
    echo'<p>'.get_post_meta($prod_id,'nossa_promessa',true).'</p>';
    //echo get_the_field('nossa_promessa',508);
}
function woo_new_product_tab_perguntas_frequentes()  {
    // The new tab content
    $prod_id = get_the_ID();
    echo'<p>'.get_post_meta($prod_id,'perguntas_frequentes',true).'</p>';
    //the_field('perguntas_frequentes');
}
function woo_new_product_tab_referencias_clinicas()  {
    // The new tab content
    $prod_id = get_the_ID();
    echo'<p>'.get_post_meta($prod_id,'referencias_clinicas',true).'</p>';
}


// REDIRECIONA CART PARA CHECKOUT
function bbloomer_redirect_checkout_add_cart( $url ) {
    $url = get_permalink( get_option( 'woocommerce_checkout_page_id' ) ); 
    return $url;
} 
add_filter( 'woocommerce_add_to_cart_redirect', 'bbloomer_redirect_checkout_add_cart' );

// REMOVE O AVISO VERDE PRODUTO ADD NO CARRINHO
add_filter( 'wc_add_to_cart_message_html', '__return_null' );

// REMOVE O ALERTA DE CUPOM
add_action( 'woocommerce_before_checkout_form', 'remove_checkout_coupon_form', 9 );
function remove_checkout_coupon_form(){
    remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
}

//REMOVE TABS
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {

    unset( $tabs['additional_information'] );          // Remove the additional information tab

    return $tabs;
}

//RENOMEANDO TABS
add_filter( 'woocommerce_product_tabs', 'wp_woo_rename_reviews_tab', 98);

function wp_woo_rename_reviews_tab($tabs) {
    
    $tabs['reviews']['title'] = 'Avaliações';
    
    return $tabs;
}

//PRIORIDADE TABS DEFAULT
add_filter( 'woocommerce_product_tabs', 'woo_reorder_tabs', 98 );
function woo_reorder_tabs( $tabs ) {

    $tabs['description']['priority'] = 1;           // Description first
    $tabs['reviews']['priority'] = 2;   // Additional information second

    return $tabs;
}

//Removendo alguns itens do sumário da pagina do produto (Nome do produto, Preço do produto e Referencia do produto)
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

 
//Função que adiciona o conteudo adicionado via Painel adm na função '@woocommerce_single_product_summary' do Woocommerce
function custom_summary( ) { 
    $prod_id = get_the_ID();
    echo'<hr/>'.get_post_meta($prod_id,'beneficios',true);
};     
add_action( 'woocommerce_single_product_summary', 'custom_summary', 40 ); 

// REMOVE TODAS AS OPÇÕES DE PRODUTOS, MENOS OPÇÃO VARIAVEL
add_filter( 'product_type_selector', 'remove_product_types' );
function remove_product_types( $types ){
    unset( $types['grouped'] );
    unset( $types['external'] );
    unset( $types['simple'] );

    return $types;
}

/*///////////////////////////////////////////////
////////// WORDPRESS LOGIN
////////////////////////////*/

function custom_login_css()
{
    echo '<link rel="stylesheet" type="text/css" href="'.get_stylesheet_directory_uri().'/css/wp-login.css"/>';
}
add_action('login_head', 'custom_login_css');

//Função que altera a URL, trocando pelo endereço do seu site
function my_login_logo_url()
{
    return get_bloginfo('url');
}
add_filter('login_headerurl', 'my_login_logo_url');

//Função que adiciona o nome do seu site, no momento que o mouse passa por cima da logo
function my_login_logo_url_title()
{
    return 'Nome do seu site - Voltar para Home';
}
add_filter('login_headertitle', 'my_login_logo_url_title');


// REMOVER FIELDS DESNECESSARIOS DO ONE PAGE CHECKOUT
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
    unset($fields['order']['order_comments']);
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_country']);
    unset($fields['shipping']['shipping_company']);
    unset($fields['shipping']['shipping_country']);

    return $fields;
}


add_filter( 'woocommerce_update_order_review_fragments', 'my_custom_shipping_table_update');

function my_custom_shipping_table_update( $fragments ) {
    
     
    ob_start();
    ?>
    <table class="my-custom-shipping-table">
        <tbody>

        <?php wc_cart_totals_shipping_html(); ?>
        </tbody>
    </table>
    <?php
    $woocommerce_shipping_methods = ob_get_clean();

    $fragments['.my-custom-shipping-table'] = $woocommerce_shipping_methods;
    

    return $fragments;
}

/*///////////////////////////////////////////////
////////// WIDGET LISTA OS PRODUTOS CADASTRADOS
////////////////////////////*/

function list_product_register_widget() {
    register_widget( 'list_product_widget' );
}

add_action( 'widgets_init', 'list_product_register_widget' );

class list_product_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            // widget ID
            'list_product_widget',
            // widget name
            __('Produtos MedRx', ' list_product_widget_domain'),
            // widget description
            array( 'description' => __( 'Listar os produtos MedRx', 'list_product_widget_domain' ), )
        );
    }
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        echo $args['before_widget'];
        //if title is present
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];
        //output
        $query = new WP_Query( array(
            'posts_per_page' => -1,
            'post_type' => 'product',
            'post_status' => 'publish',
            'hide_empty' => 0,
            'orderby' => 'title',
        ) );

        $output = '<ul>';

        while ( $query->have_posts() ) : $query->the_post();
            $output .= '<li><a href="'. get_permalink( $query->post) . '">' . $query->post->post_title . '</a></li>';
        endwhile;
        wp_reset_postdata();

        echo $output.'</ul>';
        // echo get_custom_product_list();
        // echo __( 'Hello, World from Hostinger.com', 'list_product_widget_domain' );
        echo $args['after_widget'];
    }
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) )
            $title = $instance[ 'title' ];
        else
            $title = __( 'Nossos Produtos', 'list_product_widget_domain' );
            ?>
            <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>
        <?php
    }
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }

}