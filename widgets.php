class Listing_Sidebar_Licencia extends WP_Widget {

	function __construct() {
		parent::__construct(
			'listing_licencia', // Base ID
			'&#x1F536; ' . esc_html__( 'Listing', 'listable' ) . '  &raquo; ' . esc_html__( 'Licencia', 'listable' ), // Name
			array( 'description' => esc_html__( 'Licencia.', 'listable' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $post;

		
		$licencia = get_field( "foto_licencia" );

		
		if ( empty( $licencia ) ) {
			return;
		}
      ?>
      <style >
      .licencia{
    padding-top: 24px;
    padding-bottom: 24px;
    border: 1px solid rgba(0, 0, 0, 0.075);
    border-radius: 4px;
    padding:20px;
}
      </style>
		<div class="licencia listing-gallery__items  js-widget-gallery">		
				<?php
				//print_r($licencia);
				echo "<a href='".$licencia['url']."'  class='listing-gallery__item'>";
				echo "<img src='".$licencia['url']."' alt='licencia' title='licencia' itemprop='image' caption='' description=''>";
				echo "</a >";
				
			  ?>

		</div><!-- .listing-map-content -->

		<?php
		//echo $args['after_widget'];
	}

	public function form( $instance ) {
		echo '<p>' . $this->widget_options['description'] . '</p>';
	}
} // class Listing_Sidebar_Map_Widget

class Listing_Sidebar_Aforo extends WP_Widget {

	function __construct() {
		parent::__construct(
			'listing_aforo', // Base ID
			'&#x1F536; ' . esc_html__( 'Listing', 'listable' ) . '  &raquo; ' . esc_html__( 'Aforo', 'listable' ), // Name
			array( 'description' => esc_html__( 'Aforo.', 'listable' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $post;

		
		$licencia = get_field( "_job_aforo" );

		
		if ( empty( $licencia ) ) {
			return;
		}
      ?>
      <style >
      .licencia{
    padding-top: 24px;
    padding-bottom: 24px;
    border: 1px solid rgba(0, 0, 0, 0.075);
    border-radius: 4px;
    padding:20px;
}
      </style>
		<div class="licencia listing-gallery__items ">		
				<?php
				//print_r($licencia);
				
				echo "<strong style='font-size:18px'>Aforo de: ".$licencia.'</strong>';
				
				
			  ?>

		</div><!-- .listing-map-content -->

		<?php
		//echo $args['after_widget'];
	}

	public function form( $instance ) {
		echo '<p>' . $this->widget_options['description'] . '</p>';
	}
} // class Listing_Sidebar_Map_Widget
