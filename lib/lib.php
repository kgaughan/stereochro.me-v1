<?php
function get_entry_type($link, $title, $via, $note) {
	return 'default';
}

function format($text) {
	return SmartyPants(Markdown($text));
}

function format_line($text) {
	return SmartyPants(e($text));
}
