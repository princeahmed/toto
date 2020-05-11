<?php defined('ABSPATH') || die() ?>

<div class="toto-wrapper toto-wrapper-<?php echo $notification->border_radius ?> toto-request-collector-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="toto-request-collector-content">
        <div class="toto-request-collector-header">
            <img src="<?php echo $notification->image ?>" class="toto-request-collector-image" />

            <div>
                <p class="toto-request-collector-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>
                <p class="toto-request-collector-description" style="color: <?php echo $notification->description_color ?>"><?php echo $notification->description ?></p>
            </div>
        </div>

        <p class="toto-request-collector-content-title" style="color: <?php echo $notification->content_title_color ?>"><?php echo $notification->content_title ?></p>
        <p class="toto-request-collector-content-description" style="color: <?php echo $notification->content_description_color ?>"><?php echo $notification->content_description ?></p>

        <div>
            <form class="toto-request-collector-form" id="toto-request-collector-form" name="" action="" method="GET" role="form">
                <div class="toto-request-collector-row">
                    <input type="text" class="toto-request-collector-input-placeholder" name="input" placeholder="<?php echo $notification->input_placeholder ?>" />

                    <button type="submit" class="toto-request-collector-button" name="button" style="color: <?php echo $notification->button_color ?>; background: <?php echo $notification->button_background_color ?>"><?php echo $notification->button_text ?></button>
                </div>

                    <?php toto_agreement($notification); ?>

            </form>

            <?php toto_branding($notification); ?>
        </div>
    </div>

    <?php toto_close($notification); ?>
</div>
