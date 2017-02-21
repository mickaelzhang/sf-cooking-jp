<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserFollow
 *
 * @ORM\Table(name="user_follow")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserFollowRepository")
 */
class UserFollow
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="follower_id", referencedColumnName="user_id")
     * })
     */
    private $follower;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_followed_id", referencedColumnName="user_id")
     * })
     */
    private $userFollowed;

    /**
     * @var datetime
     *
     * @ORM\Column(name="followed_date", type="datetime")
     * @ORM\Version
     */
    private $followedDate;

    function __construct()
    {
        $this->followedDate = new \DateTime('now');
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set follower
     *
     * @param \AppBundle\Entity\User $follower
     *
     * @return UserFollow
     */
    public function setFollower(\AppBundle\Entity\User $follower = null)
    {
        $this->follower = $follower;

        return $this;
    }

    /**
     * Get follower
     *
     * @return \AppBundle\Entity\User
     */
    public function getFollower()
    {
        return $this->follower;
    }

    /**
     * Set userFollowed
     *
     * @param \AppBundle\Entity\User $userFollowed
     *
     * @return UserFollow
     */
    public function setUserFollowed(\AppBundle\Entity\User $userFollowed = null)
    {
        $this->userFollowed = $userFollowed;

        return $this;
    }

    /**
     * Get userFollowed
     *
     * @return \AppBundle\Entity\User
     */
    public function getUserFollowed()
    {
        return $this->userFollowed;
    }

    /**
     * Get followedDate
     *
     * @return \DateTime
     */
    public function getFollowedDate()
    {
        return $this->followedDate;
    }

    /**
     * Set followedDate
     *
     * @return UserFollow
     */
    public function setFollowedDate($followedDate)
    {
        $this->followedDate = $followedDate;

        return $this;
    }
}
