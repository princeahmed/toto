<form action="" method="GET" class="toto-mt-20 toto-filter-bar">
    <input type="hidden" name="post_type" value="toto_notification">
    <input type="hidden" name="page" value="<?php echo $toto_current_page; ?>">
    <div class="toto-input-group">
        <div class="toto-form-group toto-mr-20">
            <label for="notification_id">Select Notification</label>
            <select name="notification_id" id="notification_id">
                <option value="">Select Notification</option>
            </select>
        </div>

        <div class="toto-form-group toto-mr-20">
            <label for="start_date">Start Date</label>
            <input type="text" id="start_date" class="toto_date_field" name="start_date" value="<?php echo date( 'Y-m-d', strtotime( 'yesterday' ) ); ?>">
        </div>

        <div class="toto-form-group toto-mr-20">
            <label for="end_date">End Date</label>
            <input type="text" id="end_date" class="toto_date_field" name="end_date" value="<?php echo date( 'Y-m-d', strtotime( 'today' ) ); ?>">
        </div>

        <div class="toto-form-group">
            <button class="toto-btn toto-btn-primary toto-mt-auto" type="submit" id="data-select">Submit</button>
        </div>

		<?php if ( isset( $per_page_field ) ) { ?>
            <div class="toto-form-group toto-ml-auto toto-mt-auto flex-row align-center">
                <label for="per_page" class="toto-mr-10">Items Per Page</label> <select name="per_page" id="per_page">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
		<?php } ?>
    </div>
</form>