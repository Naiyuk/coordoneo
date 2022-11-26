<?php

declare(strict_types=1);

/*
 * SQLInjection validator
 */

namespace Framework\Validator;

use Framework\Validator\Validator;

/**
 * SQLInjectionValidator
 */
class SQLInjectionValidator extends Validator
{
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
        if (preg_match("#drop|delete|update|insert|union|select|where|like|create|set|join#i", $value)) {

            return false;

        }
        
        return true;
    }
    
}