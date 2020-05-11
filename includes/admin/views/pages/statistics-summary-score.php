<?php

defined( 'ABSPATH' ) || exit;

$count = 0;

$score_total = [
	'feedback_score_1_total',
	'feedback_score_2_total',
	'feedback_score_3_total',
	'feedback_score_4_total',
	'feedback_score_5_total',
];

foreach ( $score_total as $item ) {
	if ( empty($this->log_chart()[ $item ] ) ) {
		continue;
	}

	$count += $this->log_chart()[ $item ];
}

?>

<div class="statistics-summary">
    <div class="summary-icon">
        <img src="<?php echo TOTO_ASSETS . '/images/statistics/submissions.png' ?>" alt="<?php _e('Feedback Submissions', 'toto'); ?>">
    </div>
    <div class="summary-info">
        <div class="summary-number"><?php echo $count; ?></div>
        <div class="summary-title"><?php _e('Feedback Submissions', 'toto'); ?></div>
    </div>
</div>