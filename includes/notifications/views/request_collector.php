<?php defined('ABSPATH') || die() ?>

<div class="trust-plus-wrapper trust-plus-wrapper-<?php echo $notification->border_radius ?> trust-plus-request-collector-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="trust-plus-request-collector-content">
        <div class="trust-plus-request-collector-header">
            <img src="<?php echo $notification->image ?>" class="trust-plus-request-collector-image" />

            <div>
                <p class="trust-plus-request-collector-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>
                <p class="trust-plus-request-collector-description" style="color: <?php echo $notification->description_color ?>"><?php echo $notification->description ?></p>
            </div>
        </div>

        <p class="trust-plus-request-collector-content-title" style="color: <?php echo $notification->content_title_color ?>"><?php echo $notification->content_title ?></p>
        <p class="trust-plus-request-collector-content-description" style="color: <?php echo $notification->content_description_color ?>"><?php echo $notification->content_description ?></p>

        <div>
            <form class="trust-plus-request-collector-form" id="trust-plus-request-collector-form" name="" action="" method="GET" role="form">
                <div class="trust-plus-request-collector-row">
                    <input type="text" class="trust-plus-request-collector-input-placeholder" name="input" placeholder="<?php echo $notification->input_placeholder ?>" />

                    <button type="submit" class="trust-plus-request-collector-button" name="button" style="color: <?php echo $notification->button_color ?>; background: <?php echo $notification->button_background_color ?>"><?php echo $notification->button_text ?></button>
                </div>

                    <?php trust_plus_agreement($notification); ?>

            </form>

            <?php trust_plus_branding($notification); ?>
        </div>
    </div>

    <?php trust_plus_close($notification); ?>
</div>
