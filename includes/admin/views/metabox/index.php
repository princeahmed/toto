<?php

global $post_id;
$current_type = get_post_meta($post_id, '_notification_type', true);

include TOTO_INCLUDES.'/admin/views/metabox/preview.php';
include TOTO_INCLUDES.'/admin/views/metabox/menu.php';
include TOTO_INCLUDES.'/admin/views/metabox/tabs.php';