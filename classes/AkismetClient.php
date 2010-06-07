<?php
class AkismetClient {

	private $shared;
	private $environment;
	private $port;
	private $timeout;

	public function __construct($key, $blog, array $environment, $port=80, $timeout=5) {
		$this->shared = compact('key', 'blog');
		$this->environment = $environment;
		$this->port = $port;
		$this->timeout = $timeout;
	}

	public function verify_key() {
		return $this->send('verify-key', array()) != 'invalid';
	}

	public function comment_check($permalink, $comment_type, $comment_author, $comment_author_email, $comment_author_url, $comment_content) {
		return $this->send('comment-check', compact(
			'comment_author', 'comment_author_email', 'comment_author_url',
			'comment_type', 'comment_content', 'permalink')) == 'true';
	}

	public function submit_spam($permalink, $comment_type, $comment_author, $comment_author_email, $comment_author_url, $comment_content) {
		$this->send('submit-spam', compact(
			'comment_author', 'comment_author_email', 'comment_author_url',
			'comment_type', 'comment_content', 'permalink'));
	}

	public function submit_ham($permalink, $comment_type, $comment_author, $comment_author_email, $comment_author_url, $comment_content) {
		$this->send('submit-ham', compact(
			'comment_author', 'comment_author_email', 'comment_author_url',
			'comment_type', 'comment_content', 'permalink'));
	}

	private function send($command, array $args) {
		list($host, $path) = $this->make_uri($command);

		if ($command == 'verify-key') {
			$args = $this->shared;
		} else {
			$args =
				array(
					'user_ip' => $this->environment['REMOTE_ADDR'],
					'referrer' => $this->get('HTTP_REFERER'),
					'user_agent' => $this->get('HTTP_USER_AGENT')) +
				$args + $this->environment + $this->shared;
		}

		list($status, , $body) = $this->do_post($host, $path, $args);

		if ($status < 200 || $status >= 300) {
			throw new AkismetException(
				sprintf("Unexpected HTTP response %d: [%s]", $status, $body));
		}

		return $body;
	}

	private function make_uri($command) {
		static $valid_commands = array('verify-key', 'comment-check', 'submit-spam', 'submit-ham');
		if (!in_array($command, $valid_commands, true)) {
			throw new AkismetException(sprintf("Unknown command '%s'", $command));
		}

		$host = 'rest.akismet.com';
		if ($command != 'verify-key') {
			$host = "{$this->key}.$host";
		}
		return array($host, "/1.1/$command");
	}

	private function get($k) {
		return array_key_exists($k, $this->environment) ? $this->environment[$k] : '';
	}

	private function do_post($host, $path, array $request) {
		$fp = @fsockopen($host, $this->port, $errno, $errstr, $this->timeout);
		if (!$fp) {
			throw new AkismetException(
				sprintf("Cannot connect to '%s': %s", $host, $errstr));
		}

		stream_set_timeout($fp, $this->timeout);

		$body = http_build_query($request);

		$this->write_headers($fp, "POST $path HTTP/1.0", array(
			'Host' => $host,
			'Date' => gmdate('r'),
			'Connection' => 'close',
			'Content-Length' => strlen($body),
			'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',
			'User-Agent' => 'TalideonAkismetClient/0.1'));

		fwrite($fp, $body);

		$response = '';
		while (!feof($fp)) {
			$block = @fread($fp, 2048);
			if ($block === false) {
				@fclose($fp);
				throw new AkismetException('Response broken');
			}
			$response .= $block;
		}
		@fclose($fp);

		list($header_lines, $body) = explode("\r\n\r\n", $response, 2);
		$header_lines = explode("\r\n", $header_lines);
		list(, $status, $reason) = explode(' ', array_shift($header_lines), 3);
		$headers = array();
		foreach ($header_lines as $line) {
			list($k, $v) = explode(':', $line, 2);
			$headers[strtolower($k)] = trim($v);
		}

		return array($status, $headers, $body);
	}

	private function write_headers($fp, $request_line, array $headers) {
		fwrite($fp, "$request_line\r\n");
		foreach ($headers as $k => $v) {
			fwrite($fp, "$k: $v\r\n");
		}
		fwrite($fp, "\r\n");
	}
}

class AkismetException extends Exception { }
