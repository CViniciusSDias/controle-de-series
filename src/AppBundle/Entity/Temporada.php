<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="temporada")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TemporadaRepository")
 */
class Temporada
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="numero", type="smallint")
     */
    private $numero;

    /**
     * @ORM\ManyToOne(targetEntity="Serie", inversedBy="temporadas")
     * @ORM\JoinColumn(name="serie_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $serie;

    /**
     * @ORM\OneToMany(targetEntity="Episodio", mappedBy="temporada", cascade={"persist"}, fetch="EAGER")
     */
    private $episodios;

    use ModelTrait;

    public function __construct()
    {
        $this->episodios = new ArrayCollection();
    }

    public function preencheEpisodios(int $numeroDeEpisodios)
    {
        for ($i = 1; $i <= $numeroDeEpisodios; $i++) {
            $episodio = new Episodio();
            $episodio->episodio = $i;
            $episodio->assistido = false;
            $episodio->temporada = $this;
            $this->episodios->add($episodio);
        }
    }

    public function getEpisodiosAssistidos()
    {
        $episodios = $this->episodios->toArray();

        return array_filter($episodios, function ($e)
        {
            return $e->assistido;
        });
    }

    public function getEpisodiosNaoAssistidos()
    {
        $episodios = $this->episodios->toArray();

        return array_filter($episodios, function ($e)
        {
            return !$e->assistido;
        });
    }
}

