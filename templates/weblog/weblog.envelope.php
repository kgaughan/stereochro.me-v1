<?php
$this->with_envelope();

start_slot('section_navigation');
if (cache('weblog:summary')) {
	$archive_summary = WeblogData::get_archive_summary();
	$year = null;
	$last_month = 0;
	?><dl id="archive-summary"><?php
	foreach ($archive_summary as $r) {
		$ts = strtotime($r['ts']);
		$y = date('Y', $ts);
		$m = date('m', $ts);
		if ($y !== $year) {
			$year = $y;
			echo '<dt>', $year, ':</dt>';
		} else if ($m - 1 != $last_month) {
			for ($i = 1; $i < $m - $last_month; $i++) {
				echo '<dd>&mdash;</dd>';
			}
		}
		echo '<dd><a title="', date('F Y', $ts), '; entries: ', $r['n'], '" href="';
		le('weblog/' . date('Y-m', $ts));
		echo '">', date('M', $ts), '</a></dd>';
		$last_month = $m;
	}
	?></dl><?php
	cache_end();
}
end_slot();
?>
<?php start_slot('head') ?>
	<link title="Feed" rel="alternate" href="<?php le('weblog/;feed') ?>" type="application/atom+xml">
<?php end_slot_append() ?>
<?php start_slot('page_navigation') ?>
	<li><a href="<?php le('weblog/;add') ?>">Add</a></li>
<?php end_slot_append() ?>

<?php if (has_slot('title')) { ?>
	<h1><?php get_slot('title') ?></h1>
<?php } ?>

<?php echo $generated_content ?>

<?php start_slot('post_body') ?>
<script type="text/javascript">
//<![CDATA[
(function() {
	var links = document.getElementsByTagName('a');
	var query = '?';
	for (var i = 0; i < links.length; i++) {
		if (links[i].href.indexOf('#disqus_thread') >= 0) {
			query += 'url' + i + '=' + encodeURIComponent(links[i].href) + '&';
		}
	}
	document.write('<script charset="utf-8" type="text/javascript" src="http://disqus.com/forums/stereochrome/get_num_replies.js' + query + '"></' + 'script>');
})();
//]]>
</script>
<?php end_slot_append() ?>
