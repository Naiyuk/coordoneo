<?php

declare(strict_types=1);

/**
 * AccessDeniedException class
 */

namespace Framework\Exception;

use Framework\Exception\FrameworkException;

/**
 * AccessDeniedException
 */
class AccessDeniedException extends FrameworkException
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