<?
setlocale(LC_ALL, 'pl_PL.utf8');

mb_internal_encoding('UTF-8');

mb_regex_encoding('UTF-8');

define('DATA', dirname(__FILE__).'/data/');

define('OK_CODE', 250);

define('FB_FEED_DATA', DATA.'facebook.txt');

define('TW_FEED_DATA', DATA.'twitter.txt');

define('YT_FEED_DATA', DATA.'youtube.txt');

define('RSS_FEED_DATA', DATA.'feed.txt');

define('FEED_ENTRY_HTML', '<li><a href="%s">%s<span>%s</span></a></li>');

define('FEED_TRIM', 200);

function __trim ($__t, $__ML=200, $__FL='...') {
	$__sc=html_entity_decode($__t, ENT_COMPAT, 'UTF-8');
	if (mb_strlen($__sc)<=$__ML) return $__t;
	$___t=mb_substr($__sc, 0, $__ML-3); $___t.=$__FL;
	return htmlentities($___t, ENT_COMPAT, 'UTF-8');
}

function __fput ($__f, $__d) {
	$__p=fopen($__f, 'w+');
	if (flock($__p, LOCK_EX)) {fwrite($__p, $__d);fflush($__p);flock($__p, LOCK_UN);}
	fclose($__p);
}
?>
