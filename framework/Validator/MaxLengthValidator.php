<?php

declare(strict_types=1);

/*
 * MaxLength validator
 */

namespace Framework\Validator;

use Framework\Validator\Validator;

/**
 * MaxLengthValidator
 */
class MaxLengthValidator extends Validator
{
	/**
	 * 
	 * @var int
	 * @access private
	 */
	private $maxLength;

	/**
	 * Constructor
     * @access public
     * @param string $error
     * @param int $maxLength
     * 
     * @return void
	 */
	public function __construct(string $error, int $maxLength)
	{
		$this->error = $error;     
        $this->maxLength = $maxLength;
	}

	/**
	 * {@inheritDoc}
	 */
	public function isValid($value): bool
	{
		return (strlen($value) <= $this->maxLength);
	}
}