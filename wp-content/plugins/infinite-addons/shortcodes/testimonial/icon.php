<?php

extract( $atts );

$classes = array( $this->get_class( $style ), $align, $el_class, $this->get_id() );
// Enqueue Conditional Script
$this->scripts();
$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ra_helper()->sanitize_html_classes( $classes ) ?>">

	<svg xmlns="http://www.w3.org/2000/svg" width="37.969" height="28.125" viewBox="0 0 37.969 28.125">
	  <path d="M36.77,0.86Q23.463,7.575,23.464,19.476a9.712,9.712,0,0,0,2.5,6.744A7.72,7.72,0,0,0,31.887,29a6.667,6.667,0,0,0,5.066-2.136,7.362,7.362,0,0,0,2.014-5.249,7.342,7.342,0,0,0-2.075-5.157,8.224,8.224,0,0,0-5.249-2.594q0-4.944,7.446-8.606Zm-22.4,0Q1.125,7.575,1.125,19.476A9.785,9.785,0,0,0,3.6,26.22,7.63,7.63,0,0,0,9.487,29a6.765,6.765,0,0,0,5.1-2.136,7.3,7.3,0,0,0,2.045-5.249,7.342,7.342,0,0,0-2.075-5.157,8.278,8.278,0,0,0-5.31-2.594q0-4.944,7.507-8.606Z" transform="translate(-1.125 -0.875)"/>
	</svg>

	<?php $this->get_quote() ?>
	<?php $this->get_details() ?>

</div>
