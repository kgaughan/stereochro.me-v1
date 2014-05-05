<div id="metadata">
<?php if ($via != '') { ?>
	<a href="<?php ee($via) ?>">Via <?php ee(get_via_host($via)) ?></a>;
<?php } ?>
Created at <?php ee(ts(PAGE_DATE, $time_c)) ?>
<?php if ($time_c != $time_m) { ?>
	and last modified at <?php ee(ts(PAGE_DATE, $time_m)) ?>
<?php } ?>
</div>

<?php start_slot('post_body') ?>
<?php end_slot() ?>
