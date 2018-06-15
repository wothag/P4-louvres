<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TicketRepository")
 */
class Ticket
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $ticket_ref;

    /**
     * @ORM\Column(type="smallint")
     */
    private $ticket_type;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_customer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Order", inversedBy="id_tickets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $order_ref;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="id_customer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_customers;

    public function getId()
    {
        return $this->id;
    }

    public function getTicketRef(): ?int
    {
        return $this->ticket_ref;
    }

    public function setTicketRef(int $ticket_ref): self
    {
        $this->ticket_ref = $ticket_ref;

        return $this;
    }

    public function getTicketType(): ?int
    {
        return $this->ticket_type;
    }

    public function setTicketType(int $ticket_type): self
    {
        $this->ticket_type = $ticket_type;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getIdCustomer(): ?int
    {
        return $this->id_customer;
    }

    public function setIdCustomer(int $id_customer): self
    {
        $this->id_customer = $id_customer;

        return $this;
    }

    public function getOrderRef(): ?Order
    {
        return $this->order_ref;
    }

    public function setOrderRef(?Order $order_ref): self
    {
        $this->order_ref = $order_ref;

        return $this;
    }

    public function getIdCustomers(): ?Customer
    {
        return $this->id_customers;
    }

    public function setIdCustomers(?Customer $id_customers): self
    {
        $this->id_customers = $id_customers;

        return $this;
    }
}
