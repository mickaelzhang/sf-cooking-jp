<?php

namespace AppBundle\Repository;

/**
 * UserCommentOnRecipeRepository
 *
 */
class UserCommentOnRecipeRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Get and order by published date comments for a recipe
     *
     * @param int $recipeId
     * @return array
     */
    public function orderByPublishedAt($recipeId)
    {
        $query = $this->createQueryBuilder('h')
            ->join('h.user', 's')
            ->select('h.message', 'h.publishedAt', 's.username')
            ->where('h.recipe = :id')
            ->setParameter(':id', $recipeId)
            ->addOrderBy('h.publishedAt', 'DESC')
            ->getQuery();
        return $query->getResult();
    }
}
