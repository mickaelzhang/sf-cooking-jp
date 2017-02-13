<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CookingTool
 *
 * @ORM\Table(name="cooking_tool")
 * @ORM\Entity
 */
class CookingTool
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cooking_tool_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cookingToolId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;


    /**
     * Get cookingToolId
     *
     * @return integer
     */
    public function getCookingToolId()
    {
        return $this->cookingToolId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return CookingTool
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
