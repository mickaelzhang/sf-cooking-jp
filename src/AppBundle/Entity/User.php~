<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="user", uniqueConstraints={
 *     @ORM\UniqueConstraint(name="username_UNIQUE", columns={"username"}),
 *     @ORM\UniqueConstraint(name="email_UNIQUE", columns={"email"})
 * })
 * @ORM\Entity
 */
class User implements UserInterface, \Serializable
{
    /**
     * Construct User
     */
    public function __construct()
    {
        $this->roles = array('ROLE_USER');
        $this->isVerified = false;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=45, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=45, nullable=false)
     */
    private $email;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=45, nullable=true)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=45, nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(type="json_array")
     */
    private $roles = array();

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\File(mimeTypes={ "image/png", "image/jpeg" })
     */

    private $image;

    /**
     * @var datetime
     *
     * @ORM\Column(name="registered_date", type="datetime")
     * @ORM\Version
     */
    private $registeredDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_verified",type="boolean")
     */
    private $isVerified;

    /**
     * @var datetime
     *
     * @ORM\Column(name="verified_since", type="datetime", nullable=true)
     */
    private $verifiedSince;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="verified_by", referencedColumnName="user_id", nullable=true)
     * })
     */
    private $verifiedBy;


    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    /**
     * Get roles
     *
     * @return array
     */
    public function getRoles()
    {
        $roles = $this->roles;

        return array_unique($roles);
    }

    /**
     * Set roles
     *
     * @return User
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set image
     *
     * @return User
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get registeredDate
     *
     * @return boolean
     */
    public function getRegisteredDate()
    {
        return $this->registeredDate;
    }

    /**
     * Set registeredDate
     *
     * @return User
     */
    public function setRegisteredDate($registeredDate)
    {
        $this->registeredDate = $registeredDate;

        return $this;
    }


    /**
     * Get isVerified
     *
     * @return boolean
     */
    public function getIsVerified()
    {
        return $this->isVerified;
    }

    /**
     * Set isVerified
     *
     * @return User
     */
    public function setIsVerified($isVerified)
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * Get verifiedSince
     *
     * @return boolean
     */
    public function getVerifiedSince()
    {
        return $this->verifiedSince;
    }

    /**
     * Set verifiedSince
     *
     * @return User
     */
    public function setVerifiedSince($verifiedSince)
    {
        $this->verifiedSince = $verifiedSince;

        return $this;
    }

    /**
     * Get verifiedBy
     *
     * @return boolean
     */
    public function getVerifiedBy()
    {
        return $this->verifiedBy;
    }

    /**
     * Set verifiedBy
     *
     * @return User
     */
    public function setVerifiedBy($verifiedBy)
    {
        $this->verifiedBy = $verifiedBy;

        return $this;
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->userId,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->userId,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }
}
