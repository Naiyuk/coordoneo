<?php

declare(strict_types=1);

/*
 * Regex validator
 */

namespace Framework\Validator;

use Framework\Validator\Validator;

/**
 * RegexValidator
 */
class RegexValidator extends Validator
{
	/**
	 * 
	 * @var string
	 * @access private
	 */
    private $pattern;
    
    /**
	 * 
	 * @var boolean
	 * @access private
	 */
	private $match;

	/**
	 * Constructor
     * @access public
     * @param string $error
	 * @param string $pattern
     * @param boolean $match
     * 
     * @return void
	 */
	public function __construct(string $error, string $pattern, bool $match = true)
	{
        $this->error = $error;
        $this->match = $match;
		$this->pattern = $pattern;
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function isValid($value): bool
	{
		$matching = preg_match($this->pattern, $value);
		
		if ($this->match == false && $matching == true) {
			$matching = false;
		} else if ($this->match == false && $matching == false) {
			$matching = true;
		}

		return (bool) $matching;
	}
}