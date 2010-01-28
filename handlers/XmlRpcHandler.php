<?php
class XmlRpcHandler extends AFK_XmlRpcHandler {

	protected function add_registrations() {
		static $method_map = array(
			'metaWeblog.getUsersBlogs' => 'on_mw_get_users_blogs',
			'metaWeblog.getPost' => 'on_mw_get_post',
			'metaWeblog.newPost' => 'on_mw_new_post',
			'metaWeblog.editPost' => 'on_mw_edit_post',
			'metaWeblog.deletePost' => 'on_mw_delete_post',
			'metaWeblog.getCategories' => 'on_mw_get_categories',
			'metaWeblog.getRecentPosts' => 'on_mw_get_recent_posts',
			'metaWeblog.newMediaObject' => 'on_mw_new_media_object');

		$introspection_cb = array($this, 'on_introspection');
		foreach ($method_map as $method => $local) {
			$this->register($method, array($this, $local), $introspection_cb);
		}
	}

	public function on_introspection($method) {
		switch ($method) {
		case 'metaWeblog.getUsersBlogs':
			return array(
				'signatures' => array('array, string, string, string'),
				'help' => 'Get the weblogs associated with a given user.');

		case 'metaWeblog.getPost':
			return array(
				'signatures' => array('struct, string, string, string'),
				'help' => 'Gets a post.');

		case 'metaWeblog.newPost':
			return array(
				'signatures' => array('string, string, string, struct, boolean'),
				'help' => 'Creates a new post, returning its ID.');

		case 'metaWeblog.editPost':
			return array(
				'signatures' => array('boolean, string, string, struct, boolean'),
				'help' => 'Updates a post.');

		case 'metaWeblog.deletePost':
			return array(
				'signatures' => array('boolean, string, string, string, string, boolean'),
				'help' => 'Deletes a given post.');

		case 'metaWeblog.getCategories':
			return array(
				'signatures' => array('struct, string, string, string'),
				'help' => 'Gets the categories associated with the given blog.');

		case 'metaWeblog.getRecentPosts':
			return array(
				'signatures' => array('array, string, string, string, int'),
				'help' => 'Returns the x most recent posts in an array.');

		case 'metaWeblog.newMediaObject':
			return array(
				'signatures' => array('struct, string, string, string, struct'),
				'help' => 'Uploads a given object.');
		}
		return null;
	}

	public function on_mw_get_users_blogs($blog_id, $username, $password) {
	}

	public function on_mw_get_post($post_id, $username, $password) {
	}

	public function on_mw_new_post($username, $password, array $item, $publish) {
	}

	public function on_mw_edit_post($post_id, $username, $password, array $item, $publish) {
	}

	public function on_mw_delete_post($appkey, $post_id, $username, $password, $publish) {
	}

	public function on_mw_get_categories($blog_id, $username, $password) {
	}

	public function on_mw_get_recent_posts($blog_id, $username, $password, $n_posts) {
	}

	public function on_mw_new_media_object() {
	}
}
