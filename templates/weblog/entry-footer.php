<div id="metadata">
<?php if ($via != '') { ?>
	<a href="<?php ee($via) ?>"?>Via</a>;
<?php } ?>
Created at <?php ee(ts(PAGE_DATE, $time_c)) ?>
<?php if ($time_c != $time_m) { ?>
	and last modified at <?php ee(ts(PAGE_DATE, $time_m)) ?>
<?php } ?>
</div>

<div id="disqus_thread"></div>
<script type="text/javascript" src="http://disqus.com/forums/stereochrome/embed.js"></script>
<noscript><a href="http://disqus.com/forums/stereochrome/?url=ref">View the discussion thread.</a></noscript>

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
<?php end_slot() ?>
