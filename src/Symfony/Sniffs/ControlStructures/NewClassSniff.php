<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

/**
 * Rules:
 * - New class statement should not have empty parentheses.
 */
class Symfony_Sniffs_ControlStructures_NewClassSniff implements PHP_CodeSniffer_Sniff
{

    /**
     * @return int[]
     */
    public function register()
    {
        return [T_NEW];
    }

    /**
     * @param PHP_CodeSniffer_File $file
     * @param int $position
     */
    public function process(PHP_CodeSniffer_File $file, $position)
    {
        if (! $this->hasParentheses($file, $position)) {
            $error = 'New class statement should have parentheses';
            $file->addError($error, $position);
        }
    }

    /**
     * @param PHP_CodeSniffer_File $file
     * @param int $position
     * @return bool
     */
    private function hasParentheses(PHP_CodeSniffer_File $file, $position)
    {
        $tokens = $file->getTokens();
        $nextPosition = $position;

        do {
            $nextPosition++;
        } while (!$this->doesContentContains($tokens[$nextPosition]['content'], [';', '(', ',', ')']));

        if ($tokens[$nextPosition]['content'] !== '(') {
            return FALSE;
        }

        return TRUE;
    }

    /**
     * @param string $content
     * @param string[] $chars
     * @return bool
     */
    private function doesContentContains($content, array $chars)
    {
        foreach ($chars as $char) {
            if ($content === $char) {

                return TRUE;
            }
        }

        return FALSE;
    }
}
