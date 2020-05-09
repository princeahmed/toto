<?php
$count = 0;

$emoji_total = [
	'feedback_emoji_angry_total',
	'feedback_emoji_sad_total',
	'feedback_emoji_neutral_total',
	'feedback_emoji_happy_total',
	'feedback_emoji_excited_total',
];

foreach ( $emoji_total as $item ) {
	if ( empty($this->log_chart()[ $item ] ) ) {
		continue;
	}

	$count += $this->log_chart()[ $item ];
}

?>

<div class="statistics-summary">
    <div class="summary-icon">
        <img src="<?php echo TOTO_ASSETS . '/images/statistics/submissions.png' ?>" alt="Emoji Feedbacks">
    </div>
    <div class="summary-info">
        <div class="summary-number"><?php echo $count; ?></div>
        <div class="summary-title">Emoji Feedbacks</div>
    </div>
</div>