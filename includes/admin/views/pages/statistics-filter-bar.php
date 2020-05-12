<?php defined( 'ABSPATH' ) || exit; ?>

<div class="trust-plus-mt-20 trust-plus-filter-bar" id="trust_plus_n_statistics_filter">
	<div class="trust-plus-input-group">
		<div class="trust-plus-form-group trust-plus-mr-20">
			<label for="notification_id"><?php _e('Select Notification', 'social-proof-fomo-notification'); ?></label>
			<select name="notification_id" id="notification_id">
				<?php

				if ( ! empty( $this->get_active_notifications() ) ) {
					$posts = wp_list_pluck( $this->get_active_notifications(), 'post_title', 'ID' );
					foreach ( $posts as $id => $title ) {
						printf( '<option value="%1$s">%2$s</option>', $id, $title );
					}
				}

				?>

			</select>
		</div>

		<div class="trust-plus-form-group trust-plus-mr-20">
			<label for="start_date"><?php _e('Start Date', 'social-proof-fomo-notification'); ?></label>
			<input type="text" id="start_date" class="trust_plus_date_field" name="start_date" value="<?php echo $this->query_args['start_date']; ?>">
		</div>

		<div class="trust-plus-form-group trust-plus-mr-20">
			<label for="end_date"><?php _e('End Date', 'social-proof-fomo-notification'); ?></label>
			<input type="text" id="end_date" class="trust_plus_date_field" name="end_date" value="<?php echo $this->query_args['end_date']; ?>">
		</div>

	</div>
</div>