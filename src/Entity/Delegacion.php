<?php

namespace App\Entity;

use App\Repository\DelegacionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DelegacionRepository::class)
 */
class Delegacion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity=partido::class, inversedBy="delegaciones")
     * @ORM\JoinColumn(nullable=false)
     */
    private $partido;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $despar;

    /**
     * @ORM\OneToMany(targetEntity=ProfesionalRegistracion::class, mappedBy="delegacion")
     */
    private $profesionalRegistracions;

    public function __construct()
    {
        $this->profesionalRegistracions = new ArrayCollection();
    }



    public function __toString(): string
    {
        return $this->descripcion; // O cualquier propiedad que desees mostrar como representación de cadena
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getPartidoId(): ?partido
    {
        return $this->partido;
    }

    public function setPartidoId(?partido $partido): self
    {
        $this->partido= $partido;

        return $this;
    }

    public function getDespar(): ?string
    {
        return $this->despar;
    }

    public function setDespar(?string $despar): self
    {
        $this->despar = $despar;

        return $this;
    }

    /**
     * @return Collection<int, ProfesionalRegistracion>
     */
    public function getProfesionalRegistracions(): Collection
    {
        return $this->profesionalRegistracions;
    }

    public function addProfesionalRegistracion(ProfesionalRegistracion $profesionalRegistracion): self
    {
        if (!$this->profesionalRegistracions->contains($profesionalRegistracion)) {
            $this->profesionalRegistracions[] = $profesionalRegistracion;
            $profesionalRegistracion->setDelegacion($this);
        }

        return $this;
    }

    public function removeProfesionalRegistracion(ProfesionalRegistracion $profesionalRegistracion): self
    {
        if ($this->profesionalRegistracions->removeElement($profesionalRegistracion)) {
            // set the owning side to null (unless already changed)
            if ($profesionalRegistracion->getDelegacion() === $this) {
                $profesionalRegistracion->setDelegacion(null);
            }
        }

        return $this;
    }


    
}