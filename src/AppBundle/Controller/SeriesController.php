<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Serie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SeriesController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction(): Response
    {
        return $this->redirectToRoute('series');
    }

    /**
     * @Route("/series", name="series")
     */
    public function listarAction(): Response
    {
        $series = $this->getDoctrine()->getRepository('AppBundle:Serie')->findBy([], ['nome' => 'asc']);
        return $this->render('series/index.html.twig', ['series' => $series]);
    }

    /**
     * @Route("/series/gerenciar", name="gerenciar_series")
     */
    public function gerenciarAction(): Response
    {
        $series = $this->getDoctrine()->getRepository('AppBundle:Serie')->findBy([], ['nome' => 'asc']);
        return $this->render('series/gerenciar.html.twig', ['series' => $series]);
    }

    /**
     * @Route("/series/salvar", name="salvar_serie")
     * @Method("POST")
     */
    public function salvarSerieAction(Request $request): Response
    {
        $nomeSerie = $request->request->get('nome');
        $numeroDeTemporadas = intval($request->request->get('temporadas'));
        $numeroDeEpisodios = intval($request->request->get('episodios'));
        $serie = new Serie();
        $serie->nome = $nomeSerie;
        $serie->preencheTemporadas($numeroDeTemporadas, $numeroDeEpisodios);
        $em = $this->getDoctrine()->getManager();

        $em->persist($serie);
        $em->flush();

        $this->addFlash('success', "Série $nomeSerie cadastrada com sucesso");
        return $this->redirectToRoute('gerenciar_series');
    }

    /**
     * @Route("/series/remover", name="remover_serie")
     * @Method("POST")
     */
    public function removerSerie(Request $request): Response
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Serie');
        $serie = $repository->find($request->request->get('serie'));
        $em = $this->getDoctrine()->getManager();
        $em->remove($serie);
        $em->flush();

        $this->addFlash('danger', "Série {$serie->nome} removida com sucesso.");
        return $this->redirectToRoute('gerenciar_series');
    }
}