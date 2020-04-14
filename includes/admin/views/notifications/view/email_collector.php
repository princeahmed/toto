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


            <div class="toto-agreement-checkbox" <?php echo 'yes' != $notification->show_agreement ? 'style="display:none"' : ''; ?>>
                <input type="checkbox" id="toto-agreement" name="agreement" required="required"/>
                <label for="agreement" class="toto-agreement-checkbox-text" style="color: <?php echo $notification->description_color ?>">
                    <a href="<?php echo $notification->agreement_url ?>">
						<?php echo $notification->agreement_text ?>
                    </a> </label>
            </div>
        </form>

		<?php if ( $notification->display_branding ): ?><?php if ( isset( $notification->branding, $notification->branding->name, $notification->branding->url ) && ! empty( $notification->branding->name ) && ! empty( $notification->branding->url ) ): ?>
            <a href="<?php echo $notification->branding->url ?>" class="toto-site"><?php echo $notification->branding->name ?></a>
		<?php else: ?><?php endif ?><?php endif ?>
    </div>

    <span class="toto-close"></span>
</div>
