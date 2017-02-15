<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserCommentOnRecipe
 *
 * @ORM\Table(name="user_comment_on_recipe", indexes={
 *     @ORM\Index(name="user_comment_on_recipe_user_idx", columns={"user_id"}),
 *     @ORM\Index(name="user_comment_on_recipe_idx", columns={"recipe_id"})
 * })
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserCommentOnRecipeRepository")
 */
class UserCommentOnRecipe
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_comment_on_recipe_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userCommentOnRecipeId;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=100, nullable=false)
     */
    private $message;

    /**
     * @var datetime
     *
     * @ORM\Column(name="published_at", type="datetime", length=100, nullable=false)
     */
    private $publishedAt;

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
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * })
     */
    private $user;



    /**
     * Get hasCommentedId
     *
     * @return integer
     */
    public function getHasCommentedId()
    {
        return $this->userCommentOnRecipeId;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return UserCommentOnRecipe
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set publishedAt
     *
     * @param datetime $publishedAt
     *
     * @return UserCommentOnRecipe
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return datetime
     */
    public function getPublishedAt()
    {
        return $this->message;
    }

    /**
     * Set recipe
     *
     * @param \AppBundle\Entity\Recipe $recipe
     *
     * @return UserCommentOnRecipe
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
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return UserCommentOnRecipe
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
     * Get userCommentOnRecipeId
     *
     * @return integer
     */
    public function getUserCommentOnRecipeId()
    {
        return $this->userCommentOnRecipeId;
    }
}
