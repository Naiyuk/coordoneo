<?php

declare(strict_types=1);

/**
 * Validator class
 */

namespace Framework\Validator;

/**
 * Validator
 * @abstract
 */
abstract class Validator
{
	/**
     * 
     * @var string
     * @access protected
     */
	protected $error;
		
	/**
     * Is valid
	 * @access public
	 * @param mixed $value
	 * @abstract
     * 
     * @return bool
	 */
	abstract public function isValid($value);
	
	/**
     * Get error
	 * @access public
     * 
	 * @return string
	 */
	public function getError(): string
	{
		return $this->error;
    }
    
    /**
     * Set error
	 * @access public
	 * @param string $error
     * 
	 * @return void
	 */
	public function setError(string $error): void
	{
		$this->error = $error;
	}
}