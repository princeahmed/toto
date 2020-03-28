<div class="form-group">
	<label for="settings_display_duration"><?= $this->language->notification->settings->display_duration ?></label>
	<input type="number" min="-1" id="settings_display_duration" name="display_duration" class="form-control" value="<?= $data->notification->settings->display_duration ?>" required="required" />
	<small class="text-muted"><?= $this->language->notification->settings->display_duration_help ?></small>
</div>

<div class="form-group">
	<label for="settings_display_position"><?= $this->language->notification->settings->display_position ?></label>
	<select class="custom-select" name="display_position">
		<option value="top_left" <?= $data->notification->settings->display_position == 'top_left' ? 'selected="selected"' : null ?>><?= $this->language->notification->settings->display_position_top_left ?></option>
		<option value="top_center" <?= $data->notification->settings->display_position == 'top_center' ? 'selected="selected"' : null ?>><?= $this->language->notification->settings->display_position_top_center ?></option>
		<option value="top_right" <?= $data->notification->settings->display_position == 'top_right' ? 'selected="selected"' : null ?>><?= $this->language->notification->settings->display_position_top_right ?></option>
		<option value="middle_left" <?= $data->notification->settings->display_position == 'middle_left' ? 'selected="selected"' : null ?>><?= $this->language->notification->settings->display_position_middle_left ?></option>
		<option value="middle_center" <?= $data->notification->settings->display_position == 'middle_center' ? 'selected="selected"' : null ?>><?= $this->language->notification->settings->display_position_middle_center ?></option>
		<option value="middle_right" <?= $data->notification->settings->display_position == 'middle_right' ? 'selected="selected"' : null ?>><?= $this->language->notification->settings->display_position_middle_right ?></option>
		<option value="bottom_left" <?= $data->notification->settings->display_position == 'bottom_left' ? 'selected="selected"' : null ?>><?= $this->language->notification->settings->display_position_bottom_left ?></option>
		<option value="bottom_center" <?= $data->notification->settings->display_position == 'bottom_center' ? 'selected="selected"' : null ?>><?= $this->language->notification->settings->display_position_bottom_center ?></option>
		<option value="bottom_right" <?= $data->notification->settings->display_position == 'bottom_right' ? 'selected="selected"' : null ?>><?= $this->language->notification->settings->display_position_bottom_right ?></option>
	</select>
	<small class="text-muted"><?= $this->language->notification->settings->display_position_help ?></small>
</div>

<div class="custom-control custom-switch mr-3 mb-3">
	<input
		type="checkbox"
		class="custom-control-input"
		id="display_close_button"
		name="display_close_button"
		<?= $data->notification->settings->display_close_button ? 'checked="true"' : null ?>
	>
	<label class="custom-control-label clickable" for="display_close_button"><?= $this->language->notification->settings->display_close_button ?></label>
</div>

<div class="custom-control custom-switch mr-3 mb-3 <?= !$this->user->package_settings->removable_branding ? 'container-disabled': null ?>">
	<input
		type="checkbox"
		class="custom-control-input"
		id="display_branding"
		name="display_branding"
		<?= $data->notification->settings->display_branding ? 'checked="true"' : null ?>
	>
	<label class="custom-control-label clickable" for="display_branding"><?= $this->language->notification->settings->display_branding ?></label>
</div>