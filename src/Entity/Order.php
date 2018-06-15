<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 */
class Order
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_order;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_visit;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_tickets;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $visitor;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ticket", mappedBy="order_ref")
     */
    private $id_tickets;

    public function __construct()
    {
        $this->id_tickets = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getDateOrder(): ?\DateTimeInterface
    {
        return $this->date_order;
    }

    public function setDateOrder(\DateTimeInterface $date_order): self
    {
        $this->date_order = $date_order;

        return $this;
    }

    public function getDateVisit(): ?\DateTimeInterface
    {
        return $this->date_visit;
    }

    public function setDateVisit(\DateTimeInterface $date_visit): self
    {
        $this->date_visit = $date_visit;

        return $this;
    }

    public function getNbTickets(): ?int
    {
        return $this->nb_tickets;
    }

    public function setNbTickets(int $nb_tickets): self
    {
        $this->nb_tickets = $nb_tickets;

        return $this;
    }

    public function getVisitor(): ?string
    {
        return $this->visitor;
    }

    public function setVisitor(string $visitor): self
    {
        $this->visitor = $visitor;

        return $this;
    }

    /**
     * @return Collection|Ticket[]
     */
    public function getIdTickets(): Collection
    {
        return $this->id_tickets;
    }

    public function addIdTicket(Ticket $idTicket): self
    {
        if (!$this->id_tickets->contains($idTicket)) {
            $this->id_tickets[] = $idTicket;
            $idTicket->setOrderRef($this);
        }

        return $this;
    }

    public function removeIdTicket(Ticket $idTicket): self
    {
        if ($this->id_tickets->contains($idTicket)) {
            $this->id_tickets->removeElement($idTicket);
            // set the owning side to null (unless already changed)
            if ($idTicket->getOrderRef() === $this) {
                $idTicket->setOrderRef(null);
            }
        }

        return $this;
    }
}
