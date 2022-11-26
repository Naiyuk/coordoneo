<?php

declare(strict_types=1);

/*
 * User class
 */

namespace App\Entity;

use Framework\Entity\Entity;

/**
 * User
 */
class User extends Entity
{
	/**
	 * 
	 * @var string
	 * @access private
	 */
	private $username;
	
	/**
	 * 
	 * @var string
	 * @access private
	 */
	private $email;

	/**
	 * 
	 * @var string
	 * @access private
	 */
	private $password;

	/**
	 * 
	 * @var string
	 * @access private
	 */
	private $role;
	
	/**
	 * 
	 * @var boolean
	 * @access private
	 */
    private $authenticated;
	
	/**
	 * Constructor
     * @access public
     * 
     * @return void
	 */
	public function __construct()
	{
		$this->authenticated = false;
    }

    /**
	 * Sleep method
     * @access public
     * 
     * @return array
	 */
	public function __sleep()
	{
		return ['id', 'role', 'authenticated'];
    }
    
    /**
     * Get username
     * @access public
     * 
     * @return string
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }
    
    /**
     * Get email
     * @access public
     * 
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Get password
     * @access public
     * 
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Get role
     * @access public
     * 
     * @return string
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * Is authenticated
     * @access public
     * 
     * @return bool
     */
    public function isAuthenticated(): bool
    {
        return $this->authenticated;
    }

    /**
     * Set username
     * @access public
     * @param string $username
     * 
     * @return User
     */
    public function setUsername($username): User
    {
        $this->username = htmlspecialchars($username);

        return $this;
    }

    /**
     * Set email
     * @access public
     * @param string $email
     * 
     * @return User
     */
    public function setEmail($email): User
    {
        $this->email = htmlspecialchars($email);

        return $this;
    }

    /**
     * Set password
     * @access public
     * @param string $password
     * 
     * @return User
     */
    public function setPassword($password): User
    {
        $this->password = htmlspecialchars($password);

        return $this;
    }

    /**
     * Set role
     * @access public
     * @param string $role
     * 
     * @return User
     */
    public function setRole($role): User
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Set authenticated
     * @access public
     * @param bool $authenticated
     * 
     * @return User
     */
    public function setAuthenticated(bool $authenticated): User
    {
        $this->authenticated = $authenticated;

        return $this;
    }
}