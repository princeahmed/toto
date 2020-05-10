<?php defined( 'ABSPATH' ) || die() ?>

<div class="toto-wrapper toto-email-collector-wrapper toto-wrapper-<?php echo $notification->border_radius ?>" style="background: <?php echo $notification->background_color ?>">
    <div class="toto-email-collector-content">
        <p class="toto-email-collector-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>
        <p class="toto-email-collector-description" style="color: <?php echo $notification->description_color ?>"><?php echo $notification->description ?></p>


        <form id="toto-email-collector-form" class="toto-email-collector-form" name="" action="" method="GET" role="form">
            <div class="toto-email-collector-row">
                <input type="email" class="toto-email-collector-email-placeholder" name="email" placeholder="<?php echo $notification->email_placeholder ?>" required="required"/>

                <button type="submit" class="toto-email-collector-button" name="button" style="color: <?php echo $notification->button_color ?>; background: <?php echo $notification->button_background_color ?>"><?php echo $notification->button_text ?></button>
            </div>


            <div class="toto-agreement-checkbox <?php echo 'yes' != $notification->show_agreement ? 'hidden' : ''; ?>">
                <input type="checkbox" id="toto-agreement" name="agreement" required="required"/>
                <label for="toto-agreement" class="toto-agreement-checkbox-text" style="color: <?php echo $notification->description_color ?>">
                    <a href="<?php echo $notification->agreement_url ?>">
						<?php echo $notification->agreement_text ?>
                    </a> </label>
            </div>
        </form>

		<?php toto_branding($notification); ?>
    </div>

    <span class="toto-close"><?php echo $notification->display_close_button ? '&#10006;' : ''; ?></span>
</div>
