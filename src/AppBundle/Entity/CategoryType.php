<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoryType
 *
 * @ORM\Table(name="category_type", uniqueConstraints={@ORM\UniqueConstraint(name="slug_UNIQUE", columns={"slug"}), @ORM\UniqueConstraint(name="name_UNIQUE", columns={"name"})})
 * @ORM\Entity
 */
class CategoryType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="category_type_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $categoryTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=45, nullable=true)
     */
    private $slug;



    /**
     * Get categoryTypeId
     *
     * @return integer
     */
    public function getCategoryTypeId()
    {
        return $this->categoryTypeId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return CategoryType
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

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return CategoryType
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
