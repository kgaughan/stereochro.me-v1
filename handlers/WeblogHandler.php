<?php
class WeblogHandler extends AFK_HandlerBase {

	public function on_get_latest(AFK_Context $ctx) {
		global $db;
		$ctx->defaults(array('as' => 'html'));

		$ctx->entries = WeblogData::get_latest_entries();
	}

	public function on_post_latest(AFK_Context $ctx) {
		AFK_Users::prerequisites('edit');

		$n = WeblogData::new_entry(
			$ctx->link, $ctx->title, $ctx->via, $ctx->note,
			AFK_Users::current()->get_id());
		if (is_null($id)) {
			add_notification('error', "That link already appears to exist!");
		}

		$ctx->allow_rendering(false);
		$ctx->redirect();
	}

	public function on_put_entry(AFK_Context $ctx) {
		AFK_Users::prerequisites('edit');
		if (isset($ctx->preview)) {
			$ctx->change_view('preview');
		} else {
			WeblogData::update_entry(
				$ctx->id, $ctx->link, $ctx->title, $ctx->via, $ctx->note,
				AFK_Users::current()->get_id());
			$ctx->allow_rendering(false);
			$ctx->redirect();
		}
	}

	public function on_get_add(AFK_Context $ctx) {
		AFK_Users::prerequisites('edit');
		$ctx->default_to_empty('link', 'title', 'via', 'note');
	}

	public function on_get_entry(AFK_Context $ctx) {
		$ctx->merge_or_not_found(WeblogData::get_entry($ctx->id));
	}

	public function on_get_edit(AFK_Context $ctx) {
		AFK_Users::prerequisites('edit');
		$ctx->merge_or_not_found(WeblogData::get_entry($ctx->id));
	}

	public function on_get_month(AFK_Context $ctx) {
		$entries = WeblogData::get_entries_for_month($ctx->year, $ctx->month);
		if (count($entries) == 0) {
			$ctx->not_found();
		}
		$ctx->ts = mktime(0, 0, 0, $ctx->month, 1, $ctx->year);
		$ctx->entries = $entries;
	}
}
