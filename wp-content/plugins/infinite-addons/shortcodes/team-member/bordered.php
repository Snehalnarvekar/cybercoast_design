<?php

extract( $atts );

// classes
$classes = array( $this->get_style_class( $template ), $el_class, $this->get_id() );
// Enqueue Conditional Script
$this->scripts();
$this->generate_css();

?>
<div class="team-member <?php echo ra_helper()->sanitize_html_classes( $classes ) ?>" id="<?php echo $this->get_id() ?>">

	<?php $this->get_image() ?>

	<div class="team-member-details">
		<?php $this->get_name() ?>
		<?php $this->get_position() ?>
		<?php $this->get_social() ?>
	</div>

</div>
