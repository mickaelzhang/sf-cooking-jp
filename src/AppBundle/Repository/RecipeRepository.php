<?php

namespace AppBundle\Repository;

/**
 * RecipeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RecipeRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Get 3 last verified recipes
     *
     * @return array
     */
    public function lastVerifiedRecipes()
    {
        $query = $this->createQueryBuilder('h')
            ->select('h.name', 'h.recipeId', 'h.image')
            ->join('h.author', 'd')
            ->where('d.isVerified = :isVerified')
            ->setParameter('isVerified', 1)
            ->addOrderBy('h.publishedDate', 'DESC')
            ->setMaxResults(3)
            ->getQuery();
        return $query->getResult();
    }

    /**
     * Get all recipes order by published date
     *
     * @return array
     */
    public function orderByPublishedDate()
    {
        $query = $this->createQueryBuilder('h')
            ->join('h.author', 'd')
            ->select('d.username', 'd.image AS author_image', 'h.recipeId' ,'h.image', 'h.name', 'h.difficulty', 'h.cookingTime', 'h.preparationTime', 'h.servingSize')
            ->addOrderBy('h.publishedDate', 'DESC')
            ->getQuery();
        return $query->getResult();
    }

    /**
     * Get all recipes for a list of categories
     *
     * @param array $categoriesIdList
     * @return array
     */
    public function getByCategoryId($categoriesIdList) {
        $query = $this->createQueryBuilder('h')
            ->join('h.author', 'u')
            ->select('h.image', 'h.name', 'h.recipeId', 'u.username')
            ->join('h.dishCategories', 's')
            ->where('s.categoryId IN (:categoriesIdList)')
            ->setParameter('categoriesIdList', $categoriesIdList)
            ->getQuery();
        return $query->getResult();
    }

    /**
     * Get number of recipes of an user
     *
     * @param int $userId
     * @return array
     */
    public function getRecipesCountById($userId)
    {
        $query = $this->createQueryBuilder('h')
            ->select('COUNT(h.author) AS total_recipes')
            ->where('h.author = :userId')
            ->setParameter('userId', $userId)
            ->getQuery();
        return $query->getResult();
    }

    /**
     * Search for related
     *
     * @param String $searchString
     * @return array
     */
    public function searchRecipeByName($searchString)
    {
        $query = $this->createQueryBuilder('r')
            ->where('r.name LIKE :name')
            ->setParameter('name', "%$searchString%")
            ->getQuery();

        return $query->getResult();
    }
}
