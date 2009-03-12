<?php
class WeblogHandler extends AFK_HandlerBase {

	public function on_get_latest(AFK_Context $ctx) {
	}

	public function on_get_feed(AFK_Context $ctx) {
		global $cache;
		$ctx->allow_rendering(false);

		$ctx->header('Content-Type: application/atom+xml; charset=UTF-8');
		$entries = WeblogData::get_latest_feed_entries();
		$modified = max(collect_column($entries, 'time_m'));
		if (!$ctx->try_not_modified($modified)) {
			$root = new AFK_ElementNode('feed', 'http://www.w3.org/2005/Atom');
			$root->title('Inklings');
			$root->subtitle('A stream of random things');
			$root->updated(date('c', $modified));
			$root->author()->name('Keith Gaughan');
			$root->id('tag:talideon.com,2001:weblog');
			$root->rights('Copyright (c) Keith Gaughan, 2001-' . date('Y'));

			$link = $root->link();
			$link->rel = 'alternate';
			$link->type = 'text/html';
			$link->hreflang = 'en';
			$link->href = $ctx->application_root() . 'weblog/';

			$link = $root->link();
			$link->rel = 'self';
			$link->type = 'application/atom+xml';
			$link->href = $ctx->application_root() . 'weblog/;feed';

			foreach ($entries as $e) {
				$entry = $root->entry();
				$entry->title(empty($e['title']) ? 'Untitled' : $e['title']);
				$entry->published(date('c', $e['time_c']));
				$entry->updated(date('c', $e['time_m']));
				$entry->id('tag:talideon.com,2001:weblog:' . $e['id']);

				$entry_link = $ctx->application_root() . 'weblog/' . $e['id'];

				$link = $entry->link();
				$link->rel = 'alternate';
				$link->type = 'text/html';
				$link->href = $entry_link;

				$link = $entry->link();
				$link->rel = 'related';
				$link->type = 'text/html';
				$link->href = empty($e['link']) ? $entry_link : $e['link'];

				if (!empty($e['via'])) {
					$link = $entry->link();
					$link->rel = 'via';
					$link->type = 'text/html';
					$link->href = $e['via'];
				}

				if (trim($e['note']) != '') {
					$content = $entry->content(trim(format($e['note'])));
					$content->type = 'html';
					$content->attr('xml:lang', 'en')->attr('xml:base', $entry_link);
				}
			}

			echo $root->as_xml();
		}
	}

	public function on_post_latest(AFK_Context $ctx) {
		AFK_Users::prerequisites('edit');

		$id = WeblogData::new_entry(
			$ctx->link, $ctx->title, $ctx->via, $ctx->note,
			AFK_Users::current()->get_id());
		if (is_null($id)) {
			add_notification('error', "That link already appears to exist!");
		} else {
			cache_remove('weblog:latest');
			cache_remove('weblog:summary');
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
			cache_remove('weblog:latest');
			cache_remove('weblog:' . $ctx->id);
			$ctx->allow_rendering(false);
			$ctx->redirect();
		}
	}

	public function on_get_add(AFK_Context $ctx) {
		AFK_Users::prerequisites('edit');
		$ctx->default_to_empty('link', 'title', 'via', 'note');
	}

	public function on_get_entry(AFK_Context $ctx) {
		$entry = WeblogData::get_entry($ctx->id);
		if (is_null($entry) || !$ctx->try_not_modified($entry['time_m'])) {
			$ctx->merge_or_not_found($entry);
		}
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
