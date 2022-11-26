<?php

declare(strict_types=1);

/**
 * AuthenticationException class
 */

namespace Framework\Exception;

use Framework\Exception\FrameworkException;

/**
 * AuthenticationException
 */
class AuthenticationException extends FrameworkException
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
        parent::__construct($message, 401);
    }
}