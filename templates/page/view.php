<?php $this->with_envelope() ?>
<?php start_slot('title') ?><?php echo format_line($title) ?><?php end_slot() ?>
<?php $this->render('edit-links', array('url' => $ctx->application_root() . "$slug;edit")) ?>

<?php if (cache('page:' . $ctx->REQUEST_URI)) { ?>
	<h1><?php get_slot('title') ?></h1>

	<?php echo format($content) ?>

	<div id="metadata">
		Created at <?php ee(date(PAGE_DATE, $time_c)) ?><?php if ($time_c != $time_m) { ?>;
		last modified at <?php ee(date(PAGE_DATE, $time_m)) ?>
		<?php } ?>
	</div>
<?php cache_end(); } ?>
