<?php

require_once '../vendor/autoload.php';

use classes\Data;

$__fd = [];

$__c = ['FEED' => 'https://www.youtube.com/feeds/videos.xml?channel_id=xxxxxxxx', 'MAX' => 10];

/**
 * @var SimpleXMLElement
 */
$__x = simplexml_load_file($__c['FEED']);

if ($__x) {
    foreach ($__x->entry as $__v) {
        $__r = [];
        $__r['url'] = trim((string)$__v->link['href']);
        $__r['text'] = Data::trim((string)$__v->title, FEED_TRIM);
        $__r['date'] = trim(strftime('%e %b %H:%M', strtotime((string)$__v->published)));
        $__fd[] = $__r;
    }
    (empty($__fd)) ? NULL : Data::store(YT_FEED_DATA, array_slice($__fd, 0, $__c['MAX']));
}