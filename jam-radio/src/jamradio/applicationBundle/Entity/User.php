<?php

namespace jamradio\applicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="jamradio\applicationBundle\Repository\UserRepository")
 */
class User
{
      /**
     * @ORM\ManyToMany(targetEntity="jamradio\applicationBundle\Entity\Instrument", cascade={"persist"})
     */
    private $instruments;
    /**
   * @ORM\ManyToMany(targetEntity="jamradio\applicationBundle\Entity\Style", cascade={"persist"})
   */
    private $styles;
    /**
   * @ORM\ManyToMany(targetEntity="jamradio\applicationBundle\Entity\Band", cascade={"persist"})
   */
    private $bands;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;
    /**
     * @var string
     *
     * @ORM\Column(name="email",type="string", length=255)
     */
    private $email;
    /**
     * @var string
     *
     * @ORM\Column(name="password",type="string", length=255)
     */
    private $password;
    /**
     * @var string
     *
     * @ORM\Column(name="firstname",type="string", length=255,nullable=true)
     */
    private $firstname;

    /**
     * @var text
     *
     * @ORM\Column(name="description",type="text",nullable=true)
     */
    private $description;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="age",type="datetime",nullable=true)
     */
    private $age;

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
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set firstname
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
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set age
     *
     * @param \DateTime $age
     *
     * @return User
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return \DateTime
     */
    public function getAge()
    {
        return $this->age;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->instruments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->styles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->bands = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Add instrument
     *
     * @param \jamradio\applicationBundle\Entity\Instrument $instrument
     *
     * @return User
     */
    public function addInstrument(\jamradio\applicationBundle\Entity\Instrument $instrument)
    {
        $this->instruments[] = $instrument;

        return $this;
    }

    /**
     * Remove instrument
     *
     * @param \jamradio\applicationBundle\Entity\Instrument $instrument
     */
    public function removeInstrument(\jamradio\applicationBundle\Entity\Instrument $instrument)
    {
        $this->instruments->removeElement($instrument);
    }

    /**
     * Get instruments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInstruments()
    {
        return $this->instruments;
    }

    /**
     * Add style
     *
     * @param \jamradio\applicationBundle\Entity\Style $style
     *
     * @return User
     */
    public function addStyle(\jamradio\applicationBundle\Entity\Style $style)
    {
        $this->styles[] = $style;

        return $this;
    }

    /**
     * Remove style
     *
     * @param \jamradio\applicationBundle\Entity\Style $style
     */
    public function removeStyle(\jamradio\applicationBundle\Entity\Style $style)
    {
        $this->styles->removeElement($style);
    }

    /**
     * Get styles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStyles()
    {
        return $this->styles;
    }

    /**
     * Add band
     *
     * @param \jamradio\applicationBundle\Entity\Band $band
     *
     * @return User
     */
    public function addBand(\jamradio\applicationBundle\Entity\Band $band)
    {
        $this->bands[] = $band;

        return $this;
    }

    /**
     * Remove band
     *
     * @param \jamradio\applicationBundle\Entity\Band $band
     */
    public function removeBand(\jamradio\applicationBundle\Entity\Band $band)
    {
        $this->bands->removeElement($band);
    }

    /**
     * Get bands
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBands()
    {
        return $this->bands;
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
     * Set description
     *
     * @param string $description
     *
     * @return User
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
