# laravel-translate-formatter
A simple tool for Laravel document translate.

## Installation
To install this tool, run the command below and you will get the latest version
```
composer install louissu/laravel-translate-formatter
```
## Document
This is a very simple tool to translate the nouns list from [laravel-taiwan/docs wiki](https://github.com/laravel-taiwan/docs/wiki/%E8%A6%8F%E7%AF%84%EF%BC%86%E5%B0%88%E6%9C%89%E5%90%8D%E8%A9%9E%E5%B0%8D%E7%85%A7). It's will translate the nouns by the format with:
```
ability => 權限(ability)
```

It's non-case sensitive (means translate no matter upper or lower case) and will ignore code block. This result is just for reference only, so after run the `translate()` function, you still need to check them carefully, that's why the format include the resource and result.

### Example
```
<?php
require "vendor/autoload.php";

use Louissu\Translate\Handler;

$handler = new Handler();
echo $handler
     ->setLocale('zh-TW')
     ->translate(file_get_contents('./content.md'));
```

### setLocale()
This function set locale from English to something you want, it's default zh-TW and only zh-TW urrently, welcome to pr!

### translate()
This function will translate the corresponding nouns and return the result.
