<?php

namespace App\Entity;

use App\Repository\ObstetraRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ObstetraRepository::class)
 */
class Obstetra
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

}
