<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecipeNeedTool
 *
 * @ORM\Table(name="recipe_need_tool", indexes={@ORM\Index(name="recipe_need_tool_recipe_idx", columns={"recipe_id"}), @ORM\Index(name="recipe_need_tool_cooking_tool_idx", columns={"cooking_tool_id"})})
 * @ORM\Entity
 */
class RecipeNeedTool
{
    /**
     * @var integer
     *
     * @ORM\Column(name="recipe_need_tool_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $recipeNeedToolId;

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
     * @var \AppBundle\Entity\CookingTool
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CookingTool")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cooking_tool_id", referencedColumnName="cooking_tool_id")
     * })
     */
    private $cookingTool;



    /**
     * Get recipeNeedToolId
     *
     * @return integer
     */
    public function getRecipeNeedToolId()
    {
        return $this->recipeNeedToolId;
    }

    /**
     * Set recipe
     *
     * @param \AppBundle\Entity\Recipe $recipe
     *
     * @return RecipeNeedTool
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
     * Set cookingTool
     *
     * @param \AppBundle\Entity\CookingTool $cookingTool
     *
     * @return RecipeNeedTool
     */
    public function setCookingTool(\AppBundle\Entity\CookingTool $cookingTool = null)
    {
        $this->cookingTool = $cookingTool;

        return $this;
    }

    /**
     * Get cookingTool
     *
     * @return \AppBundle\Entity\CookingTool
     */
    public function getCookingTool()
    {
        return $this->cookingTool;
    }
}
