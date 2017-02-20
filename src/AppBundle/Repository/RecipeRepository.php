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
    public function lastVerifiedRecipes()
    {
        $query = $this->createQueryBuilder('h')
            ->join('h.author', 'd')
            ->where('d.isVerified = :isVerified')
            ->setParameter('isVerified', 1)
            ->addOrderBy('h.publishedDate', 'DESC')
            ->setMaxResults(3)
            ->getQuery();
        return $query->getResult();
    }

    public function orderByPublishedDate()
    {
        $query = $this->createQueryBuilder('h')
            ->join('h.author', 'd')
            ->select('d.username', 'd.image AS author_image', 'h.recipeId' ,'h.image', 'h.name', 'h.difficulty', 'h.cookingTime', 'h.preparationTime', 'h.servingSize')
            ->addOrderBy('h.publishedDate', 'DESC')
            ->getQuery();
        return $query->getResult();
    }

    public function getByCategoryId($categoriesIdList) {
        $query = $this->createQueryBuilder('h')
            ->innerJoin('h.dishCategories', 's')
            ->where('s.categoryId IN (:categoriesIdList)')
            ->setParameter('categoriesIdList', $categoriesIdList)
            ->getQuery();
        return $query->getResult();
    }

    public function getRecipesCountById($userId)
    {
        $query = $this->createQueryBuilder('h')
            ->select('COUNT(h.author) AS total_recipes')
            ->where('h.author = :userId')
            ->setParameter('userId', $userId)
            ->getQuery();
        return $query->getResult();
    }

    public function searchRecipeByName($searchString)
    {
        $query = $this->createQueryBuilder('r')
            ->where('r.name LIKE :name')
            ->setParameter('name', "%$searchString%")
            ->getQuery();

        return $query->getResult();
    }
}
