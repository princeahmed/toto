<div class="wrap">
    <h1 class="wp-heading-inline">Notification Data</h1>

	<?php
	$toto_current_page = 'notification-data';
	include TOTO_INCLUDES . '/admin/views/pages/filter-bar.php';
	?>

    <div class="toto-notification-data">

        <div class="toto_n_data">

			<?php

            //declared in filter-bar.php
			$nid = ! empty( $posts ) ? array_key_first( $posts ) : '';

			$results = toto_get_n_data( [ 'nid' => $nid ] );

			include TOTO_INCLUDES . '/admin/views/pages/data-loop.php';

			?>
        </div>

        <div class="toto_n_data_ph toto-hidden">
            <div class="ph-item">

                <div class="ph-col-12">
                    <div class="ph-row">
                        <div class="ph-col-12 big toto-mb-20"></div>
                        <div class="ph-col-10 big toto-mb-20"></div>
                        <div class="ph-col-8 big toto-mb-20"></div>
                        <div class="ph-col-12 big toto-mb-20"></div>
                        <div class="ph-col-11 big toto-mb-20"></div>

                        <div class="ph-col-12 big toto-mb-20"></div>
                        <div class="ph-col-10 big toto-mb-20"></div>
                        <div class="ph-col-8 big toto-mb-20"></div>
                        <div class="ph-col-12 big toto-mb-20"></div>
                        <div class="ph-col-11 big toto-mb-20"></div>
                    </div>
                </div>

            </div>
        </div>

        <div class="toto-pagination-wrap">
            <ul class="toto-pagination">
                <li class="page-item"><a class="page-link disabled" href="#">Previous</a></li>

                <li class="page-item"><a class="page-link active" href="#" data-page="1">1</a></li>
                <li class="page-item"><a class="page-link" href="#" data-page="2">2</a></li>
                <li class="page-item"><a class="page-link" href="#" data-page="3">3</a></li>

                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </div>

    </div>

</div>