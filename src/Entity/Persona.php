<?php

namespace App\Entity;

use App\Repository\PersonaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonaRepository::class)
 */
class Persona
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
    private $dni;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $sexo;

    /**
     * @ORM\Column(type="date")
     */
    private $fNac;

    /**
     * @ORM\ManyToOne(targetEntity=Hospital::class, inversedBy="personas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hospitalNac;

  
    

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

    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(string $dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    public function isSexo()
    {
        return $this->sexo;
    }

    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    public function getFNac(): ?\DateTimeInterface
    {
        return $this->fNac;
    }

    public function setFNac(\DateTimeInterface $fNac): self
    {
        $this->fNac = $fNac;

        return $this;
    }

    public function getHospitalNac(): ?Hospital
    {
        return $this->hospitalNac;
    }

    public function setHospitalNac(?Hospital $hospitalNac): self
    {
        $this->hospitalNac = $hospitalNac;

        return $this;
    }

}
