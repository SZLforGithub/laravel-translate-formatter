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

    public function getLocale()
    {
        return $this->locale ?? '';
    }

    public function translate(string $rawContent)
    {
        $content = $rawContent;

        $nounsList = $this->getNounsList();

        foreach ($nounsList['compound_nouns'] as $raw_compound_noun => $compound_noun) {
            $content = preg_replace(
                "/(?<=[^a-z0-9A-Z]){$raw_compound_noun}(?=[^a-z0-9A-Z])/i",
                "$compound_noun ($raw_compound_noun)",
                $content
            );
        }

        foreach ($nounsList['nouns'] as $raw_noun => $noun) {
            $content = preg_replace(
                "/(?<=[^a-z0-9A-Z]){$raw_noun}(?=[^a-z0-9A-Z])/i",
                "$noun ($raw_noun)",
                $content
            );
        }

        return $content;
    }

    private function getNounsList()
    {
        $file =  "{$this->i18nDir}{$this->locale}.json";
        
        return json_decode(file_get_contents($file), true);
    }
}