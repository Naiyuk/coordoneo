<?php

declare(strict_types=1);

/**
 * BadHttpMethodException class
 */

namespace Framework\Exception;

use Framework\Exception\FrameworkException;

/**
 * BadHttpMethodException
 */
class BadHttpMethodException extends FrameworkException
{
    /**
     * Constructor
     * @access public
     * @param string $message
     * 
     * @return void
     */
    public function __construct($message)
    {
        parent::__construct($message, 405);
    }
}