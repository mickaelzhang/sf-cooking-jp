<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserFavoriteRecipe
 *
 * @ORM\Table(name="user_favorite_recipe", indexes={
 *     @ORM\Index(name="user_favorite_recipe_user_idx", columns={"user_id"}),
 *     @ORM\Index(name="user_favorite_recipe_recipe_idx", columns={"recipe_id"})
 * })
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserFavoriteRecipeRepository")
 */
class UserFavoriteRecipe
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_favorite_recipe_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userFavoriteRecipeId;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * })
     */
    private $user;

    /**
     * @var \AppBundle\Entity\Recipe
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Recipe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="recipe_id", referencedColumnName="recipe_id")
     * })
     */
    private $recipe;

    /**
     * @var datetime
     *
     * @ORM\Column(name="added_date", type="datetime")
     * @ORM\Version
     */
    private $addedDate;

    function __construct()
    {
        $this->addedDate = new \DateTime('now');
    }


    /**
     * Get isFavoriteId
     *
     * @return integer
     */
    public function getIsFavoriteId()
    {
        return $this->userFavoriteRecipeId;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return UserFavoriteRecipe
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set recipe
     *
     * @param \AppBundle\Entity\Recipe $recipe
     *
     * @return UserFavoriteRecipe
     */
    public function setRecipe(\AppBundle\Entity\Recipe $recipe = null)
    {
        $this->recipe = $recipe;

        return $this;
    }

    /**
     * Get recipe
     *
     * @return \AppBundle\Entity\Recipe
     */
    public function getRecipe()
    {
        return $this->recipe;
    }

    /**
     * Get userFavoriteRecipeId
     *
     * @return integer
     */
    public function getUserFavoriteRecipeId()
    {
        return $this->userFavoriteRecipeId;
    }

    /**
     * Get addedDate
     *
     * @return boolean
     */
    public function getAddedDate()
    {
        return $this->addedDate;
    }

    /**
     * Set addedDate
     *
     * @return UserFavoriteRecipe
     */
    public function setAddedDate($addedDate)
    {
        $this->addedDate = $addedDate;

        return $this;
    }
}
