<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Episodio
 *
 * @ORM\Table(name="episodio")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EpisodioRepository")
 */
class Episodio
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="episodio", type="smallint")
     */
    private $episodio;

    /**
     * @ORM\Column(name="assistido", type="boolean")
     */
    private $assistido;

    /**
     * @ORM\ManyToOne(targetEntity="Temporada", inversedBy="episodios", cascade={"persist"})
     * @ORM\JoinColumn(name="temporada_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $temporada;

    use ModelTrait;
}

