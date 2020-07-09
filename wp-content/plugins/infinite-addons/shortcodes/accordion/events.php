<?php
extract( $atts );

// Enqueue Conditional Script
$this->scripts();

if( empty( $items ) ) {
	return '';
}

// classes
$classes = array( 
	$el_class, 
	$this->get_id() 
);

// icons
$icon = rella_get_icon( $atts, true );
$icon_active = rella_get_icon( $atts, true, 'active_' );

$icon        = !empty( $icon ) ? $icon['icon'] : 'fa fa-chevron-down';
$icon_active = !empty( $icon_active ) ? $icon_active['icon'] : 'fa fa-chevron-up';

$active_tab = ! empty( $active_tab ) ? intval( $active_tab ) - 1 : 0;
$this->generate_css();
?>
<div class="rella-accordion-event <?php echo ra_helper()->sanitize_html_classes( $classes ) ?>" id="<?php echo $this->get_id() ?>" role="tablist" aria-multiselectable="true">
<?php
foreach( $items as $i => $item ):
	$in = $i == $active_tab ? ' in' : '';
	$active = $i == $active_tab ? ' active' : '';
?>
	<div class="panel accordion-item<?php echo $active ?>">
		<h4 class="accordion-toggle" role="tab" id="heading_<?php echo $this->get_id( $item ) ?>">
			<a data-toggle="collapse" data-parent="#<?php echo $this->get_id() ?>" href="#<?php echo $this->get_id( $item ) ?>" aria-expanded="false" aria-controls="<?php echo $this->get_id( $item ) ?>">
				<span class="accordion-event-title"><?php echo wp_kses_data( $item['title'] ) ?></span>
				<?php 

					$additional = vc_param_group_parse_atts( $item['additional'] );
					foreach ( $additional as $add ) {
						if ( empty( $add['add_title'] ) ) {
							continue;
						}
						
					echo '<span class="accordion-event-info">
							<small>' . esc_html( $add['add_title'] ) . '</small>
							' . esc_html( $add['add_info'] ) . '
						</span>';
					}
					
				?>
			</a>

			<?php if( 'yes' === $show_icon ) { ?>
			<span class="accordion-expander">
				<i class="<?php echo $icon ?>"></i>
				<i class="<?php echo $icon_active ?>"></i>
			</span>
			<?php } ?>
			
		</h4>
		<div id="<?php echo $this->get_id( $item ) ?>" class="accordion-collapse collapse<?php echo $in ?>" role="tabpanel" aria-labelledby="heading_<?php echo $this->get_id( $item ) ?>">
			<div class="accordion-body">
			<?php echo $item['content']; ?>
			</div>
		</div>
	</div>
<?php endforeach; ?>
</div>