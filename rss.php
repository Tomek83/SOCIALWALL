<?
require_once 'config.inc.php';

$__fd=array();

$__c=array('RSSFEED'=>'http://example.com/feed.xml', 'MAXFEED'=>10);

$__x=simplexml_load_file($__c['RSSFEED']);

if ($__x) {
	foreach ($__x->channel->item as $__v) {
		$__r['url']=trim($__v->link);
		$__r['text']=__trim($__v->title.'. '.$__v->description, FEED_TRIM);
		$__r['date']=trim(strftime('%e %b %H:%M', strtotime($__v->pubDate)));
		array_push($__fd, $__r);
	}
	(empty($__fd)) ? NULL : __fput(RSS_FEED_DATA, serialize(array_slice($__fd, 0, $__c['MAXFEED'])));
}
?>
