<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProfesionalRegistracion
 *
 * @ORM\Table(name="profesional_registracion", indexes={@ORM\Index(name="FK_profesional_registracion_alcance", columns={"alcance_id"}), @ORM\Index(name="FK_profesional_registracion_origen_registracion", columns={"origen_registracion_id"}), @ORM\Index(name="FK_profesional_registracion_profesional", columns={"profesional_id"})})
 * @ORM\Entity
 */
class ProfesionalRegistracion
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registracion", type="datetime", nullable=false)
     */
    private $fechaRegistracion;

    /**
     * @var bool
     *
     * @ORM\Column(name="borrado", type="boolean", nullable=false, options={"comment"="0: activo - 1: borrado"})
     */
    private $borrado = '0';

    /**
     * @var \Profesional
     *
     * @ORM\ManyToOne(targetEntity="Profesional")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="profesional_id", referencedColumnName="id")
     * })
     */
    private $profesional;

    /**
     * @var \OrigenRegistracion
     *
     * @ORM\ManyToOne(targetEntity="OrigenRegistracion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="origen_registracion_id", referencedColumnName="id")
     * })
     */
    private $origenRegistracion;

    /**
     * @var \Alcance
     *
     * @ORM\ManyToOne(targetEntity="Alcance")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="alcance_id", referencedColumnName="id")
     * })
     */
    private $alcance;

    /**
     * @ORM\ManyToOne(targetEntity=Delegacion::class, inversedBy="profesionalRegistracions")
     */
    private $delegacion;




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaRegistracion(): ?\DateTimeInterface
    {
        return $this->fechaRegistracion;
    }

    public function setFechaRegistracion(\DateTimeInterface $fechaRegistracion): self
    {
        $this->fechaRegistracion = $fechaRegistracion;

        return $this;
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

    public function getProfesional(): ?Profesional
    {
        return $this->profesional;
    }

    public function setProfesional(?Profesional $profesional): self
    {
        $this->profesional = $profesional;

        return $this;
    }

    public function getOrigenRegistracion(): ?OrigenRegistracion
    {
        return $this->origenRegistracion;
    }

    public function setOrigenRegistracion(?OrigenRegistracion $origenRegistracion): self
    {
        $this->origenRegistracion = $origenRegistracion;

        return $this;
    }

    public function getAlcance(): ?Alcance
    {
        return $this->alcance;
    }

    public function setAlcance(?Alcance $alcance): self
    {
        $this->alcance = $alcance;

        return $this;
    }

    public function getDelegacion(): ?Delegacion
    {
        return $this->delegacion;
    }

    public function setDelegacion(?Delegacion $delegacion): self
    {
        $this->delegacion = $delegacion;

        return $this;
    }

}
