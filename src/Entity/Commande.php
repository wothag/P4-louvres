<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="datetime")
     */
    private $date_visit;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_tickets;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ticket", mappedBy="commande")
     */
    private $id_tickets;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    public function __construct()
    {
        $this->id_tickets = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
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

    /**
     * @return Collection|ticket[]
     */
    public function getIdTickets(): Collection
    {
        return $this->id_tickets;
    }

    public function addIdTicket(ticket $idTicket): self
    {
        if (!$this->id_tickets->contains($idTicket)) {
            $this->id_tickets[] = $idTicket;
            $idTicket->setCommande($this);
        }

        return $this;
    }

    public function removeIdTicket(ticket $idTicket): self
    {
        if ($this->id_tickets->contains($idTicket)) {
            $this->id_tickets->removeElement($idTicket);
            // set the owning side to null (unless already changed)
            if ($idTicket->getCommande() === $this) {
                $idTicket->setCommande(null);
            }
        }

        return $this;
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
}
