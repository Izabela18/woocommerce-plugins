<?php
/*
Plugin Name: Best selling products plugin
Description: My best selling shortcode plugin
Version: 1.0.0
Author: Izabela Walczak-Niznik

*/

add_shortcode( 'bestselling_products', 'sp_bestselling_products' );
function sp_bestselling_products($atts){

	global $woocommerce_loop;

	extract(shortcode_atts(array(
		'cats' => '',
		'tax' => 'product_cat',
		'per_cat' => '3',
		'columns' => '3',
	), $atts));


$args = array(
    'post_type' => 'product',
    'meta_key' => 'total_sales',
    'orderby' => 'meta_value_num',
    'posts_per_page' => 10,

);

ob_start();


$woocommerce_loop['columns'] = $columns;

		// query database
		$products = new WP_Query( $args );

    //var_dump($products);

		$woocommerce_loop['columns'] = $columns;

		if ( $products->have_posts() ) : ?>


			<?php woocommerce_product_loop_start(); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

          <?php echo '<div>' . $products->post->post_excerpt . '</div>'; ?>

					<?php woocommerce_get_template_part( 'content', 'product' ); ?>


				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

		<?php endif;

		wp_reset_postdata();


	return '<div class="woocommerce columns-' . $columns . '">' . ob_get_clean() . '</div>';




}

?>
