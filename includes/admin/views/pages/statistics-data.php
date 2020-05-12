<?php defined( 'ABSPATH' ) || exit; ?>

<div class="statistics-table-wrap <?php echo ! empty( $this->get_submitted_data() ) ? '' : 'hidden'; ?>">

    <div class="statistics-table-header">
        <h3 class="statistics-table-title"><?php _e( 'Submitted Data', 'social-proof-fomo-notification' ) ?></h3>
        <p class="statistics-table-description description"><?php _e( 'List of all the submitted Data through the form.', 'social-proof-fomo-notification' ) ?></p>
    </div>

    <table class="widefat statistics-table" id="top-email-table">
        <thead>
        <tr>
            <th>#</th>
            <th><?php _e( 'Data', 'social-proof-fomo-notification' ) ?></th>
            <th><?php _e( 'IP', 'social-proof-fomo-notification' ) ?></th>
            <th><?php _e( 'URL', 'social-proof-fomo-notification' ) ?></th>
        </tr>
        </thead>

        <tbody>

		<?php

		if ( ! empty( $this->get_submitted_data() ) ) {
			$i = 1;
			foreach ( $this->get_submitted_data() as $item ) { ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $item->data; ?></td>
                    <td><?php echo $item->ip; ?></td>
                    <td><?php printf( '<a href="%1$s">%1$s</a>', $item->url ); ?></td>
                </tr>
				<?php
				$i ++;
			}
		}
		?>

        </tbody>

    </table>

</div>