<?php
/**
 * Symfony_Sniffs_Formatting_SpaceUnaryOperatorSniff.
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @author   Peter Philipp <peter.philipp@cando-image.com>
 * @author   Alexander Obuhovich <aik.bold@gmail.com>
 * @license  https://github.com/aik099/CodingStandard/blob/master/LICENSE BSD 3-Clause
 * @link     https://github.com/aik099/CodingStandard
 */

/**
 * Symfony_Sniffs_Formatting_SpaceUnaryOperatorSniff.
 *
 * Ensures there are no spaces on increment / decrement statements.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @author   Peter Philipp <peter.philipp@cando-image.com>
 * @author   Alexander Obuhovich <aik.bold@gmail.com>
 * @license  https://github.com/aik099/CodingStandard/blob/master/LICENSE BSD 3-Clause
 * @link     https://github.com/aik099/CodingStandard
 */
class Symfony_Sniffs_Formatting_SpaceUnaryOperatorSniff implements PHP_CodeSniffer_Sniff
{

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return integer[]
     */
    public function register()
    {
         return array(
                 T_DEC,
                 T_INC,
                 T_BOOLEAN_NOT
                );

    }//end register()


    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token in
     *                                        the stack passed in $tokens.
     *
     * @return void
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens     = $phpcsFile->getTokens();
        $modifyLeft = substr($tokens[($stackPtr - 1)]['content'], 0, 1) === '$'
            || $tokens[($stackPtr + 1)]['content'] === ';';

        if ($modifyLeft === true && $tokens[($stackPtr - 1)]['code'] === T_WHITESPACE) {
            $error = 'There must not be a single space before an unary operator statement';
            $fix   = $phpcsFile->addFixableError($error, $stackPtr);

            if ($fix === true) {
                $phpcsFile->fixer->beginChangeset();
                $phpcsFile->fixer->replaceToken(($stackPtr - 1), '');
                $phpcsFile->fixer->endChangeset();
            }
        }

        if ($modifyLeft === false && substr($tokens[($stackPtr + 1)]['content'], 0, 1) !== '$') {
            $error = 'A unary operator statement must not followed by a single space';
            $fix   = $phpcsFile->addFixableError($error, $stackPtr);

            if ($fix === true) {
                $phpcsFile->fixer->beginChangeset();
                $phpcsFile->fixer->replaceToken(($stackPtr + 1), '');
                $phpcsFile->fixer->endChangeset();
            }
        }

    }//end process()


}//end class