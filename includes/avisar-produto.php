<?php
$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
require_once($parse_uri[0] . 'wp-load.php');

$product_id  = $_POST['product_id'];
$name    = $_POST['name'];
$email   = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];


$post_id = wp_insert_post(array (
   'post_type' => 'aviseme',
   'post_title' => $email,
   'post_content' => serialize( array( 'product_id'=>$product_id, 'subject'=>$subject, 'name'=>$name, 'email'=>$email, 'message'=>$message ) ),
   'post_status' => 'publish',
   'comment_status' => 'closed',
   'ping_status' => 'closed',
));

if ($post_id) {
   add_post_meta($post_id, '_notified', 0);
   $status = true;
   $message = 'Sua solicitação foi enviada com sucesso.';
}else{
	$status = false;
	$message = 'Não foi possível enviar sua solicitação.';
}

echo json_encode( array('status'=>$status, 'message'=>$message) );