<?php

// connect to db
$link = mysql_connect('localhost', 'acdcjunior', '');
if (!$link) {
    die('Not connected : ' . mysql_error());
}

if (! mysql_select_db('qualisc9') ) {
    die ('Can\'t use qualisc9 : ' . mysql_error());
}
