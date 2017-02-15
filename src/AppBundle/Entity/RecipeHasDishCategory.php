<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecipeHasDishCategory
 *
 * @ORM\Table(name="recipe_has_dish_category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RecipeHasDishCategoryRepository")
 */
class RecipeHasDishCategory
{
    /**
     * @var int
     *
     * @ORM\Column(name="recipe_has_dish_category_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $recipeHasDishCategoryId;

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
     * @var \AppBundle\Entity\DishCategory
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DishCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dish_category_id", referencedColumnName="dish_category_id")
     * })
     */
    private $dishCategory;

    /**
     * Get recipeHasDishCategoryId
     *
     * @return int
     */
    public function getRecipeHasDishCategoryId()
    {
        return $this->recipeHasDishCategoryId;
    }

    /**
     * Get recipe
     *
     * @return int
     */
    public function getRecipe()
    {
        return $this->recipe;
    }

    /**
     * Set recipe
     *
     * @param int $recipe
     *
     * @return Recipe
     */
    public function setRecipe($recipe)
    {
        $this->recipe = $recipe;

        return $this;
    }

    /**
     * Get dishCategory
     *
     * @return int
     */
    public function getDishCategory()
    {
        return $this->dishCategory;
    }

    /**
     * Set dishCategory
     *
     * @param int $dishCategory
     *
     * @return dishCategory
     */
    public function setDishCategory($dishCategory)
    {
        $this->dishCategory = $dishCategory;

        return $this;
    }

}
