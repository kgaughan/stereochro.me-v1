<?php AFK::dump(compact('link', 'title', 'via', 'note', 'time_c')) ?>

<?php require 'entry-types/' . get_entry_type($link, $title, $via, $note) . '.php' ?>
