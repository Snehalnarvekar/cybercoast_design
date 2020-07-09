<?php
	
	$register_status = wp_kses_post( __( 'Unregistered', 'boo' ) );
	$activate_status = esc_html__( 'Activate Boo', 'boo' );
	$explanation_note = esc_html__( 'Let\'s activate the theme to enable updates, demos and multiple features', 'boo' );
	$check_updates = esc_html__( 'Disabled', 'boo' );
	
	$status = get_option( get_template() . '_license_key_status', false );
	
	if ( $status !== false && $status == 'valid' ) { 
		$register_status = wp_kses_post( __( 'Registered', 'boo' ) );
		$activate_status = esc_html__( 'Activated', 'boo' );	
		$check_updates = esc_html__( 'Enabled', 'boo' );
		$explanation_note = esc_html__( 'Thanks! The theme is activated.', 'boo' );
	}

?>

<div class="wrap rella-wrap">

	<div class="rella-dashboard">

		<div class="tab-content">

			<div id="rella-general" role="tabpanel" class="rella-tab-pane rella-tab-is-active">

				<ul class="rella-cards-container rella-dashboard-inner clearfix">

					<li class="rella-card rella-card-alt fullwidth">

						<div class="rella-card-inner">

							<div class="rella-card-header">

								<h3><span class="ring"><img src="<?php echo rella()->load_assets('img/admin/ring.png') ?>" alt="Ring"><i class="fa fa-check"></i></span><?php echo $activate_status; ?></h3>
								<h4><?php esc_html_e( $explanation_note ); ?></h4>
							</div><!-- /.rella-card-header -->

						</div><!-- /.rella-card-inner -->

					</li><!-- /.rella-card-alt -->

				</ul>

				<hr>

				<ul class="rella-cards-container rella-dashboard-inner clearfix">

					<li class="rella-card rella-card-alt">
						<div class="rella-card-inner">
							<span class="badge top"><?php echo $check_updates; ?></span>
							<div class="rella-icon-container">
								<img src="<?php echo rella()->load_assets('img/admin/auto-update.svg') ?>" alt="Auto Update">
							</div>
							<h3><?php esc_html_e( 'Automatic Updates', 'boo' ) ?></h3>
							<p><?php esc_html_e( 'Latest features, demos and more at your fingertips.', 'boo' ) ?></p>
							<div class="rella-card-footer clearfix"></div>
						</div>
					</li>

					<li class="rella-card rella-card-alt">
						<div class="rella-card-inner">
							<div class="rella-icon-container">
								<img src="<?php echo rella()->load_assets('img/admin/docs.svg') ?>" alt="Docs">
							</div>
							<h3><?php esc_html_e( 'Documentation', 'boo' ) ?></h3>
							<p><?php esc_html_e( 'Extensive documentation including up-to-date changelog.', 'boo' ) ?></p>
							<div class="rella-card-footer clearfix">
								<a class="rella-button" target="_blank" href="https://docs.themerella.com/"><span><?php esc_html_e( 'Read Docs', 'boo' ) ?></span> <i class="fa fa-angle-right"></i></a>
							</div>
						</div>
					</li>

					<li class="rella-card rella-card-alt">
						<div class="rella-card-inner">
							<div class="rella-icon-container">
								<img src="<?php echo rella()->load_assets('img/admin/video-tuts.svg') ?>" alt="Video Tuts">
							</div>
							<h3><?php esc_html_e( 'Video Tutorials', 'boo' ) ?></h3>
							<p><?php esc_html_e( 'The fastest and easiest way to learn more about Boo..', 'boo' ) ?></p>
							<div class="rella-card-footer clearfix">
								<a class="rella-button" target="_blank" href="https://www.youtube.com/channel/UCSiSz4yilEFdCNtwUHVjHrg"><span><?php esc_html_e( 'Watch now', 'boo' ) ?></span> <i class="fa fa-angle-right"></i></a>
							</div>
						</div>
					</li>

				</ul>

				<a href="https://themerella.com/dashboard/?task=support" target="_blank" class="rella-button btn-block"><?php esc_html_e('COULDN\'T FIND WHAT YOU\'RE LOOKING FOR? SUBMIT A TICKET', 'boo' ) ?> <i class="fa fa-angle-right"></i></a>

			</div>

		</div>

	</div>

</div>