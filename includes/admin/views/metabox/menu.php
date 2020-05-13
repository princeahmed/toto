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

<ul class="notification-plus-meta-tabs">

    <li class="notification-plus-tab-item">
        <a class="notification-plus-tab-link active" data-target="notification_type"> <i class="fa fa-network-wired"></i> <?php _e('Type', 'notification-plus') ?> </a>
    </li>

	<?php foreach ( $tabs as $key => $tab ) { ?>
        <li class="notification-plus-tab-item">
            <a href="#" class="notification-plus-tab-link" data-target="<?php echo $key; ?>">
                <i class="fa <?php echo $tab['icon']; ?>"></i>
				<?php echo $tab['title']; ?>
            </a>
        </li>
	<?php } ?>


</ul>