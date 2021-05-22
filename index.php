<?php
require "vendor/autoload.php";

use Louissu\Translate\Handler;

$test = new Handler();
echo $test->setLocale('zh-TW')
     ->translate(file_get_contents('./content.md'));
