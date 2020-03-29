<?php


$enabled_tabs = Toto_Notifications::get_enabled_settings_tabs( $current_type );

$tabs_config = [
	'content'   => [
		'icon'  => 'fa-edit',
		'title' => 'Content',
	],
	'triggers'  => [
		'icon'  => 'fa-bell',
		'title' => 'Triggers',
	],
	'display'   => [
		'icon'  => 'fa-desktop',
		'title' => 'Display',
	],
	'customize' => [
		'icon'  => 'fa-tools',
		'title' => 'Customize',
	],
	'data'      => [
		'icon'  => 'fa-database',
		'title' => 'Data',
	],
];

?>

<ul class="toto-meta-tabs">

    <li class="toto-tab-item">
        <a class="toto-tab-link active" data-target="notification_type">
            <i class="fa fa-network-wired"></i> Type
        </a>
    </li>

	<?php foreach ( $enabled_tabs as $tab ) { ?>
        <li class="toto-tab-item">
            <a href="#" class="toto-tab-link" data-target="<?php echo $tab; ?>">
                <i class="fa <?php echo $tabs_config[ $tab ]['icon']; ?>"></i>
				<?php echo $tabs_config[ $tab ]['title']; ?>
            </a>
        </li>
	<?php } ?>


</ul>