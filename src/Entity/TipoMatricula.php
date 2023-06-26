<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoMatricula
 *
 * @ORM\Table(name="tipo_matricula")
 * @ORM\Entity
 */
class TipoMatricula
{   
    const MEDICO  = 1 ;
    const OBSTETRA = 2;
    /** 
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=45, nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="string", length=100, nullable=false)
     */
    private $observacion;

    public function __toString(): string
    {
        return $this->tipo; // O cualquier propiedad que desees mostrar como representación de cadena
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getObservacion(): ?string
    {
        return $this->observacion;
    }

    public function setObservacion(string $observacion): self
    {
        $this->observacion = $observacion;

        return $this;
    }


}
