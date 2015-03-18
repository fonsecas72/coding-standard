<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2012 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Symfony\Sniffs\Naming;

/**
 * Rules:
 * - Integer operator should be spelled 'int'
 */
class DoubleSniff extends NamingSniffer
{

    /**
     * @return string[]
     */
    protected function getPossibleForms()
    {
        return ['real', 'double', 'float'];
    }

    /**
     * @return string
     */
    protected function getAllowedForm()
    {
        return 'float';
    }

    /**
     * @return string
     */
    protected function getErrorMessage()
    {
        return 'Integer operator should be spelled "%s"; "%s" found';
    }
}
