<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProfesionAlcance
 *
 * @ORM\Table(name="profesion_alcance", indexes={@ORM\Index(name="FK_profesion_alcance_alcance", columns={"alcance_id"}), @ORM\Index(name="FK_profesion_alcance_profesion", columns={"tipo_matricula_id"})})
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
     * @var \TipoMatricula
     *
     * @ORM\ManyToOne(targetEntity="TipoMatricula")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_matricula_id", referencedColumnName="id")
     * })
     */
    private $tipoMatricula;

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

    public function getTipoMatriculan(): ?TipoMatricula
    {
        return $this->tipoMatricula;
    }

    public function setTipoMatricula(?TipoMatricula $tipoMatricula): self
    {
        $this->tipoMatricula = $tipoMatricula;

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
