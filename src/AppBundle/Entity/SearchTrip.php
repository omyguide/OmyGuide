<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SearchTrip
 *
 * @ORM\Table(name="tp_search_trip")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SearchTripRepository")
 */
class SearchTrip
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
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Country")
    * @ORM\JoinColumn(nullable=false)
     */
    private $destination;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_begin", type="date", nullable=true)
     */
    private $dateBegin;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_end", type="date", nullable=true)
     */
    private $dateEnd;

    /**
     * @var string
     *
     * @ORM\Column(name="session_id", type="string", length=255)
     */
    private $sessionId;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateBegin.
     *
     * @param \DateTime|null $dateBegin
     *
     * @return SearchTrip
     */
    public function setDateBegin($dateBegin = null)
    {
        $this->dateBegin = $dateBegin;

        return $this;
    }

    /**
     * Get dateBegin.
     *
     * @return \DateTime|null
     */
    public function getDateBegin()
    {
        return $this->dateBegin;
    }

    /**
     * Set dateEnd.
     *
     * @param \DateTime|null $dateEnd
     *
     * @return SearchTrip
     */
    public function setDateEnd($dateEnd = null)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd.
     *
     * @return \DateTime|null
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set destination.
     *
     * @param \AppBundle\Entity\Country $destination
     *
     * @return SearchTrip
     */
    public function setDestination(\AppBundle\Entity\Country $destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination.
     *
     * @return \AppBundle\Entity\Country
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set sessionId.
     *
     * @param string $sessionId
     *
     * @return SearchTrip
     */
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;

        return $this;
    }

    /**
     * Get sessionId.
     *
     * @return string
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }
}
