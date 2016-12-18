<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Serie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TemporadasController extends Controller
{
    /**
     * @Route("/temporadas/{serieId}", name="temporadas")
     */
    public function listarAction(int $serieId)
    {
        $serie = $this->getDoctrine()->getRepository('AppBundle:Serie')->find($serieId);
        $temporadas = $serie->temporadas;

        return $this->render('temporadas/index.html.twig', ['temporadas' => $temporadas, 'serie' => $serie->nome]);
    }

}
