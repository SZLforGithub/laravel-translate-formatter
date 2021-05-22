<?php

namespace Louissu\Translate;

class Handler
{
    protected $locale  = 'zh-TW';
    protected $i18nDir = __DIR__ . "/../i18n/";

    public function setLocale(string $locale)
    {
        $this->locale = $locale;

        return $this;
    }

    public function translate(string $rawContents)
    {
        $contents = explode(PHP_EOL, $rawContents);
        $nounsList = $this->getNounsList();

        foreach ($contents as &$content) {
            if ($this->isCodeBlock($content)) {
                continue;
            }

            foreach ($nounsList['compound_nouns'] as $raw_compound_noun => $compound_noun) {
                $content = preg_replace(
                    "/(?<=[^a-z0-9A-Z#\-\/\_]){$raw_compound_noun}(?=[^a-z0-9A-Z])/i",
                    "$compound_noun($raw_compound_noun)",
                    $content
                );
            }

            foreach ($nounsList['nouns'] as $raw_noun => $noun) {
                $content = preg_replace(
                    "/(?<=[^a-z0-9A-Z#\-\/\_]){$raw_noun}(?=[^a-z0-9A-Z])/i",
                    "$noun($raw_noun)",
                    $content
                );
            }
        }

        unset($content);

        return implode(PHP_EOL, $contents);
    }

    private function getNounsList()
    {
        $file =  "{$this->i18nDir}{$this->locale}.json";

        if (!is_file($file)) {
            throw new \ErrorException("This locale is not yet supported!");
        }

        return json_decode(file_get_contents($file), true);
    }

    private function isCodeBlock($content)
    {
        if (substr($content, 0, 4) == '    ') {
            if (
                strpos($content, '-') !== false &&
                substr($content, strpos($content, '-') - 1, 1) === ' ' &&
                substr($content, strpos($content, '-') + 1, 1) === ' '
            ) {
                return false;
            }

            return true;
        }

        return false;
    }
}