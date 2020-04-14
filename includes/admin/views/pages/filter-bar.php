<?php

$current_page = 'toto_notification_page_notification-data' == get_current_screen()->id ? 'data' : 'statistics';

$args = [
	'post_type'     => 'toto_notification',
	'post_per_page' => - 1,
	'post_status'   => 'publish',
	'order'         => 'DESC',
	'orderby'       => 'date',
];

$posts = get_posts( $args );

if ( ! empty( $posts ) ) {
	$posts = wp_list_pluck( $posts, 'post_title', 'ID' );
}

?>

<div class="toto-mt-20 toto-filter-bar" id="toto_n_<?php echo $current_page; ?>_filter">
    <div class="toto-input-group">
        <div class="toto-form-group toto-mr-20">
            <label for="notification_id">Select Notification</label>
            <select name="notification_id" id="notification_id">
				<?php
				foreach ( $posts as $id => $title ) {
					printf( '<option value="%1$s">%2$s</option>', $id, $title );
				}
				?>

            </select>
        </div>

        <div class="toto-form-group toto-mr-20">
            <label for="start_date">Start Date</label>
            <input type="text" id="start_date" class="toto_date_field" name="start_date" value="<?php echo date( 'Y-m-d', strtotime( '-7 days' ) ); ?>">
        </div>

        <div class="toto-form-group toto-mr-20">
            <label for="end_date">End Date</label>
            <input type="text" id="end_date" class="toto_date_field" name="end_date" value="<?php echo date( 'Y-m-d', strtotime( 'today' ) ); ?>">
        </div>


		<?php if ( 'data' == $current_page  ) { ?>
            <div class="toto-form-group toto-ml-auto toto-mt-auto flex-row align-center">
                <label for="per_page" class="toto-mr-10">Items Per Page</label> <select name="per_page" id="per_page">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
		<?php } ?>
    </div>
</div>