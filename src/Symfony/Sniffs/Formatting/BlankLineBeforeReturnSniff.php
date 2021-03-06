<?php

/**
 * Symfony_Sniffs_Formatting_BlankLineBeforeReturnSniff.
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @author   Alexander Obuhovich <aik.bold@gmail.com>
 * @license  https://github.com/aik099/CodingStandard/blob/master/LICENSE BSD 3-Clause
 * @link     https://github.com/aik099/CodingStandard
 */

/**
 * Symfony_Sniffs_Formatting_BlankLineBeforeReturnSniff.
 *
 * Throws errors if there's no blank line before return statements. Symfony
 * coding standard specifies: "Add a blank line before return statements,
 * unless the return is alone inside a statement-group (like an if statement);"
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @author   Alexander Obuhovich <aik.bold@gmail.com>
 * @license  https://github.com/aik099/CodingStandard/blob/master/LICENSE BSD 3-Clause
 * @link     https://github.com/aik099/CodingStandard
 */
class Symfony_Sniffs_Formatting_BlankLineBeforeReturnSniff implements PHP_CodeSniffer_Sniff
{

    /**
     * A list of tokenizers this sniff supports.
     *
     * @var array
     */
    public $supportedTokenizers = array(
                                   'PHP',
                                   'JS',
                                  );


    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return integer[]
     */
    public function register()
    {
        return array(T_RETURN);

    }//end register()


    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile All the tokens found in the document.
     * @param int                  $stackPtr  The position of the current token in
     *                                        the stack passed in $tokens.
     *
     * @return void
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens    = $phpcsFile->getTokens();
        $prevToken = $phpcsFile->findPrevious(
            PHP_CodeSniffer_Tokens::$emptyTokens,
            ($stackPtr - 1),
            null,
            true
        );

        $expectedBlankLineCount = 1;
        $leadingLinePtr         = $this->getLeadingLinePointer($phpcsFile, $stackPtr, $prevToken);
        $blankLineCount         = ($tokens[$leadingLinePtr]['line'] - ($tokens[$prevToken]['line'] + 1));

        if (isset($tokens[$prevToken]['scope_opener']) === true && $tokens[$prevToken]['scope_opener'] === $prevToken) {
            $expectedBlankLineCount = 0;
        }

        if ($blankLineCount !== $expectedBlankLineCount) {
            $error = 'Expected %s blank line before return statement; %s found';
            $data  = array(
                      $expectedBlankLineCount,
                      $blankLineCount,
                     );
            $phpcsFile->addError($error, $stackPtr, 'BlankLineBeforeReturn', $data);
        }

    }//end process()


    /**
     * Returns leading comment stack pointer or own stack pointer, when no comment found.
     *
     * @param PHP_CodeSniffer_File $phpcsFile    All the tokens found in the document.
     * @param int                  $fromStackPtr Start from token.
     * @param int                  $toStackPtr   Stop at token.
     *
     * @return int|bool
     */
    protected function getLeadingLinePointer(PHP_CodeSniffer_File $phpcsFile, $fromStackPtr, $toStackPtr)
    {
        $tokens         = $phpcsFile->getTokens();
        $fromToken      = $tokens[$fromStackPtr];
        $prevCommentPtr = $phpcsFile->findPrevious(
            T_COMMENT,
            ($fromStackPtr - 1),
            $toStackPtr
        );

        if ($prevCommentPtr === false) {
            return $fromStackPtr;
        }

        $prevCommentToken = $tokens[$prevCommentPtr];

        if ($prevCommentToken['line'] === ($fromToken['line'] - 1)
            && $prevCommentToken['column'] === $fromToken['column']
        ) {
            return $prevCommentPtr;
        }

        return $fromStackPtr;

    }//end getLeadingLinePointer()


}//end class