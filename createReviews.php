<?php
/*
 * public_html/wp-content/plugins/create_reviews/create_reviews.php
Plugin Name: Create Reviews 
Plugin URI: 
Description: Crea reviews para tus productos de una forma rapida y efectiva
Version: 1.1.0
* WC requires at least: 3.5.0
* WC tested up to: 4.2.6
*/

function create_reviews_menu_options()
{
    add_menu_page('Creador de reviews','Creador de reviews','manage_options','creador-de-reviews','creador_de_reviews_page','',200);
}

add_action('admin_menu','create_reviews_menu_options');

function creador_de_reviews_page(){
    ?> 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <h3 class="text-center">Creador de reviews 1.0</h3>
<?php $args = array( 'post_type' => 'product', 'posts_per_page' => -1 );
    $args = array(
        'post_type' => 'product',
        'orderby' => $orderby,
    );
    $wp_query = new WP_Query($args);

 ?>
        <form method="post" action="/gracias-test/">
            <div class="form-group">
                <label for="CRC_Nombre">Nombre</label>
                <input type="text" class="form-control" name="CRC_name" placeholder="Nombre del author del review">
            </div>
            <div class="form-group">
                <label for="CRC_email">email</label>
                <input type="text" class="form-control" name="CRC_email" placeholder="Correo del author del review">
            </div>
            <div class="form-group">
                <label for="CRC_products">Elije el producto donde ira el review</label>
                <select class="form-control" name="CRC_products">
                <?php 
                    while ($wp_query->have_posts()) : $wp_query->the_post(); 

                    //woocommerce_get_template_part('content', 'product');
                    echo '<option value="'.get_the_ID().'">'.get_the_title().'</option>';
        
                    endwhile; // end of the loop. 
                    wp_reset_query(); 
                ?>
                </select>
            </div>
            <div class="form-group">
                <label for="CRC_ip">IP</label>
                <input type="text" class="form-control" name="CRC_ip" placeholder="Escribe la ip que se guardara con este review">
            </div>
            <div class="form-group">
                <label for="CRC_review">Texto del Review</label>
                <textarea class="form-control" name="CRC_review" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="CRC_stars">Elija las estrellas que se aplicaran al review</label>
                <select class="form-control" name="CRC_stars">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            <div class="form-group">
                <p class="text-center"><input class="btn btn-success mt-4" type="submit" name="CRC_submit_review" value="Guardar review"></p>
            </div>
        </form>

    <?php
}

function capture_review(){
    if(array_key_exists('CRC_submit_review', $_POST))
    {
        $texto = $_POST['CRC_review'];
        $ip = $_POST['CRC_ip'];
        $name = $_POST['CRC_name'];
        $postid = $_POST['CRC_products'];
        $stars = $_POST['CRC_stars'];
        $email = $_POST['CRC_email'];

        $time = current_time('mysql');

        $comment_id = wp_insert_comment( array(
            'comment_post_ID' => $postid,
            'comment_author' => $name,
            'comment_content' => $texto,
            'comment_author_IP' => $ip,
            'comment_agent' => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.10) Gecko/2009042316 Firefox/3.0.10 (.NET CLR 3.5.30729)',
            'comment_date' => $time,
            'comment_approved' => 0,
            'comment_author_email' => $email, // <== Important
            //'comment_type'         => '',
            //'comment_parent'       => 0,
            //'user_id'              => 5, // <== Important
            ) );
        
        // HERE inserting the rating (an integer from 1 to 5)
        update_comment_meta( $comment_id, 'rating', $stars );
    }
}

add_action('wp_head','capture_review');


/* Main Plugin File */
/*
function my_plugin_activate() {

  $prefix = $wpdb->prefix;
  $wpdb->query($wpdb->prepare("UPDATE ". $prefix ."commentmeta set meta_value=truncate((meta_value/2),0) where meta_key ='rating' and meta_value>5"));

}
register_activation_hook( __FILE__, 'my_plugin_activate' );
*/

 register_activation_hook( __FILE__, 'plugininstall' );

    function plugininstall() {
      global $wpdb;
      $thetable = $wpdb->prefix."commentmeta";
      //Delete any options that's stored also?
      //delete_option('wp_yourplugin_version');
      $wpdb->query("UPDATE ". $thetable ." set meta_value=truncate((meta_value/2),0) where meta_key ='rating' and meta_value>5");
      
      $thetable = $wpdb->prefix."postmeta";
      $wpdb->query("UPDATE ". $thetable ." set meta_value=truncate((meta_value/2),0) where meta_key ='_wc_average_rating' and meta_value>5");
      
}



?>
