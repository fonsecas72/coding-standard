<?php

/**
 * This file is part of Symfony
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Symfony\CodingStandard\Composer;

use Composer\Script\Event;

class ScriptHandler
{

    public static function addPhpCsToPreCommitHook(Event $event)
    {
        $originFile = getcwd() . '/.git/hooks/pre-commit';
        $templateContent = file_get_contents(__DIR__ . '/templates/git/hooks/pre-commit-phpcs');
        if (file_exists($originFile)) {
            $originContent = file_get_contents($originFile);
            if (strpos($originContent, '# run phpcs') === false) {
                $newContent = $originContent . PHP_EOL . PHP_EOL . $templateContent;
                file_put_contents($originFile, $newContent);
            }
        } else {
            file_put_contents($originFile, $templateContent);
        }
        chmod($originFile, 0755);
    }
}
