<?php

declare(strict_types=1);

/*
 * NotNull validator
 */

namespace Framework\Validator;

use Framework\Validator\Validator;

/**
 * NotNullValidator
 */
class NotNullValidator extends Validator
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
        return !empty($value);
    }
}