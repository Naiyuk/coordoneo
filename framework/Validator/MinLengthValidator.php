<?php

declare(strict_types=1);

/**
 * MinLength validator
 */

namespace Framework\Validator;

use Framework\Validator\Validator;

/**
 * MinLengthValidator
 */
class MinLengthValidator extends Validator
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
     * @param int $minLength
     * 
     * @return void
     */
	public function __construct(string $error, int $minLength)
	{
        $this->error = $error;
		$this->minLength = $minLength;
	}

	/**
	 * {@inheritDoc}
	 */
	public function isValid($value): bool
	{
		return (strlen($value) >= $this->minLength);
	}
}