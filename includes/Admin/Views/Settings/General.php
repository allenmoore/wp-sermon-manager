<?php
if ( ! defined( 'WPINC' ) )  die;

$current_view = empty( $current_view ) ? 'general' : $current_view;
?>
<div class="wrap <?php echo esc_attr( 'wpsm-settings -' . $current_view ); ?>">
	<header class="settings-header" role="banner">
		<h1 class="wp-heading-inline"><?php esc_html_e( 'WP Sermon Manager Settings', 'wpsm' ); ?></h1>
	</header>
	<main class="settings-main">
		<form method="<?php echo esc_attr( apply_filters( 'wpsm_settings_form_method_view_' . $current_view, 'post' ) ); ?>" id="js-wpsm-settings-form" class="settings-form" action="" enctype="multipart/form-data">
			<nav id="js-wpsm-settings-nav">
				<ul class="nav-list">
					<?php
					foreach ( $tabs as $name => $label ) {
						echo printf( '<li class="nav-item"><a href="%s" class="nav-link %s">%s</a></li>', esc_url( admin_url( 'edit.php?post_type=wpsm_sermon&page=wpsm-settings&view=' . $name ) ), esc_html( $current_view === $name ? '-active' : '' ), esc_html( $label ) );
					}
					do_action( 'wpsm_setting_views' );
					?>
				</ul>
			</nav>
			<section class="settings-content" aria-labelledby="general-settings-headline" aria-describedby="">
				<h2 id="general-settings-headline" class="section-heading"><?php esc_html( 'General Settings', 'wpsms' );?></h2>
				<div class="section-description"><?php echo esc_html( 'General WP Sermon Manager settings including, slug customization, taxonomy name customization, and more', 'wpsm' );?></div>
				<div class="section-settings-body">
					<div class="section-row">
						<div class="section-column -left">
							<?php echo esc_html( 'Audio & Video Player' ); ?>
						</div>
					</div>
					<div class="section-column -right">
						<select id="js-wpsm-user-player" class="select-box" name="select-user-player">
							<option value="plyr"><?php echo esc_html( 'Plyr' ); ?></option>
							<option value="mediaelement"><?php echo esc_html( 'media-element' ); ?></option>
							<option value="old-wp"><?php echo esc_html( 'Old WP Player' ); ?></option>
							<option value="html5"><?php echo esc_html( 'Browser HTML5' ); ?></option>
						</select>
					</div>
					<div class="section-column -right">
						<select id="js-wpsm-date-night" class="select-box" name="select-date-night">
							<option value="mm/dd/YY"><?php echo esc_html( 'mm/dd/YY' ); ?></option>
							<option value="dd/mm/yy"><?php echo esc_html( 'dd/mm/YY' ); ?></option>
							<option value="YY/mm/dd"><?php echo esc_html( 'YY/mm/dd' ); ?></option>
							<option value="dd/mm/yy"><?php echo esc_html( 'dd/mm/YY' ); ?></option>
						</select>
					</div>
				</div>
			</section>
		</form>
	</main>
</div>
