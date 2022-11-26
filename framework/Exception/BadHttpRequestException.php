<?php

declare(strict_types=1);

/**
 * BadHttpRequestException class
 */

namespace Framework\Exception;

use Framework\Exception\FrameworkException;

/**
 * BadHttpRequestException
 */
class BadHttpRequestException extends FrameworkException
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
        parent::__construct($message, 400);
    }
}