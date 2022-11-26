<?php

declare(strict_types=1);

/**
 * Route class
 */

namespace Framework\Routing;

/**
 * Route
 */
class Route
{
    /**
	 * 
	 * @var string
	 * @access private
	 */
    private $url;
    
    /**
	 * @var string
	 * @access private
	 */
    private $controller;
    
  	/**
	 * @var string
	 * @access private
	 */
    private $action;
    
    /**
     * @var string
     * @access private
     */
    private $name;

    /**
     * @var string
     * @access private
     */
    private $mask;
	
	/**
	 * 
	 * @var array
	 * @access private
	 */
	private $varsNames;

	/**
	 * @var array
	 * @access private
	 */
	private $vars = [];

	/**
     * Has vars
	 * @access public
     * 
	 * @return bool
	 */
	public function hasVars(): bool
	{
		return !empty($this->varsNames);
	}
	
	/**
	 * Verify url match with route url
	 * @access public
	 * @param string $url
     * 
	 * @return mixed array | boolean
	 */
	public function match($url)
	{
		if (preg_match('`^'.$this->url.'$`', $url, $matches)) {

			return $matches;

		} else {

			return false;
		}
    }
    
    /**
     * Set url
	 * @access public
	 * @param string $url
     * 
	 * @return void
	 */
	public function setUrl($url): void
	{	
		$this->url = $url;
    }
    
    /**
     * Set controller
	 * @access public
	 * @param string $controller
     * 
	 * @return void
	 */
	public function setController($controller): void
	{
		$this->controller = $controller;
    }
    	
	/**
     * Set action
	 * @access public
	 * @param string $action
     * 
	 * @return void
	 */
	public function setAction($action): void
	{
		$this->action = $action;
    }
    
    /**
     * Set name
	 * @access public
	 * @param string $name
     * 
	 * @return void
	 */
	public function setName($name): void
	{
		$this->name = $name;
    }
    
    /**
     * Set mask
	 * @access public
	 * @param string $mask
     * 
	 * @return void
	 */
	public function setMask($mask): void
	{
		$this->mask = $mask;
	}
	
	/**
     * Set vars names
	 * @access public
	 * @param mixed array | null $varsNames
     * 
	 * @return void
	 */
	public function setVarsNames($varsNames): void
	{
		$this->varsNames = $varsNames;
	}
	
	/**
     * Set vars
	 * @access public
	 * @param mixed array | null $vars
     * 
	 * @return void
	 */
	public function setVars($vars): void
	{
		$this->vars = $vars;
	}
    
    /**
     * Get url
     * @access public
     * 
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Get controller
     * @access public
     * 
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * Get action
     * @access public
     * 
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

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
     * Get mask
     * @access public
     * 
     * @return string
     */
    public function getMask(): ?string
    {
        return $this->mask;
    }

    /**
     * Get vars names
     * @access public
     * 
     * @return array
     */
    public function getVarsNames(): ?array
    {
        return $this->varsNames;
    }

    /**
     * Get vars
     * @access public
     * 
     * @return array
     */
    public function getVars(): ?array
    {
        return $this->vars;
    }
}