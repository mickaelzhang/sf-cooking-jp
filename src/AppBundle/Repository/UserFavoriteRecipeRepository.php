<?php

namespace AppBundle\Repository;

/**
 * UserFavoriteRecipeRepository
 *
 */
class UserFavoriteRecipeRepository extends \Doctrine\ORM\EntityRepository
{
    public function findUserFavoriteByRecipe()
    {
    }

    public function mostPopular($maxResults)
    {
        $date = new \DateTime();
        $date->modify('-7 days');

        $query = $this->createQueryBuilder('h')
            ->where('h.addedDate > :date')
            ->setParameter(':date', $date)
            ->join('h.recipe', 't')
            ->join('t.author', 'u')
            ->select('COUNT(h.recipe) AS total_favorites', 't.name','t.publishedDate', 't.image', 't.difficulty', 't.cookingTime', 't.preparationTime', 'u.username', 'u.image AS author_image')
            ->groupBy('h.recipe')
            ->orderBy('total_favorites','DESC')
            ->getQuery();

        if ($maxResults != 0) {
            $query->setMaxResults($maxResults);
        }

        return $query->getResult();
    }
}
