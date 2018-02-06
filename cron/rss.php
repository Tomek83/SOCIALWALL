<?php

require_once '../vendor/autoload.php';

use classes\Data;

$__fd = [];

$__c = ['FEED' => 'http://example.com/news/feed.xml', 'MAX' => 10];

/**
 * @var SimpleXMLElement
 */
$__x = simplexml_load_file($__c['FEED']);

if ($__x) {
    foreach ($__x->channel->item as $__v) {
        $__r = [];
        $__r['url'] = trim((string)$__v->link);
        $__r['text'] = Data::trim((string)$__v->title . '. ' . (string)$__v->description, FEED_TRIM);
        $__r['date'] = trim(strftime('%e %b %H:%M', strtotime((string)$__v->pubDate)));
        $__fd[] = $__r;
    }
    (empty($__fd)) ? NULL : Data::store(RSS_FEED_DATA, array_slice($__fd, 0, $__c['MAX']));
}