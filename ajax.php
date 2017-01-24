<?
require_once 'config.inc.php';

header('Content-Type: text/plain; charset=UTF-8');

$request=array('STATUS'=>ERROR_CODE, 'RESULT'=>array(), 'MESSAGE'=>'');

$__f=array(FB_FEED_DATA, TW_FEED_DATA, YT_FEED_DATA, RSS_FEED_DATA);

foreach ($__f as $__k=>$__t) {

	$__r=trim(@file_get_contents($__t));

	if (empty($__r)) continue;

	$__r=unserialize($__r);

	$request['RESULT'][$__k]=array();

	foreach ($__r as &$__v) {
		array_push($request['RESULT'][$__k], sprintf(FEED_ENTRY_HTML, $__v['url'], $__v['text'], $__v['date']));
	}

}

$request['STATUS']=OK_CODE;

print json_encode($request);
?>
