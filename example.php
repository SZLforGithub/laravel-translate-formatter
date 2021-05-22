<?php
require "vendor/autoload.php";

use Louissu\Translate\Handler;

$handler = new Handler();
echo $handler
     ->setLocale('zh-TW')
     ->translate(file_get_contents('./content.md'));
