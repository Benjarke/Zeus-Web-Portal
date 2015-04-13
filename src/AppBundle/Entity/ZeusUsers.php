<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZeusUsers
 */
class ZeusUsers
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $country;
	   
	/**
     * @var string
     */
    private $notification_id;

	/**
     * @var string
     */
    private $action;

	/**
     * @var string
     */
    private $lat;

	/**
     * @var string
     */
    private $lng;

	/**
     * @var string
     */
    private $acc;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return ZeusUsers
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
     * Set password
     *
     * @param string $password
     * @return ZeusUsers
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
     * Set email
     *
     * @param string $email
     * @return ZeusUsers
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
     * Set country
     *
     * @param string $country
     * @return ZeusUsers
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    } 
	
	/**
     * Set notification_id
     *
     * @param string $notification_id
     * @return ZeusUsers
     */
    public function setNotificationID($notification_id)
    {
        $this->notification_id = $notification_id;

        return $this;
    }

    /**
     * Get notification_id
     *
     * @return string 
     */
    public function getNotificationID()
    {
        return $this->notification_id;
    }
	
	/**
     * Set action
     *
     * @param string $action
     * @return ZeusUsers
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string 
     */
    public function getAction()
    {
        return $this->action;
    }
	/**
     * Set lat
     *
     * @param string $lat
     * @return ZeusUsers
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return string 
     */
    public function getLat()
    {
        return $this->Lat;
    }
	/**
     * Set lng
     *
     * @param string $lng
     * @return ZeusUsers
     */
    public function setLng($lng)
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * Get lng
     *
     * @return string 
     */
    public function getLng()
    {
        return $this->lng;
    }
	/**
     * Set acc
     *
     * @param string $acc
     * @return ZeusUsers
     */
    public function setAcc($acc)
    {
        $this->acc = $acc;

        return $this;
    }

    /**
     * Get acc
     *
     * @return string 
     */
    public function getAcc()
    {
        return $this->acc;
    }
}