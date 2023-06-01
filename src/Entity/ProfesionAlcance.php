<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProfesionAlcance
 *
 * @ORM\Table(name="profesion_alcance", indexes={@ORM\Index(name="FK_profesion_alcance_alcance", columns={"alcance_id"}), @ORM\Index(name="FK_profesion_alcance_profesion", columns={"profesion_id"})})
 * @ORM\Entity
 */
class ProfesionAlcance
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
     * @var \Profesion
     *
     * @ORM\ManyToOne(targetEntity="Profesion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="profesion_id", referencedColumnName="id")
     * })
     */
    private $profesion;

    /**
     * @var \Alcance
     *
     * @ORM\ManyToOne(targetEntity="Alcance")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="alcance_id", referencedColumnName="id")
     * })
     */
    private $alcance;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfesion(): ?Profesion
    {
        return $this->profesion;
    }

    public function setProfesion(?Profesion $profesion): self
    {
        $this->profesion = $profesion;

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


}
