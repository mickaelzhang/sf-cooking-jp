<?php

namespace AppBundle\Repository;

/**
 * UserFollowRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserFollowRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Get all follows since 7 days and sort them by group of users
     *
     * @return
     */
    public function getPopularsProfiles($maxResults)
    {
        $date = new \DateTime();
        $date->modify('-7 days');

        $query = $this->createQueryBuilder('h')
            ->where('h.followedDate > :date')
            ->setParameter(':date', $date)
            ->join('h.userFollowed', 'f')
            ->select('COUNT(h.userFollowed) AS total_follows', 'f.username')
            ->groupBy('h.userFollowed')
            ->orderBy('total_follows','DESC')
            ->getQuery();

        if ($maxResults != 0) {
            $query->setMaxResults($maxResults);
        }

        $query;

        return $query->getResult();
    }
}
