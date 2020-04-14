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
                    <input type="text" class="" name="input" placeholder="<?php echo $notification->input_placeholder ?>" />

                    <button type="submit" name="button" style="color: <?php echo $notification->button_color ?>; background: <?php echo $notification->button_background_color ?>"><?php echo $notification->button_text ?></button>
                </div>

                <?php if($notification->show_agreement): ?>
                    <div class="toto-agreement-checkbox">
                        <input type="checkbox" id="agreement" name="agreement" required="required" />
                        <label for="agreement" class="toto-agreement-checkbox-text" style="color: <?php echo $notification->description_color ?>">
                            <a href="<?php echo $notification->agreement_url ?>">
                                <?php echo $notification->agreement_text ?>
                            </a>
                        </label>
                    </div>
                <?php endif ?>
            </form>

            <?php
            toto_branding($notification);
            ?>
        </div>
    </div>

    <span class="toto-close"></span>
</div>
