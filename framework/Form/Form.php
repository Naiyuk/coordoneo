<?php

declare(strict_types=1);

/**
 * Form class
 */

namespace Framework\Form;

use Framework\{
	Field\Field,
	Http\Request,
	Entity\Entity
};

/**
 * Form
 */
class Form
{
	/**
	 * 
	 * @var Entity
	 * @access private
	 */
	private $entity;

	/**
	 * 
	 * @var array
	 * @access private
	 */
	private $fields = [];

	/**
	 * Add field in form
	 * @access public
	 * @param Field $field
     * 
	 * @return void
	 */
	public function add(Field $field): void
	{
		$method = 'get'.ucfirst($field->getName());

		if (is_callable([$this->entity, $method])) {

			$field->setValue($this->entity->$method());
		
		}

		$this->fields[] = $field;
	}

	/**
	 * Is valid
	 * @access public
     * 
	 * @return bool
	 */
	public function isValid(): bool
	{
		$valid = true;

		foreach ($this->fields as $field)  {

			if (!$field->getRequired() && empty($field->getValue())) {
				return true;
			}

			if (!$field->isValid()) {

				$valid = false;
			}
		}

		return $valid;
    }
    
    /**
     * Handle request
     * @access public
     * @param Request $request
     * 
     * @return void
     */
    public function handleRequest(Request $request): void
    {
		if ($request->isMethod('POST')) {

			foreach ($this->fields as $field) {
				$value = $request->getPostData($field->getName());
				$field->setValue($value);

				$methodSet = 'set'.ucfirst($field->getName());
				$methodGet = 'get'.ucfirst($field->getName());

				if (!empty($this->entity->getId())) {
					if (is_callable([$this->entity, $methodGet]) && $this->entity->$methodGet() == $value) {
						$field->unsetValidators();
					}
				}

				if (is_callable([$this->entity, $methodSet])) {

					$this->entity->$methodSet($value);
				
				}
			}
		}

		return;
    }

	/**
	 * Create view
	 * @access public
     * 
	 * @return string
	 */
	public function createView(): string
	{
		$form = '';

		foreach ($this->fields as $field)  {
			
			$form .= $field->buildField();
		}

		return $form;
    }
    
    /**
	 * Get entity
	 * @access public
	 * 
	 * @return Entity
	 */
	public function getEntity(): Entity
	{
		return $this->entity;
    }
    
    /**
	 * Set entity
     * @access public
     * @param Entity $entity
     * 
     * @return void
     */
    public function setEntity(Entity $entity): void
    {
        $this->entity = $entity;
    }
}