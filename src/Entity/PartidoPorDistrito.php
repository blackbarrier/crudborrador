<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PartidoPorDistrito
 *
 * @ORM\Table(name="partido_por_distrito", indexes={@ORM\Index(name="fk_partido_por_distrito_distrito", columns={"distrito_id"}), @ORM\Index(name="fk_partido_por_distrito_partido", columns={"partido_id"})})
 * @ORM\Entity
 */
class PartidoPorDistrito
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
     * @var \Partido
     *
     * @ORM\ManyToOne(targetEntity="Partido")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="partido_id", referencedColumnName="id")
     * })
     */
    private $partido;

    /**
     * @var \Distrito
     *
     * @ORM\ManyToOne(targetEntity="Distrito")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="distrito_id", referencedColumnName="id")
     * })
     */
    private $distrito;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPartido(): ?Partido
    {
        return $this->partido;
    }

    public function setPartido(?Partido $partido): self
    {
        $this->partido = $partido;

        return $this;
    }

    public function getDistrito(): ?Distrito
    {
        return $this->distrito;
    }

    public function setDistrito(?Distrito $distrito): self
    {
        $this->distrito = $distrito;

        return $this;
    }


}
