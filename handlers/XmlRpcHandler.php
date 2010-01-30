<?php
class XmlRpcHandler extends AFK_XmlRpcHandler {

	protected function add_registrations() {
		parent::add_registrations();

		$this->register_each(array(
			'metaWeblog.getUsersBlogs',
			'metaWeblog.getPost',
			'metaWeblog.newPost',
			'metaWeblog.editPost',
			'metaWeblog.deletePost',
			'metaWeblog.getCategories',
			'metaWeblog.getRecentPosts',
			'metaWeblog.newMediaObject'));
	}

	protected function on_introspection($method) {
		switch ($method) {
		case 'metaWeblog.getUsersBlogs':
			return array(
				'signatures' => array('array, string, string, string'),
				'callback' => 'call_mw_get_users_blogs',
				'help' => 'Get the weblogs associated with a given user.');

		case 'metaWeblog.getPost':
			return array(
				'signatures' => array('struct, string, string, string'),
				'callback' => 'call_mw_get_post',
				'help' => 'Gets a post.');

		case 'metaWeblog.newPost':
			return array(
				'signatures' => array('string, string, string, struct, boolean'),
				'callback' => 'on_me_new_post',
				'help' => 'Creates a new post, returning its ID.');

		case 'metaWeblog.editPost':
			return array(
				'signatures' => array('boolean, string, string, struct, boolean'),
				'callback' => 'call_mw_edit_post',
				'help' => 'Updates a post.');

		case 'metaWeblog.deletePost':
			return array(
				'signatures' => array('boolean, string, string, string, string, boolean'),
				'callback' => 'call_mw_delete_post',
				'help' => 'Deletes a given post.');

		case 'metaWeblog.getCategories':
			return array(
				'signatures' => array('struct, string, string, string'),
				'callback' => 'call_mw_get_categories',
				'help' => 'Gets the categories associated with the given blog.');

		case 'metaWeblog.getRecentPosts':
			return array(
				'signatures' => array('array, string, string, string, int'),
				'callback' => 'call_mw_get_recent_posts',
				'help' => 'Returns the x most recent posts in an array.');

		case 'metaWeblog.newMediaObject':
			return array(
				'signatures' => array('struct, string, string, string, struct'),
				'callback' => 'call_mw_new_media_object',
				'help' => 'Uploads a given object.');
		}

		return parent::on_introspection($method);
	}

	private function to_rss_item(array $entry) {
		$item = array(
			'postid' => $entry['id'],
			'title' => $entry['title'],
			'link' => $entry['link'],
			'description' => $entry['note'],
			'pubDate' => AFK_XmlRpc_Parser::from_timestamp($entry['time_c']));
		if (!empty($entry['via'])) {
			$item['source'] = $entry['via'];
		}
		return $item;
	}

	public function call_mw_get_users_blogs($appkey, $username, $password) {
		$user_id = Users::check_credentials($username, $password);
		if ($user_id === false) {
			return new AFK_XmlRpc_Fault(0, "Bad credentials");
		}

		// We only have the one, after all.
		$ctx = AFK_Registry::context();
		return array(array(
			'blogid' => '1',
			'blogName' => WEBLOG_TITLE,
			'isAdmin' => '1',
			'url' => $ctx->to_absolute_uri('weblog/'),
			'xmlrpc' => $ctx->get_host_prefix() . $ctx->request_uri()));
	}

	public function call_mw_get_post($post_id, $username, $password) {
		$user_id = Users::check_credentials($username, $password);
		if ($user_id === false) {
			return new AFK_XmlRpc_Fault(0, "Bad credentials");
		}
		$entry = WeblogData::get_entry($post_id);
		if (is_null($entry)) {
			return new AFK_XmlRpc_Fault(0, "No such entry");
		}
		return $this->to_rss_item($entry);
	}

	public function call_mw_new_post($username, $password, array $item, $publish) {
		$user_id = Users::check_credentials($username, $password);
		if ($user_id === false) {
			return new AFK_XmlRpc_Fault(0, "Bad credentials");
		}
	}

	public function call_mw_edit_post($post_id, $username, $password, array $item, $publish) {
		$user_id = Users::check_credentials($username, $password);
		if ($user_id === false) {
			return new AFK_XmlRpc_Fault(0, "Bad credentials");
		}
	}

	public function call_mw_delete_post($appkey, $post_id, $username, $password, $publish) {
		$user_id = Users::check_credentials($username, $password);
		if ($user_id === false) {
			return new AFK_XmlRpc_Fault(0, "Bad credentials");
		}
		return new AFK_XmlRpc_Fault(0, "Not currently supported");
	}

	public function call_mw_get_categories($blog_id, $username, $password) {
		$user_id = Users::check_credentials($username, $password);
		if ($user_id === false) {
			return new AFK_XmlRpc_Fault(0, "Bad credentials");
		}
		return array();
	}

	public function call_mw_get_recent_posts($blog_id, $username, $password, $n_posts) {
		$user_id = Users::check_credentials($username, $password);
		if ($user_id === false) {
			return new AFK_XmlRpc_Fault(0, "Bad credentials");
		}
		$posts = array();
		foreach (WeblogData::get_latest_entries($n_posts) as $e) {
			$posts[] = $this->to_rss_item($e);
		}
		return $posts;
	}

	public function call_mw_new_media_object($blog_id, $username, $password, array $item) {
		$user_id = Users::check_credentials($username, $password);
		if ($user_id === false) {
			return new AFK_XmlRpc_Fault(0, "Bad credentials");
		}
		return new AFK_XmlRpc_Fault(0, "Not currently supported");
	}
}
