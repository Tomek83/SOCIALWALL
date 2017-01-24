<?
require_once 'config.inc.php';

$__fd=array();

$__c=array('CONSUMERKEY'=>'xxx', 'CONSUMERSECRET'=>'xxx', 'ACCESSTOKEN'=>'xxx', 'ACCESSTOKENSECRET'=>'xxx', 'TIMESTAMP'=>(time()-60), 'MAXFEED'=>10, 'USERNAME'=>'xxx');

$__u='https://api.twitter.com/1.1/statuses/user_timeline.json';
$__b='GET&'.rawurlencode($__u).'&'.rawurlencode('count='.$__c['MAXFEED'].'&oauth_consumer_key='.$__c['CONSUMERKEY'].'&oauth_nonce='.$__c['TIMESTAMP'].'&oauth_signature_method=HMAC-SHA1&oauth_timestamp='.$__c['TIMESTAMP'].'&oauth_token='.$__c['ACCESSTOKEN'].'&oauth_version=1.0&screen_name='.$__c['USERNAME']);
$__k=rawurlencode($__c['CONSUMERSECRET']).'&'.rawurlencode($__c['ACCESSTOKENSECRET']);
$__s=rawurlencode(base64_encode(hash_hmac('sha1', $__b, $__k, TRUE)));
$__h="oauth_consumer_key=\"".$__c['CONSUMERKEY']."\", oauth_nonce=\"".$__c['TIMESTAMP']."\", oauth_signature=\"$__s\", oauth_signature_method=\"HMAC-SHA1\", oauth_timestamp=\"".$__c['TIMESTAMP']."\", oauth_token=\"".$__c['ACCESSTOKEN']."\", oauth_version=\"1.0\"";

$__q=curl_init();
curl_setopt($__q, CURLOPT_HTTPHEADER, array("Authorization: Oauth $__h", 'Expect:'));
curl_setopt($__q, CURLOPT_HEADER, FALSE);
curl_setopt($__q, CURLOPT_URL, $__u."?screen_name=".$__c['USERNAME']."&count=".$__c['MAXFEED']);
curl_setopt($__q, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($__q, CURLOPT_SSL_VERIFYPEER, FALSE);
$__g=curl_exec($__q);
curl_close($__q);

$__js=json_decode(trim($__g));

if ($__js) {
	foreach ($__js as $__v) {
		$__r=array();
		$__r['url']=trim($__v->entities->urls[0]->url);
		$__d=explode("\n", trim($__v->text));
		$__r['text']=__trim($__d[1], FEED_TRIM);
		$__r['img']=trim($__v->entities->media[0]->media_url);
		$__r['date']=trim(strftime('%e %b %H:%M', strtotime($__v->created_at)));
		array_push($__fd, $__r);
	}
	(empty($__fd)) ? NULL : __fput(TW_FEED_DATA, serialize($__fd));
}
?>
