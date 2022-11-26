<?php

declare(strict_types=1);

/**
 * CSRFToken validator
 */

namespace Framework\Validator;

use Framework\Validator\Validator;

/**
 * CSRFTokenValidator
 */
class CSRFTokenValidator extends Validator
{
	/**
	 * 
	 * @var int
	 * @access private
	 */
	private $minLength;

    
    /**
     * Constructor
     * @access public
     * @param string $error
     * 
     * @return void
     */
	public function __construct(string $error)
	{
        $this->error = $error;
	}

	/**
	 * {@inheritDoc}
	 */
	public function isValid($value): bool
	{
        if (!empty($_SESSION['token']) && !empty($value) && $_SESSION['token'] == $value) {
            return true;
        }

        return false;
	}
}