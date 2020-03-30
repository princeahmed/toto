<?php

defined( 'ABSPATH' ) || die();


?>


<?php ob_start() ?>
<div class="toto-wrapper toto-wrapper-<?php echo $notification->border_radius ?> toto-informational-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="toto-informational-content">
		<?php if ( ! empty( $notification->image ) ): ?>
            <img src="<?php echo $notification->image ?>" class="toto-informational-image"/>
		<?php endif ?>

        <div>
            <p class="toto-informational-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>
            <p class="toto-informational-description" style="color: <?php echo $notification->description_color ?>"><?php echo $notification->description ?></p>


			<?php if ( $notification->display_branding ): ?><?php if ( isset( $notification->branding, $notification->branding->name, $notification->branding->url ) && ! empty( $notification->branding->name ) && ! empty( $notification->branding->url ) ): ?>
                <a href="<?php echo $notification->branding->url ?>" class="toto-site"><?php echo $notification->branding->name ?></a>
			<?php else: ?>
                <a href="" class="toto-site">\Altum\Language::get()->notification->branding</a>
			<?php endif ?><?php endif ?>
        </div>
    </div>

    <span class="toto-close"></span>
</div>
<?php $html = ob_get_clean() ?>


<?php ob_start() ?>
new AltumCodeManager({content: <?php echo json_encode( $html ) ?>,display_mobile: <?php echo json_encode( $notification->display_mobile ) ?>,display_trigger: <?php echo json_encode( $notification->display_trigger ) ?>,display_trigger_value: <?php echo json_encode( $notification->display_trigger_value ) ?>,duration: <?php echo $notification->display_duration === - 1 ? - 1 : $notification->display_duration * 1000 ?>,url: <?php echo json_encode( $notification->url ) ?>,close: <?php echo json_encode( $notification->display_close_button ) ?>,once_per_session: <?php echo json_encode( $notification->display_once_per_session ) ?>,position: <?php echo json_encode( $notification->display_position ) ?>,stop_on_focus: true,trigger_all_pages: <?php echo json_encode( $notification->trigger_all_pages ) ?>,triggers: <?php echo json_encode( $notification->triggers ) ?>,

notification_id: <?php echo $notification->notification_id ?>
}).initiate();
<?php $javascript = ob_get_clean(); ?>

<?php return (object) [ 'html' => $html, 'javascript' => $javascript ] ?>
