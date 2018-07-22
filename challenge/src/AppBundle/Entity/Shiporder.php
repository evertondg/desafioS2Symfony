<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shiporder
 *
 * @ORM\Table(name="shiporder")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ShiporderRepository")
 */
class Shiporder
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
     * @var int
     *
     * @ORM\Column(name="orderid", type="integer")
     */
    private $orderid;

    /**
     * @var int
     *
     * @ORM\Column(name="orderperson", type="integer")
     */
    private $orderperson;


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
     * Set orderid
     *
     * @param integer $orderid
     *
     * @return Shiporder
     */
    public function setOrderid($orderid)
    {
        $this->orderid = $orderid;

        return $this;
    }

    /**
     * Get orderid
     *
     * @return int
     */
    public function getOrderid()
    {
        return $this->orderid;
    }

    /**
     * Set orderperson
     *
     * @param integer $orderperson
     *
     * @return Shiporder
     */
    public function setOrderperson($orderperson)
    {
        $this->orderperson = $orderperson;

        return $this;
    }

    /**
     * Get orderperson
     *
     * @return int
     */
    public function getOrderperson()
    {
        return $this->orderperson;
    }
}

