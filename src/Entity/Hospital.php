<?php

namespace App\Entity;

use App\Repository\HospitalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HospitalRepository::class)
 */
class Hospital
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codigoHosp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $direccion;

    /**
     * @ORM\OneToMany(targetEntity=Persona::class, mappedBy="hospitalNac", orphanRemoval=true)
     */
    private $personas;

    public function __construct()
    {
        $this->personas = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->Nombre;    
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getCodigoHosp(): ?string
    {
        return $this->codigoHosp;
    }

    public function setCodigoHosp(string $codigoHosp): self
    {
        $this->codigoHosp = $codigoHosp;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * @return Collection<int, Persona>
     */
    public function getPersonas(): Collection
    {
        return $this->personas;
    }

    public function addPersona(Persona $persona): self
    {
        if (!$this->personas->contains($persona)) {
            $this->personas[] = $persona;
            $persona->setHospitalNac($this);
        }

        return $this;
    }

    public function removePersona(Persona $persona): self
    {
        if ($this->personas->removeElement($persona)) {
            // set the owning side to null (unless already changed)
            if ($persona->getHospitalNac() === $this) {
                $persona->setHospitalNac(null);
            }
        }

        return $this;
    }
}
