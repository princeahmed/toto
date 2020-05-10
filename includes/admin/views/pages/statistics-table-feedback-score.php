<div class="statistics-table-wrap <?php echo ! empty( $this->get_feedback_scores() ) ? '' : 'hidden'; ?>">

	<div class="statistics-table-header">
		<h3 class="statistics-table-title"><?php _e( 'Feedbacks', 'toto' ) ?></h3>
		<p class="statistics-table-description description"><?php _e( 'Reacted scores by counts.', 'toto' ) ?></p>
	</div>

	<table class="widefat statistics-table" id="top-score-table">
		<thead>
		<tr>
			<th>#</th>
			<th><?php _e( 'Feedback', 'toto' ) ?></th>
			<th><?php _e( 'Count', 'toto' ) ?></th>
		</tr>
		</thead>

		<tbody>

		<?php

		if ( ! empty( $this->get_feedback_scores() ) ) {
			$i = 1;
			foreach ( $this->get_feedback_scores() as $item ) { ?>
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


	</table>

</div>