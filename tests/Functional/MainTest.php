<?php

namespace Symfony\CodingStandard\Tests\Functional;

use PHPUnit_Framework_TestCase;
use Symfony\CodingStandard\Tests\CodeSnifferRunner;

class MainTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var CodeSnifferRunner
     */
    private $codeSnifferRunner;

    protected function setUp()
    {
        $this->codeSnifferRunner = new CodeSnifferRunner();
    }

    public function detectionProvider()
    {
        return array(
            // Structure
            array(0, 'correct.php'),
            array(4, 'space_comma.php'),
            array(5, 'single_space_binary.php'),
            array(3, 'unary_operators_adjacent.php'),
            array(1, 'array_comma.php'),
            array(1, 'line_before_return.php'),
            array(1, 'use_brace.php'),
            array(1, 'one_class_file.php'),
            array(1, 'prop_before_methods.php'),
            array(1, 'public_methods_first.php'),
            array(2, 'setup_teardown_methods_first.php'),
            array(1, 'use_parentheses_new_class.php'),
            array(1, 'expections_sprintf.php'),

            // Naming Conventions
            array(3, 'camel_case.php'),
            //array(0, 'option_parameters_names.php'),
            array(1, 'class_namespace.php'),
            //array(0, 'abstract_classes.php'),
            array(1, 'sufix_interfaces.php'),
            array(1, 'sufix_trait.php'),
            array(1, 'sufix_exception.php'),
            array(1, 'filename_with_&_char.php'),
            array(5, 'docblock_type_hint.php'),

            // Documentation
            array(1, 'docblock_all_things.php'),
            array(2, 'docblock_return_flag.php'),
            array(2, 'docblock_package_subpackage_not_used.php'),
        );
    }
    
    /**
     *
     * @param int    $expectedErrors
     * @param string $fileName
     * @dataProvider detectionProvider
     */
    public function testDetection($expectedErrors, $fileName)
    {
        $this->assertSame($expectedErrors, $this->codeSnifferRunner->getErrorCountInFile(__DIR__.'/'.$fileName));
    }
}
