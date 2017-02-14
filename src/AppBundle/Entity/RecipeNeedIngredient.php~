<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecipeNeedIngredient
 *
 * @ORM\Table(name="recipe_need_ingredient", indexes={@ORM\Index(name="recipe_need_ingredient_recipe_idx", columns={"recipe_id"}), @ORM\Index(name="recipe_need_ingredient_ingredient_idx", columns={"ingredient_id"})})
 * @ORM\Entity
 */
class RecipeNeedIngredient
{
    /**
     * @var integer
     *
     * @ORM\Column(name="recipe_need_ingredient_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $recipeNeedIngredientId;

    /**
     * @var \AppBundle\Entity\Ingredient
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ingredient")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ingredient_id", referencedColumnName="ingredient_id")
     * })
     */
    private $ingredient;

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
     * Get recipeNeedIngredientId
     *
     * @return integer
     */
    public function getRecipeNeedIngredientId()
    {
        return $this->recipeNeedIngredientId;
    }

    /**
     * Set ingredient
     *
     * @param \AppBundle\Entity\Ingredient $ingredient
     *
     * @return RecipeNeedIngredient
     */
    public function setIngredient(\AppBundle\Entity\Ingredient $ingredient = null)
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    /**
     * Get ingredient
     *
     * @return \AppBundle\Entity\Ingredient
     */
    public function getIngredient()
    {
        return $this->ingredient;
    }

    /**
     * Set recipe
     *
     * @param \AppBundle\Entity\Recipe $recipe
     *
     * @return RecipeNeedIngredient
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
}
