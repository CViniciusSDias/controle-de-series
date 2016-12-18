<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EpisodiosController extends Controller
{
    /**
     * @Route("/episodios/listar/{temporadaId}", name="episodios",  requirements={ "temporadaId": "\d+" })
     */
    public function listarAction(int $temporadaId): Response
    {
        $temporada = $this->getDoctrine()->getRepository('AppBundle:Temporada')->find($temporadaId);
        return $this->render('episodios/index.html.twig', ['temporada' => $temporada]);
    }

    /**
     * @Route("/episodios/assistir", name="assistir_episodios")
     * @Method("POST")
     */
    public function assistirAction(Request $request): Response
    {
        $temporadaId = $request->request->get('temporada');
        $episodiosMarcados = $request->request->get('episodio');
        $episodiosRepository = $this->getDoctrine()->getRepository('AppBundle:Episodio');
        $episodiosRepository->desmarcarTodosDaTemporada($temporadaId);

        foreach ($episodiosMarcados as $episodio) {
            $episodiosRepository->marcarAssitidoPorId($episodio, true);
        }

        $this->addFlash('success', 'Episódios marcados como assistidos com sucesso');

        return $this->redirectToRoute('episodios', ['temporadaId' => $temporadaId]);
    }
}
