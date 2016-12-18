<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class EpisodiosController extends Controller
{
    /**
     * @Route("/episodios/{temporadaId}", name="episodios")
     */
    public function listarAction(int $temporadaId): Response
    {
        $temporada = $this->getDoctrine()->getRepository('AppBundle:Temporada')->find($temporadaId);
        return $this->render('episodios/index.html.twig', ['temporada' => $temporada]);
    }

}
