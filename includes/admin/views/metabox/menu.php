<?php
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

<ul class="toto-meta-tabs">

    <li class="toto-tab-item">
        <a class="toto-tab-link active" data-target="notification_type"> <i class="fa fa-network-wired"></i> Type </a>
    </li>

	<?php foreach ( $tabs as $key => $tab ) { ?>
        <li class="toto-tab-item">
            <a href="#" class="toto-tab-link" data-target="<?php echo $key; ?>">
                <i class="fa <?php echo $tab['icon']; ?>"></i>
				<?php echo $tab['title']; ?>
            </a>
        </li>
	<?php } ?>


</ul>