<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HasRated
 *
 * @ORM\Table(name="has_rated", indexes={
 *     @ORM\Index(name="has_rated_user_idx", columns={"user_id"}),
 *     @ORM\Index(name="has_rated_recipe_idx", columns={"recipe_id"})
 * })
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HasRatedRepository")
 */
class HasRated
{
    /**
     * @var integer
     *
     * @ORM\Column(name="has_rated_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $hasRatedId;

    /**
     * @var integer
     *
     * @ORM\Column(name="rating", type="integer", length=1, nullable=false)
     */
    private $rating;

    /**
     * @var datetime
     *
     * @ORM\Column(name="rated_at", type="datetime", length=100, nullable=false)
     */
    private $ratedAt;

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
     * Get hasRatedId
     *
     * @return integer
     */
    public function getHasRatedId()
    {
        return $this->hasRatedId;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     *
     * @return HasRated
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set ratedAt
     *
     * @param \DateTime $ratedAt
     *
     * @return HasRated
     */
    public function setRatedAt($ratedAt)
    {
        $this->ratedAt = $ratedAt;

        return $this;
    }

    /**
     * Get ratedAt
     *
     * @return \DateTime
     */
    public function getRatedAt()
    {
        return $this->ratedAt;
    }

    /**
     * Set recipe
     *
     * @param \AppBundle\Entity\Recipe $recipe
     *
     * @return HasRated
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
     * @return HasRated
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
}
