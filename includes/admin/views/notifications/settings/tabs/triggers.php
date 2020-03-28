<div class="d-flex justify-content-between">
    <div class="custom-control custom-switch mr-3 mb-3">
        <input
                type="checkbox"
                class="custom-control-input"
                id="trigger_all_pages"
                name="trigger_all_pages"
			<?= $data->notification->settings->trigger_all_pages ? 'checked="true"' : null ?>
        >
        <label class="custom-control-label clickable" for="trigger_all_pages"><?= $this->language->notification->settings->trigger_all_pages ?></label>

        <div>
            <small class="text-muted"><?= $this->language->notification->settings->trigger_all_pages_help ?></small>
        </div>
    </div>

    <div>
        <button type="button" id="trigger_add" class="btn btn-success btn-sm rounded-pill"><i class="fas fa-plus-circle"></i> <?= $this->language->notification->settings->trigger_add ?></button>
    </div>
</div>

<div id="triggers" class="container-disabled">
	<?php if(count($data->notification->settings->triggers)): ?>
		<?php foreach($data->notification->settings->triggers as $trigger): ?>
            <div class="input-group input-group-sm mb-3">
                <select class="custom-select trigger-type-select" name="trigger_type[]">
                    <option value="exact" <?= $trigger->type == 'exact' ? 'selected="selected"' : null ?>><?= $this->language->notification->settings->trigger_type_exact ?></option>
                    <option value="contains" <?= $trigger->type == 'contains' ? 'selected="selected"' : null ?>><?= $this->language->notification->settings->trigger_type_contains ?></option>
                    <option value="starts_with" <?= $trigger->type == 'starts_with' ? 'selected="selected"' : null ?>><?= $this->language->notification->settings->trigger_type_starts_with ?></option>
                    <option value="ends_with" <?= $trigger->type == 'ends_with' ? 'selected="selected"' : null ?>><?= $this->language->notification->settings->trigger_type_ends_with ?></option>
                    <option value="page_contains" <?= $trigger->type == 'page_contains' ? 'selected="selected"' : null ?>><?= $this->language->notification->settings->trigger_type_page_contains ?></option>
                </select>

                <input type="text" name="trigger_value[]" class="form-control" value="<?= $trigger->value ?>" placeholder="<?= $this->language->notification->settings->trigger_input_exact ?>" aria-label="<?= $this->language->notification->settings->trigger_input_exact ?>">

                <button type="button" class="trigger-delete ml-3 btn btn-danger btn-sm" aria-label="<?= $this->language->global->delete ?>"><i class="fa fa-times"></i></button>
            </div>
		<?php endforeach ?>
	<?php endif ?>
</div>

<div class="form-group" id="display_trigger">
    <label><?= $this->language->notification->settings->display_trigger ?></label>

    <div class="input-group input-group-sm">
        <select class="custom-select trigger-type-select" name="display_trigger">
            <option value="delay" data-placeholder="<?= $this->language->notification->settings->display_trigger_delay_placeholder ?>" <?= $data->notification->settings->display_trigger == 'delay' ? 'selected="selected"' : null ?>><?= $this->language->notification->settings->display_trigger_delay ?></option>
            <option value="exit_intent" <?= $data->notification->settings->display_trigger == 'exit_intent' ? 'selected="selected"' : null ?>><?= $this->language->notification->settings->display_trigger_exit_intent ?></option>
            <option value="scroll" data-placeholder="<?= $this->language->notification->settings->display_trigger_scroll_placeholder ?>" <?= $data->notification->settings->display_trigger == 'scroll' ? 'selected="selected"' : null ?>><?= $this->language->notification->settings->display_trigger_scroll ?></option>
        </select>

        <input type="number" min="0" name="display_trigger_value" class="form-control" value="<?= $data->notification->settings->display_trigger_value ?>" />
    </div>

    <small class="text-muted"><?= $this->language->notification->settings->display_trigger_help ?></small>
</div>

<div class="custom-control custom-switch mr-3 mb-3">
    <input
            type="checkbox"
            class="custom-control-input"
            id="display_once_per_session"
            name="display_once_per_session"
		<?= $data->notification->settings->display_once_per_session ? 'checked="true"' : null ?>
    >

    <label class="custom-control-label clickable" for="display_once_per_session"><?= $this->language->notification->settings->display_once_per_session ?></label>

    <div>
        <small class="text-muted"><?= $this->language->notification->settings->display_once_per_session_help ?></small>
    </div>
</div>

<div class="custom-control custom-switch mr-3 mb-3">
    <input
            type="checkbox"
            class="custom-control-input"
            id="display_mobile"
            name="display_mobile"
		<?= $data->notification->settings->display_mobile ? 'checked="true"' : null ?>
    >

    <label class="custom-control-label clickable" for="display_mobile"><?= $this->language->notification->settings->display_mobile ?></label>

    <div>
        <small class="text-muted"><?= $this->language->notification->settings->display_mobile_help ?></small>
    </div>
</div>