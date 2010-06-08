<?php $this->with_envelope() ?>
<?php start_slot('title') ?><?php echo format_line($title) ?><?php end_slot() ?>
<?php $this->render('edit-links', array('url' => $ctx->application_root() . "$slug;edit")) ?>
<?php start_slot('page_navigation') ?>
	<li><a rel="noindex,nofollow" href="<?php le("$slug;source") ?>">Page Source</a></li>
<?php end_slot_append() ?>

<?php if (cache('page:' . $ctx->REQUEST_URI)) { ?>
	<?php if (trim($style) != '') { ?><div class="style-<?php ee($style) ?>"><?php } ?>
	<h1><?php get_slot('title') ?></h1>

	<?php echo format($content) ?>

	<div id="metadata">
		Created at <?php ee(ts(PAGE_DATE, $time_c)) ?>
		<?php if ($time_c != $time_m) { ?>
			and last modified at <?php ee(ts(PAGE_DATE, $time_m)) ?>
		<?php } ?>
	</div>
	<?php if (trim($style) != '') { ?></div><?php } ?>
<?php cache_end(); } ?>
