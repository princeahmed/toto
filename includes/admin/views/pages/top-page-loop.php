<?php

if ( ! empty( $top_pages ) ) {
	$i = 1;
	foreach ( $top_pages as $item ) { ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><a href="<?php echo $item->url; ?>" target="_blank"><?php echo $item->url; ?></a></td>
			<td><?php echo $type_title[ $item->type ]; ?></td>
			<td><?php echo $item->total_uniques; ?></td>
			<td><?php echo $item->total_sessions; ?></td>
		</tr>
		<?php
		$i ++;
	}
}