<?php

namespace Symfony\CodingStandard\Tests;

use PHP_CodeSniffer;

class CodeSnifferRunner
{

    /**
     * @var PHP_CodeSniffer
     */
    private $codeSniffer;

    /**
     * @param string $sniff
     */
    public function __construct($sniff = array())
    {
        $this->codeSniffer = new PHP_CodeSniffer;
        $this->codeSniffer->initStandard(__DIR__.'/../src/Symfony/ruleset.xml', $sniff);
    }

    /**
     * @param string $source
     * @return int
     */
    public function getErrorCountInFile($source)
    {
        if (!file_exists($source)) {
            throw new \Exception("File $source was not found");
        }

        $file = $this->codeSniffer->processFile($source);
        
        return $file->getErrorCount();
    }
}
