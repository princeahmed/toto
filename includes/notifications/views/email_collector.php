<?php defined( 'ABSPATH' ) || die() ?>

<div class="trust-plus-wrapper trust-plus-email-collector-wrapper trust-plus-wrapper-<?php echo $notification->border_radius ?>" style="background: <?php echo $notification->background_color ?>">
    <div class="trust-plus-email-collector-content">
        <p class="trust-plus-email-collector-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>
        <p class="trust-plus-email-collector-description" style="color: <?php echo $notification->description_color ?>"><?php echo $notification->description ?></p>


        <form id="trust-plus-email-collector-form" class="trust-plus-email-collector-form" name="" action="" method="GET" role="form">
            <div class="trust-plus-email-collector-row">
                <input type="email" class="trust-plus-email-collector-email-placeholder" name="email" placeholder="<?php echo $notification->email_placeholder ?>" required="required"/>

                <button type="submit" class="trust-plus-email-collector-button" name="button" style="color: <?php echo $notification->button_color ?>; background: <?php echo $notification->button_background_color ?>"><?php echo $notification->button_text ?></button>
            </div>


            <?php trust_plus_agreement($notification); ?>
        </form>

		<?php trust_plus_branding( $notification ); ?>
    </div>

	<?php trust_plus_close( $notification ); ?>
</div>
