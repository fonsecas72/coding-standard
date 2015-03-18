<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

/**
 * Rules:
 * - New class statement should not have empty parentheses.
 */
class Symfony_Sniffs_ControlStructures_BinarySpaceSniff implements PHP_CodeSniffer_Sniff
{

    /**
     * @return int[]
     */
    public function register()
    {
        return array(
            T_IS_EQUAL,
            T_IS_IDENTICAL,
            T_BOOLEAN_AND,
            T_BOOLEAN_OR,
        );
    }

    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens     = $phpcsFile->getTokens();

        $before = $tokens[($stackPtr - 1)]['content'];
        $after = $tokens[($stackPtr + 1)]['content'];

        if ($before !== ' ' || $after !== ' ') {
            $error = 'There must be a single space before and after an unary operator statement';
            $phpcsFile->addError($error, $stackPtr);
        }
    }
}
