<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Recipe
 *
 * @ORM\Table(name="recipe", indexes={
 *     @ORM\Index(name="user_id_idx", columns={"author_id"})
 * })
 * @ORM\Entity
 */
class Recipe
{
    /**
     * @var integer
     *
     * @ORM\Column(name="recipe_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $recipeId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=60, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=250, nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="serving_size", type="integer", precision=3, scale=0, nullable=true)
     */
    private $servingSize;

    /**
     * @var integer
     *
     * @ORM\Column(name="difficulty", type="integer", precision=1, scale=0, nullable=true)
     * @Assert\Range(
     *     min = 0,
     *     max = 5
     * )
     */
    private $difficulty;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="preparation_time", type="time", nullable=true)
     */
    private $preparationTime;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="author_id", referencedColumnName="user_id")
     * })
     */
    private $author;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="cooking_time", type="time")
     */
    private $cookingTime;

    /**
     * @var string
     *
     * @ORM\Column(name="instructions", type="string")
     */
    private $instructions;

    /**
     * @ORM\Column(name="image", type="string", nullable=true)
     *
     * @Assert\File(mimeTypes={ "image/png", "image/jpeg" })
     */

    private $image;

    /**
     * Get recipeId
     *
     * @return integer
     */
    public function getRecipeId()
    {
        return $this->recipeId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Recipe
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
     * @return Recipe
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

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Recipe
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set difficulty
     *
     * @param float $difficulty
     *
     * @return Recipe
     */
    public function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    /**
     * Get difficulty
     *
     * @return float
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * Set preparationTime
     *
     * @param \DateTime $preparationTime
     *
     * @return Recipe
     */
    public function setPreparationTime($preparationTime)
    {
        $this->preparationTime = $preparationTime;

        return $this;
    }

    /**
     * Get preparationTime
     *
     * @return \DateTime
     */
    public function getPreparationTime()
    {
        return $this->preparationTime;
    }

    /**
     * Set author
     *
     * @param \AppBundle\Entity\User $author
     *
     * @return Recipe
     */
    public function setAuthor(\AppBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \AppBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set servingSize
     *
     * @param integer $servingSize
     *
     * @return Recipe
     */
    public function setServingSize($servingSize)
    {
        $this->servingSize = $servingSize;

        return $this;
    }

    /**
     * Get servingSize
     *
     * @return integer
     */
    public function getServingSize()
    {
        return $this->servingSize;
    }

    /**
     * Set cookingTime
     *
     * @param integer $cookingTime
     *
     * @return Recipe
     */
    public function setCookingTime($cookingTime)
    {
        $this->cookingTime = $cookingTime;

        return $this;
    }

    /**
     * Get cookingTime
     *
     * @return datetime
     */
    public function getCookingTime()
    {
        return $this->cookingTime;
    }

    /**
     * Set instructions
     *
     * @param integer $instructions
     *
     * @return Recipe
     */
    public function setInstructions($instructions)
    {
        $this->instructions = $instructions;

        return $this;
    }

    /**
     * Get instructions
     *
     * @return datetime
     */
    public function getInstructions()
    {
        return $this->instructions;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set image
     *
     * @return User
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Check if the given User is the author of the Recipe
     *
     * @param User|null $user
     * @return bool
     */
    public function isAuthor(User $user = null)
    {
        return $user && $user == $this->getAuthor();
    }
}
