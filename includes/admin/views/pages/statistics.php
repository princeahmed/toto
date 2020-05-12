<?php defined('ABSPATH') || exit; ?>

<div class="wrap">
    <h1 class="wp-heading-inline"><?php _e('Notification Statistics', 'social-proof-fomo-notification') ?></h1>

	<?php

	include_once TRUST_PLUS_INCLUDES . '/class-statistics.php';

	$statistics = new Trust_Plus_Statistics();

	$statistics->filter_bar();

	$statistics->summary();

	$statistics->chart();;

	$statistics->render_tables();

	?>

</div>