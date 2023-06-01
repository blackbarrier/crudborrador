<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProfesionalEspecialista
 *
 * @ORM\Table(name="profesional_especialista", indexes={@ORM\Index(name="FK_profesional_especialista_especialidad", columns={"especialidad_id"}), @ORM\Index(name="FK_profesional_especialista_profesional", columns={"profesional_id"})})
 * @ORM\Entity
 */
class ProfesionalEspecialista
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="borrado", type="boolean", nullable=false, options={"comment"="0: activo - 1: borrado"})
     */
    private $borrado = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_actualizacion", type="datetime", nullable=false)
     */
    private $fechaActualizacion;

    /**
     * @var \Especialidad
     *
     * @ORM\ManyToOne(targetEntity="Especialidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="especialidad_id", referencedColumnName="id")
     * })
     */
    private $especialidad;

    /**
     * @var \Profesional
     *
     * @ORM\ManyToOne(targetEntity="Profesional")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="profesional_id", referencedColumnName="id")
     * })
     */
    private $profesional;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isBorrado(): ?bool
    {
        return $this->borrado;
    }

    public function setBorrado(bool $borrado): self
    {
        $this->borrado = $borrado;

        return $this;
    }

    public function getFechaActualizacion(): ?\DateTimeInterface
    {
        return $this->fechaActualizacion;
    }

    public function setFechaActualizacion(\DateTimeInterface $fechaActualizacion): self
    {
        $this->fechaActualizacion = $fechaActualizacion;

        return $this;
    }

    public function getEspecialidad(): ?Especialidad
    {
        return $this->especialidad;
    }

    public function setEspecialidad(?Especialidad $especialidad): self
    {
        $this->especialidad = $especialidad;

        return $this;
    }

    public function getProfesional(): ?Profesional
    {
        return $this->profesional;
    }

    public function setProfesional(?Profesional $profesional): self
    {
        $this->profesional = $profesional;

        return $this;
    }


}
