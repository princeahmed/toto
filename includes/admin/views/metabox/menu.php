<?php

defined( 'ABSPATH' ) || exit;

global $post;

$tabs = [
	'content'   => [
		'icon'  => 'fa-edit',
		'title' => 'Content',
	],
	'display'   => [
		'icon'  => 'fa-desktop',
		'title' => 'Display',
	],
	'customize' => [
		'icon'  => 'fa-tools',
		'title' => 'Customize',
	],
	'sound'     => [
		'icon'  => 'fa-bell',
		'title' => 'Sound',
	],
];

?>

<ul class="trust-plus-meta-tabs">

    <li class="trust-plus-tab-item">
        <a class="trust-plus-tab-link active" data-target="notification_type"> <i class="fa fa-network-wired"></i> <?php _e('Type', 'social-proof-fomo-notification') ?> </a>
    </li>

	<?php foreach ( $tabs as $key => $tab ) { ?>
        <li class="trust-plus-tab-item">
            <a href="#" class="trust-plus-tab-link" data-target="<?php echo $key; ?>">
                <i class="fa <?php echo $tab['icon']; ?>"></i>
				<?php echo $tab['title']; ?>
            </a>
        </li>
	<?php } ?>


</ul>