<?php defined( 'ABSPATH' ) || exit; ?>

<div class="statistics-table-wrap <?php echo ! empty( $this->get_top_emoji() ) ? '' : 'hidden'; ?>">

	<div class="statistics-table-header">
		<h3 class="statistics-table-title"><?php _e( 'Feedbacks', 'social-proof-fomo-notification' ) ?></h3>
		<p class="statistics-table-description description"><?php _e( 'Reacted emoji by counts.', 'social-proof-fomo-notification' ) ?></p>
	</div>

	<table class="widefat statistics-table" id="top-emoji-table">
		<thead>
		<tr>
			<th>#</th>
			<th><?php _e( 'Feedback', 'social-proof-fomo-notification' ) ?></th>
			<th><?php _e( 'Count', 'social-proof-fomo-notification' ) ?></th>
		</tr>
		</thead>

		<tbody>

		<?php

		if ( ! empty( $this->get_top_emoji() ) ) {
			$i = 1;
			foreach ( $this->get_top_emoji() as $item ) { ?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $item->type; ?></td>
					<td><?php echo $item->total; ?></td>
				</tr>
				<?php
				$i ++;
			}
		}
		?>

		</tbody>

		<tfoot class="hidden">
		<tr>
			<td colspan="5">
				<div class="ph-item">

					<div class="ph-col-12">
						<div class="ph-row trust-plus-mb-50">
							<div class="ph-col-6 big"></div>
							<div class="ph-col-4 empty big"></div>
							<div class="ph-col-2 big"></div>
							<div class="ph-col-4"></div>
							<div class="ph-col-8 empty"></div>
							<div class="ph-col-6"></div>
							<div class="ph-col-6 empty"></div>
							<div class="ph-col-12"></div>
						</div>

						<div class="ph-row trust-plus-mb-50">
							<div class="ph-col-6 big"></div>
							<div class="ph-col-4 empty big"></div>
							<div class="ph-col-2 big"></div>
							<div class="ph-col-4"></div>
							<div class="ph-col-8 empty"></div>
							<div class="ph-col-6"></div>
							<div class="ph-col-6 empty"></div>
							<div class="ph-col-12"></div>
						</div>


						<div class="ph-row trust-plus-mb-50">
							<div class="ph-col-6 big"></div>
							<div class="ph-col-4 empty big"></div>
							<div class="ph-col-2 big"></div>
							<div class="ph-col-4"></div>
							<div class="ph-col-8 empty"></div>
							<div class="ph-col-6"></div>
							<div class="ph-col-6 empty"></div>
							<div class="ph-col-12"></div>
						</div>


						<div class="ph-row trust-plus-mb-50">
							<div class="ph-col-6 big"></div>
							<div class="ph-col-4 empty big"></div>
							<div class="ph-col-2 big"></div>
							<div class="ph-col-4"></div>
							<div class="ph-col-8 empty"></div>
							<div class="ph-col-6"></div>
							<div class="ph-col-6 empty"></div>
							<div class="ph-col-12"></div>
						</div>

					</div>

				</div>
			</td>
		</tr>
		</tfoot>

	</table>

</div>