<?php defined('ABSPATH') || die() ?>

<div class="trust-plus-wrapper trust-plus-wrapper-<?php echo $notification->border_radius ?> trust-plus-random-review-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="trust-plus-random-review-content">

        <img src="<?php echo $notification->image ?>" class="trust-plus-random-review-image <?php echo ! empty( $notification->image ) ? '': 'hidden'; ?>" />

        <div>
            <div class="trust-plus-random-review-header">
                <p class="trust-plus-random-review-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>

                <div class="trust-plus-random-review-stars">
                    <?php for($i = 1; $i <= $notification->stars; $i++): ?>
                    <div class="trust-plus-toast-star">★</div>
                    <?php endfor ?>
                </div>

            </div>
            <p class="trust-plus-random-review-description" style="color: <?php echo $notification->description_color ?>">"<?php echo $notification->description ?>"</p>

            <?php trust_plus_branding($notification); ?>

        </div>
    </div>

    <?php trust_plus_close($notification); ?>
</div>
