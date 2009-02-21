<div class="entry">
	<div class="meta">
		<?php ee(date(WEBLOG_DATE, $time_c)) ?>
		<?php
		$links = array();
		$links[] = array('link' => '/weblog/' . $id, 'title' => '#');
		if ($link != '' && $title == '') {
			$links[] = array('link' => $link, 'title' => 'link');
		}
		if ($via != '') {
			$links[] = array('link' => $via, 'title' => 'source');
		}
		$this->render_each('entry-metadata', $links);
		?>
	</div>

	<?php if ($title != '' && $link != '') { ?>
	<h2><a href="<?php ee($link) ?>"><?php echo format_line($title) ?></a></h2>
	<?php } elseif ($title != '') { ?>
	<h2><?php echo format_line($title) ?></h2>
	<?php } ?>
	<?php if ($note != '') { ?>
		<?php echo format($note) ?>
	<?php } ?>
</div>
