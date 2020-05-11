<?php defined('ABSPATH') || die() ?>

<div class="toto-wrapper toto-wrapper-<?php echo $notification->border_radius ?> toto-random-review-wrapper" style="background: <?php echo $notification->background_color ?>">
    <div class="toto-random-review-content">

        <img src="<?php echo $notification->image ?>" class="toto-random-review-image <?php echo ! empty( $notification->image ) ? '': 'hidden'; ?>" />

        <div>
            <div class="toto-random-review-header">
                <p class="toto-random-review-title" style="color: <?php echo $notification->title_color ?>"><?php echo $notification->title ?></p>

                <div class="toto-random-review-stars">
                    <?php for($i = 1; $i <= $notification->stars; $i++): ?>
                    <div class="toto-toast-star">★</div>
                    <?php endfor ?>
                </div>

            </div>
            <p class="toto-random-review-description" style="color: <?php echo $notification->description_color ?>">"<?php echo $notification->description ?>"</p>

            <?php toto_branding($notification); ?>

        </div>
    </div>

    <?php toto_close($notification); ?>
</div>
