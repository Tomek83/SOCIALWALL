<?php

setlocale(LC_ALL, 'pl_PL.utf8');

mb_internal_encoding('UTF-8');

mb_regex_encoding('UTF-8');

define('DATA', dirname(__FILE__) . '/data/');

define('OK_CODE', 250);

define('ERROR_CODE', 0);

define('FB_FEED_DATA', DATA . 'facebook.txt');

define('TW_FEED_DATA', DATA . 'twitter.txt');

define('YT_FEED_DATA', DATA . 'youtube.txt');

define('RSS_FEED_DATA', DATA . 'feed.txt');

define('FEED_ENTRY_HTML', '<li><a href="%s">%s<span>%s</span></a></li>');

define('FEED_TRIM', 200);