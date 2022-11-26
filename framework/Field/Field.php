<?php

declare(strict_types=1);

/*
 * Field class
 */


namespace Framework\Field;

use Framework\Validator\Validator;

/**
 * Field
 * @abstract
 */
abstract class Field
{
    /**
	 * 
	 * @var string
	 * @access protected
	 */
    protected $name;

    /**
	 * 
	 * @var mixed
	 * @access protected
	 */
    protected $value;
    
    /**
	 * 
	 * @var string
	 * @access protected
	 */
    protected $label;
    
    /**
	 * 
	 * @var string
	 * @access protected
	 */
    protected $error;
        
    /**
	 * 
	 * @var bool
	 * @access protected
	 */
    protected $required = false;

    /**
	 * 
	 * @var array
	 * @access protected
	 */
    protected $validators = [];

    /**
     * Constructor
	 * @access public
	 * @param array $options
     * 
     * @return void
	 */
	public function __construct(array $options = [])
	{
		if (!empty($options)) {

			$this->hydrate($options);
		}
	}

    /**
	 * Is valid
	 * @access public
     * 
	 * @return bool
	 */
	public function isValid(): bool
    {
        foreach ($this->validators as $validator) {

            if (!$validator->isValid($this->value)) {

                $this->error = $validator->getError();
                return false;
            }
        }
    
        return true;
    }

    /**
     * Hydrate
	 * @access public
	 * @param array $options
     * 
	 * @return void
	 */
	public function hydrate(array $options): void
  	{
		foreach ($options as $key => $value) {

	      $method = 'set'.ucfirst($key);
	      
	      if (is_callable([$this, $method])) {

	        $this->$method($value);
	      }
	    }
    }

    /**
	 * Build field
	 * @access public
	 * @abstract
     * 
     * @return string
	 */
	abstract public function buildField();
	
	/**
     * Get name
	 * @access public
     * 
	 * @return string
	 */
    public function getName(): string
    {
    	return $this->name;
	}
	
	/**
     * Get required
	 * @access public
     * 
	 * @return boolean
	 */
    public function getRequired(): bool
    {
    	return $this->required;
    }

    /**
     * Get value
	 * @access public
     * 
	 * @return mixed
	 */
    public function getValue()
    {
    	return $this->value;
    }

    /**
     * Get label
	 * @access public
     * 
	 * @return string
	 */
    public function getLabel(): string
    {
    	return $this->label;
    }

    /**
     * Get validators
	 * @access public
     * 
	 * @return array
	 */
    public function getValidators(): array
    {
        return $this->validators;
    }

    /**
     * Set name
	 * @access public
	 * @param string $name
     * 
	 * @return void
	 */
    public function setName(string $name): void
    {
    	$this->name = $name;
    }

    /**
     * Set required
	 * @access public
	 * @param bool $required
     * 
	 * @return void
	 */
    public function setRequired(bool $required): void
    {
        $this->required = $required;
    }

    /**
     * Set value
	 * @access public
	 * @param mixed $value
     * 
	 * @return void
	 */
    public function setValue($value): void
    {   	
    	$this->value = $value; 	
    }

    /**
     * Set label
	 * @access public
	 * @param string $label
     * 
	 * @return void
	 */
    public function setLabel(string $label): void
    {	
    	$this->label = $label;
	}
	
	/**
	 * Set validators
	 * @access public
	 * @param array $validators
	 * 
	 * @return void
	 */
	public function setValidators(array $validators): void
    {
        foreach ($validators as $validator) {

          if ($validator instanceof Validator && !in_array($validator, $this->validators)) {

			$this->validators[] = $validator;
			
          }
        }
	}

	/**
	 * Unset validators
	 * @access public
	 * 
	 * @return void
	 */
	public function unsetValidators(): void
	{
		$this->validators = [];
	}
}