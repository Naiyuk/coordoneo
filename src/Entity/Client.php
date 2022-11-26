<?php

declare(strict_types=1);

/**
 * Client class
 */

namespace App\Entity;

use Framework\Entity\Entity;

/**
 * Client
 */
class Client extends Entity
{
    /**
     * @var int
     */
    public const CLIENT_PER_PAGE = 10;

    /**
     * @var string
     * @access private
     */
    private $name;

    /**
     * @var string
     * @access private
     */
    private $firstName;

    /**
     * @var string
     * @access private
     */
    private $address;

    /**
     * @var string
     * @access private
     */
    private $postalCode;

    /**
     * @var string
     * @access private
     */
    private $city;

    /**
     * @var string
     * @access private
     */
    private $country;

    /**
     * @var string
     * @access private
     */
    private $email;

    /**
     * Get name
     * @access public
     * 
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Get first name
     * @access public
     * 
     * @return string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * Get address
     * @access public
     * 
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * Get postal code
     * @access public
     * 
     * @return string
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * Get city
     * @access public
     * 
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * Get country
     * @access public
     * 
     * @return string
     */
    public function getCountry(): ?string
    {
        return $this->country;
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
     * Set name
     * @access public
     * @param string $name
     * 
     * @return Client
     */
    public function setName($name): Client
    {
        $this->name = htmlspecialchars($name);

        return $this;
    }

    /**
     * Set first name
     * @access public
     * @param string $firstName
     * 
     * @return Client
     */
    public function setFirstName($firstName): Client
    {
        $this->firstName = htmlspecialchars($firstName);

        return $this;
    }

    /**
     * Set address
     * @access public
     * @param string $address
     * 
     * @return $this
     */
    public function setAddress($address): Client
    {
        $this->address = htmlspecialchars($address);

        return $this;
    }

    /**
     * Set postal code
     * @access public
     * @param string $postalCode
     * 
     * @return Client
     */
    public function setPostalCode($postalCode): Client
    {
        $this->postalCode = htmlspecialchars($postalCode);

        return $this;
    }

    /**
     * Set city
     * @access public
     * @param string $city
     * 
     * @return Client
     */
    public function setCity($city): Client
    {
        $this->city = htmlspecialchars($city);

        return $this;
    }

    /**
     * Set country
     * @access public
     * @param $country
     * 
     * @return Client
     */
    public function setCountry($country): Client
    {
        $this->country = htmlspecialchars($country);

        return $this;
    }

    /**
     * Set email
     * @access public
     * @param string $email
     * 
     * @return Client
     */
    public function setEmail($email): Client
    {
        $this->email = htmlspecialchars($email);

        return $this;
    }
}