<?
require_once 'config.inc.php';

$__fd=array();

$__c=array('RSSFEED'=>'https://www.youtube.com/feeds/videos.xml?channel_id=xxx', 'MAXFEED'=>10);

$__x=simplexml_load_file($__c['RSSFEED']);

if ($__x) {
	foreach ($__x->entry as $__v) {
		$__r['url']=trim($__v->link['href']);
		$__r['text']=__trim($__v->title, FEED_TRIM);
		$__r['date']=trim(strftime('%e %b %H:%M', strtotime($__v->published)));
		array_push($__fd, $__r);
	}
	(empty($__fd)) ? NULL : __fput(YT_FEED_DATA, serialize(array_slice($__fd, 0, $__c['MAXFEED'])));
}
?>
