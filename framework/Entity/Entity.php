<?php

declare(strict_types=1);

/**
 * Entity class
 */

namespace Framework\Entity;

/**
 * Entity
 * @abstract
 */
abstract class Entity
{
    /**
     * @var int
     * @access protected
     */
    protected $id;

    /**
     * Get id
     * @access public
     * 
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set id
     * @access public
     * @param int $id
     * 
     * @return Entity
     */
    public function setId(int $id): Entity
    {
        $this->id = $id;

        return $this;
    }
}