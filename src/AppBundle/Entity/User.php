<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="tp_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Assert\NotBlank(message="Please enter your last name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The last name is too short.",
     *     maxMessage="The last name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Assert\NotBlank(message="Please enter your first name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The first name is too short.",
     *     maxMessage="The first name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="profile_picture", type="string", length=255, nullable=true)
     *
     */
    protected $profile_picture;

    /** @ORM\Column(name="facebook_id", type="string", length=255, nullable=true) */
    protected $facebook_id;

    /** @ORM\Column(name="facebook_access_token", type="string", length=255, nullable=true) */
    protected $facebook_access_token;

    /** @ORM\Column(name="googleplus_id", type="string", length=255, nullable=true) */
    protected $google_id;

    /** @ORM\Column(name="googleplus_access_token", type="string", length=255, nullable=true) */
    protected $google_access_token;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }


    /**
     * Set lastname.
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname.
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set firstname.
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname.
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set facebookId.
     *
     * @param string|null $facebookId
     *
     * @return User
     */
    public function setFacebookId($facebookId = null)
    {
        $this->facebook_id = $facebookId;

        return $this;
    }

    /**
     * Get facebookId.
     *
     * @return string|null
     */
    public function getFacebookId()
    {
        return $this->facebook_id;
    }

    /**
     * Set googleId.
     *
     * @param string|null $googleId
     *
     * @return User
     */
    public function setGoogleId($googleId = null)
    {
        $this->google_id = $googleId;

        return $this;
    }

    /**
     * Get googleId.
     *
     * @return string|null
     */
    public function getGoogleId()
    {
        return $this->google_id;
    }

    /**
     * Set facebookAccessToken.
     *
     * @param string|null $facebookAccessToken
     *
     * @return User
     */
    public function setFacebookAccessToken($facebookAccessToken = null)
    {
        $this->facebook_access_token = $facebookAccessToken;

        return $this;
    }

    /**
     * Get facebookAccessToken.
     *
     * @return string|null
     */
    public function getFacebookAccessToken()
    {
        return $this->facebook_access_token;
    }

    /**
     * Set googleAccessToken.
     *
     * @param string|null $googleAccessToken
     *
     * @return User
     */
    public function setGoogleAccessToken($googleAccessToken = null)
    {
        $this->google_access_token = $googleAccessToken;

        return $this;
    }

    /**
     * Get googleAccessToken.
     *
     * @return string|null
     */
    public function getGoogleAccessToken()
    {
        return $this->google_access_token;
    }

    /**
     * Set profilePicture.
     *
     * @param string|null $profilePicture
     *
     * @return User
     */
    public function setProfilePicture($profilePicture = null)
    {
        $this->profile_picture = $profilePicture;

        return $this;
    }

    /**
     * Get profilePicture.
     *
     * @return string|null
     */
    public function getProfilePicture()
    {
        return $this->profile_picture;
    }
}
