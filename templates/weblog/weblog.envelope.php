<?php
$this->with_envelope();

start_slot('section_navigation');
if (cache('weblog:summary')) {
	$archive_summary = WeblogData::get_archive_summary();
	$year = null;
	$last_month = 0;
	?>
		<dl id="archive-summary">
		<dt>&nbsp;</dt>
		<dd>Jan</dd>
		<dd>Feb</dd>
		<dd>Mar</dd>
		<dd>Apr</dd>
		<dd>May</dd>
		<dd>Jun</dd>
		<dd>Jul</dd>
		<dd>Aug</dd>
		<dd>Sep</dd>
		<dd>Oct</dd>
		<dd>Nov</dd>
		<dd>Dec</dd>
		<?php
	foreach ($archive_summary as $r) {
		$m = intval($r['month']);
		$y = intval($r['year']);
		$ts = gmmktime(0, 0, 0, $m, 1, $y);
		if ($y != $year) {
			if ($last_month != 0) {
				for ($i = 0; $i < 12 - $last_month; $i++) {
					echo '<dd>&nbsp;</dd>';
				}
			}
			$year = $y;
			$last_month = 0;
			echo '<dt>', $year, ':</dt>';
		}
		if ($m - 1 != $last_month) {
			for ($i = 1; $i < $m - $last_month; $i++) {
				echo '<dd>&nbsp;</dd>';
			}
		}
		echo '<dd><a title="', gmdate('F Y', $ts), '; entries: ', $r['n'], '" href="';
		le('weblog/' . gmdate('Y-m', $ts));
		echo '">', $r['n'], '</a></dd>';
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
<?php end_slot_append() ?>
