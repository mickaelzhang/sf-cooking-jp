<?php

namespace AppBundle\Repository;

/**
 * UserCommentOnRecipeRepository
 *
 */
class UserCommentOnRecipeRepository extends \Doctrine\ORM\EntityRepository
{
    public function orderByPublishedAt($recipeId)
    {
        $query = $this->createQueryBuilder('h')
            ->where('h.recipe = :id')
            ->setParameter(':id', $recipeId)
            ->addOrderBy('h.publishedAt', 'DESC')
            ->getQuery();
        return $query->getResult();
    }
}
