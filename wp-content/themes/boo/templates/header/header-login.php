<?php
	$icon_opts = rella_get_icon( $atts );
	$icon = !empty( $icon_opts['type'] ) && !empty( $icon_opts['icon'] ) ? $icon_opts['icon'] : 'fa fa-user';
?>
<div class="header-module module-login-form module-search-form style-default">
	<span class="module-trigger <?php echo esc_attr( $atts['trigger_size'] ) ?>"><i class="<?php echo esc_attr( $icon ) ?>"></i></span>
		<div class="module-container">
<?php

if( is_user_logged_in() ):

	global $current_user;
	$display_user_name = $current_user->user_login;
	$display_user_ID = $current_user->ID;

	$current_page_URL = $_SERVER["REQUEST_URI"];
	$logout_url = wp_logout_url( $current_page_URL );

?>


	<div>
		<?php echo get_avatar( $display_user_ID, 60, null, null, array( 'class' => 'img-circle' )  ); ?>
		<h5 class="modal-title text-center mt25 mb15"><?php esc_html_e( 'Howdy, ', 'boo' ); echo $display_user_name; ?></h5>
	</div>
	<div class="row">
		<div class="col-sm-offset-2 col-sm-8">
			<a class="btn btn-default" href="<?php echo esc_url( $logout_url ); ?>"><?php esc_html_e( 'Log Out', 'boo' ); ?></a>
		</div>
	</div>

<?php else: ?>

	<form id="rella-login" action="login" method="post">
			<p style="color:#999;" class="status"></p>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="form-group">
				<input id="username" type="text" name="username" class="input-md input-rounded form-control" placeholder="username" maxlength="100" required>
			</div>
		</div>
	
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="form-group">
				<input id="password" type="password" class="input-md input-rounded form-control" placeholder="password" maxlength="100" required>
			</div>
		</div>
	
		<div class="col-sm-12 mt10 text-center mb20">
			<button type="submit" class="btn btn-default"><?php echo esc_html__( 'Login', 'boo' ); ?></button>
		</div>
		<div class="col-sm-12 text-center"><a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="color-dark"><?php echo esc_html__( 'Forgot Password?', 'boo' ); ?></a></div>
	<?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
	</form>

<?php endif; ?>

	</div>
</div>