<?php

declare(strict_types=1);

/*
 * LengthValidator validator
 */

namespace Framework\Validator;

use Framework\Validator\Validator;

/**
 * LengthValidator
 */
class LengthValidator extends Validator
{
	/**
	 * 
	 * @var int
	 * @access private
	 */
	private $length;

	/**
	 * Constructor
     * @access public
     * @param string $error
     * @param int $length
     * 
     * @return void
	 */
	public function __construct(string $error, int $length)
	{
		$this->error = $error;     
        $this->length = $length;
	}

	/**
	 * {@inheritDoc}
	 */
	public function isValid($value): bool
	{
		return (strlen($value) == $this->length);
	}
}