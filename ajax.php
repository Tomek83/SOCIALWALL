<?php

require_once 'vendor/autoload.php';

use classes\Data;

header('Content-Type: text/plain; charset=UTF-8');

$request = ['STATUS' => ERROR_CODE, 'RESULT' => [], 'MESSAGE' => ''];

$__f = [FB_FEED_DATA, TW_FEED_DATA, YT_FEED_DATA, RSS_FEED_DATA];

foreach ($__f as $__k => $__t) {

    $__r = Data::restore($__t);

    if (empty($__r)) continue;

    $__r = unserialize($__r);

    $request['RESULT'][$__k] = [];

    foreach ($__r as &$__v) {
        $request['RESULT'][$__k][] = sprintf(FEED_ENTRY_HTML, $__v['url'], $__v['text'], $__v['date']);
    }

}

$request['STATUS'] = OK_CODE;

print json_encode($request);