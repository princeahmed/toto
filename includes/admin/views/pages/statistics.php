<div class="wrap">
    <h1 class="wp-heading-inline">Notification Statistics</h1>

	<?php

	include_once TOTO_INCLUDES . '/class-statistics.php';

	$statistics = new TOTO_Statistics();

	$statistics->filter_bar();

	$statistics->summary();

	$statistics->chart();;

	$statistics->render_tables();

	?>

</div>