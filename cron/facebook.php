<?php

require_once '../vendor/autoload.php';

use classes\Data;

$__fd = [];

$__c = ['APPID' => 'xxx', 'APPSECRET' => 'xxx', 'PAGEID' => 'xxx', 'MAX' => 10];

$__a = file_get_contents('https://graph.facebook.com/oauth/access_token?grant_type=client_credentials&client_id=' . $__c['APPID'] . '&client_secret=' . $__c['APPSECRET']);

$__g = file_get_contents('https://graph.facebook.com/' . $__c['PAGEID'] . '/feed?' . $__a . '&limit=' . $__c['MAX']);

$__js = json_decode(trim($__g));

if ($__js) {
    foreach ($__js->data as $__v) {
        $__r = [];
        $__r['url'] = trim($__v->actions[0]->link);
        $__r['text'] = Data::trim($__v->name . '. ' . $__v->description, FEED_TRIM);
        $__r['img'] = trim($__v->picture);
        $__r['date'] = trim(strftime('%e %b %H:%M', strtotime($__v->created_time)));
        $__fd[] = $__r;
    }
    (empty($__fd)) ? NULL : Data::store(FB_FEED_DATA, $__fd);
}