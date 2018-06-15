<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 */
class Customer
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ticket", mappedBy="id_customers")
     */
    private $id_customer;

    public function __construct()
    {
        $this->id_customer = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return Collection|Ticket[]
     */
    public function getIdCustomer(): Collection
    {
        return $this->id_customer;
    }

    public function addIdCustomer(Ticket $idCustomer): self
    {
        if (!$this->id_customer->contains($idCustomer)) {
            $this->id_customer[] = $idCustomer;
            $idCustomer->setIdCustomers($this);
        }

        return $this;
    }

    public function removeIdCustomer(Ticket $idCustomer): self
    {
        if ($this->id_customer->contains($idCustomer)) {
            $this->id_customer->removeElement($idCustomer);
            // set the owning side to null (unless already changed)
            if ($idCustomer->getIdCustomers() === $this) {
                $idCustomer->setIdCustomers(null);
            }
        }

        return $this;
    }
}
