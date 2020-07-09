<?php

extract( $atts );

$identities = vc_param_group_parse_atts( $identities );

if( empty( $identities ) )
	return;

$parent = uniqid( 'accordion-' );

$collapse = uniqid( 'collapse-' );
$heading =uniqid( 'heading-' );

$icon        = isset( $icon ) ? $icon               : 'fa fa-angle-down';
$icon_active = isset( $icon_active ) ? $icon_active : 'fa fa-angle-up';
$extra_classes = isset( $extra_classes ) ? ' ' . $extra_classes : '';

$active_tab = ! empty( $active_tab ) ? intval( $active_tab ) - 1 : 0;

?>
<div class="accordion accordion-right accordion-university<?php echo $extra_classes ?>" id="<?php echo $parent ?>" role="tablist" aria-multiselectable="true">

<?php
	foreach ( $identities as $i => $accordion ) {
		$in = $i == $active_tab ? ' in' : '';
		$active = $i == $active_tab ? ' active' : '';
	?>

    <div class="panel accordion-item <?php echo $active ?>">
  		<h4 class="accordion-toggle" role="tab" id="<?php echo $heading . '-' . $i ?>">
  			<a data-toggle="collapse" data-parent="#<?php echo $parent ?>" href="#<?php echo $id = ( !empty( $accordion['tab_id'] ) ? $accordion['tab_id'] : $collapse. '-' . $i ) ?>" aria-expanded="true" aria-controls="<?php echo $collapse . '-' . $i ?>">
  				<?php echo esc_html( $accordion['title'] ); ?>
  			</a>
  			<span class="accordion-expander">
  				<i class="<?php echo $icon ?>"></i>
  				<i class="<?php echo $icon_active ?>"></i>
  			</span>
  		</h4>
      <div id="<?php echo $id = ( !empty( $accordion['tab_id'] ) ? $accordion['tab_id'] : $collapse. '-' . $i ) ?>" class="accordion-collapse collapse<?php echo $in ?>" role="tabpanel" aria-labelledby="<?php echo $heading. '-' . $i ?>">
          <div class="accordion-body">
		  		<?php echo ra_helper()->do_the_content( $accordion['text'] ); ?>
          </div>
      </div>
    </div>

	<?php } ?>

</div>
