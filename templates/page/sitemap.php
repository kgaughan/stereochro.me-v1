<?php $this->with_envelope() ?>
<?php start_slot('title') ?>Sitemap<?php end_slot() ?>
<h1>Sitemap</h1>

<p>This is quick and dirty and will be replaced with something more apt in
time. It only lists pages, not sub-applications and their contents (the weblog,
for example).</p>

<ul>
<?php foreach ($sitemap as $page) { ?>
<li><a href="<?php le($page['slug']) ?>"><?php ee($page['title']) ?></a></li>
<?php } ?>
</ul>
