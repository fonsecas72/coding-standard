<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Symfony\Sniffs\Naming;

/**
 * Rules:
 * - Bool operator should be spelled 'bool'
 */
class BoolSniff extends NamingSniffer
{

    /**
     * @return string[]
     */
    protected function getPossibleForms()
    {
        return ['bool', 'boolean', 'Boolean'];
    }

    /**
     * @return string
     */
    protected function getAllowedForm()
    {
        return 'bool';
    }

    /**
     * @return string
     */
    protected function getErrorMessage()
    {
        return 'Bool operator should be spelled "%s"; "%s" found';
    }
}
