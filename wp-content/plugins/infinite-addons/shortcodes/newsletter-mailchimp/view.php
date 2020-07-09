<?php

extract( $atts );

$classes = array( 
	'subscribe-form',
	$this->get_class( $style ), 
	$this->get_btn_class( $btn_style ), 
	$inputs_size, 
	$inputs_radius, 
	$inputs_border, 
	$inputs_shadow, 
	$btn_state, 
	$btn_position, 
	$el_class, 
	$this->get_id() 

);
// Enqueue Conditional Script
$this->scripts();
$this->generate_css();

?>
<div id="<?php echo $this->get_id(); ?>" class="<?php echo ra_helper()->sanitize_html_classes( $classes ); ?>" >

	<form id="ra_subscribe_form" class="ra_sf_form" method="post" action="<?php echo the_permalink() ?>">
		<p class="ra_sf_paragraph">
			<input type="email" class="ra_sf_text" id="email" name="email" placeholder="<?php echo esc_attr( $placeholder_text ) ?>" value="" />
		</p>
		<?php $this->get_submit_button(); ?>
		<input type="hidden" id="list_id" name="list_id" value="<?php echo $list_id ?>">
		<?php wp_nonce_field( 'ra-mailchimp-form' ); ?>
	</form>
	<div id="ra_sf_response"></div>
</div>