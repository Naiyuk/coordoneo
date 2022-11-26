<?php

declare(strict_types=1);

/**
 * UniqueValidator
 */

namespace Framework\Validator;

use Framework\Manager\EntityManager;

/**
 * UniqueValidator
 */
class UniqueValidator extends Validator
{
    /**
     * @var EntityManager
     * @access private
     */
    private $entityManager;

    /**
     * Constructor
     * @access public
     * @param string $error
     * @param EntityManager $manager
     * 
     * @return void
     */
	public function __construct(string $error, EntityManager $manager)
	{
        $this->error = $error;
        $this->manager = $manager;
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function isValid($value): bool
	{     
        $method = 'isExists';

		if (is_callable([$this->manager, $method])) {
            $isUnique = $this->manager->$method($value);

            return !$isUnique;
        }

        return false;
	}
}