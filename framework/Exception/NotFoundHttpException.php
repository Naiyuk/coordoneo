<?php

declare(strict_types=1);

/**
 * NotFoundHttpException class
 */

namespace Framework\Exception;

use Framework\Exception\FrameworkException;

/**
 * NotFoundHttpException
 */
class NotFoundHttpException extends FrameworkException
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
        parent::__construct($message, 404);
    }
}