<?php
extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$mobile_classname = ( 'phone-1' === $mockup ? 'mobile-mockup-1' : 'mobile-mockup-2' );
$classes = array( $mobile_classname, $this->get_class( $style ), $el_class, $this->get_id() );

$this->generate_css();
$this->get_swipe_hint();

$opts = $this->get_options( true );
unset( $opts['contain'] );
unset( $opts['prevNextButtons'] );
unset( $opts['groupCells'] );
unset( $opts['cellSelector'] );
unset( $opts['pageDots'] );
unset( $opts['cellAlign'] );
unset( $opts['wrapAround'] );

$default_args = array(
	'wrapAround'      => true,
	'prevNextButtons' => false,
	'groupCells'      => false,
	'cellAlign'       => 'center',
	'contain'         => false,
	'cellSelector'    => '.carousel-cell',
	'pageDots'        => true,
);

$opts =  wp_parse_args( $opts, $default_args );

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ra_helper()->sanitize_html_classes( $classes ); ?>">

	<div class="carousel row" data-flickity='<?php echo wp_json_encode( $opts ); ?>'>
	<?php
		$this->columnize_content( $content );
		echo ra_helper()->do_the_content( $content );
	?>
	</div><!-- /.carousel-items -->

	<figure class="carousel-phone-bg">
		<img src="<?php echo get_template_directory_uri() . '/assets/img/mockups/' . $mockup . '.png'  ; ?>">
	</figure>

</div><!-- /.carousel-device -->