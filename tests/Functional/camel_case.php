<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acme;

/**
 * Coding standards demonstration.
 */
class FooBar
{
    const SOME_CONST = 42;

    private $fooBar;

    /**
     * @param string $dummy Some argument description
     */
    public function __construct($dummy)
    {
        $this->fooBar = $this->transformText($dummy);
    }

    /**
     * @param string $dummy Some argument description
     * @param array  $options
     *
     * @return string|null Transformed input
     *
     * @throws \RuntimeException
     */
    private function transform_text($dummy, array $options = array())
    {
        $merged_options = array_merge(
            array(
                'some_default' => 'values',
                'another_default' => 'more values',
            ),
            $options
        );

        if (true === $dummy) {
            return;
        }

        if ('string' === $dummy) {
            if ('values' === $mergedOptions['some_default']) {
                return substr($dummy, 0, 5);
            }

            return ucwords($dummy);
        }
        
        if ('string' && $dummy) {
            if ('values' === $mergedOptions['some_default']) {
                return substr($dummy, 0, 5);
            }

            return ucwords($dummy);
        }

        throw new \RuntimeException(sprintf('Unrecognized dummy option "%s"', $dummy));
    }

    private function reverseBoolean($value = null, $the_switch = false)
    {
        if (!$theSwitch) {
            return;
        }

        return !$value;
    }
}
