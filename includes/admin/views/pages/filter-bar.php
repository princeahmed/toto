<form action="" method="POST" class="toto-mt-20 toto-filter-bar">
	<div class="toto-input-group">
		<div class="toto-form-group toto-mr-20">
			<label for="notification_id">Select Notification</label>
			<select name="notification_id" id="notification_id">
				<option value="">Select Notification</option>
			</select>
		</div>

		<div class="toto-form-group toto-mr-20">
			<label for="start_date">Start Date</label>
			<input type="text" id="start_date" name="start_date" value="<?php echo date( 'Y-m-d', strtotime( 'yesterday' ) ); ?>">
		</div>

		<div class="toto-form-group toto-mr-20">
			<label for="end_date">End Date</label>
			<input type="text" id="end_date" name="end_date" value="<?php echo date( 'Y-m-d', strtotime( 'today' ) ); ?>">
		</div>

		<div class="toto-form-group">
			<button class="toto-btn toto-btn-primary toto-mt-auto" type="submit" id="data-select">Submit</button>
		</div>

	</div>
</form>