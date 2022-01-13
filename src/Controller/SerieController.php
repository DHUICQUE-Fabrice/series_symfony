<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Form\SerieType;
use App\Repository\SerieRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/serie", name="serie_")
 */
class SerieController extends AbstractController
{
    /**
     * @Route("", name="list")
     */
    public function list(SerieRepository $serieRepository): Response
    {
        $series = $serieRepository->findBestSeries();

        return $this->render('serie/list.html.twig',['series'=>$series]);
    }

    /**
     * @Route("/details/{id}", name="details")
     */
    public function details(int $id, SerieRepository $serieRepository): Response
    {
        $serie = $serieRepository->find($id);
        if (!$serie){
            throw $this->createNotFoundException('This serie does not exist!');
        }
        return $this->render('serie/detail.html.twig',['serie'=>$serie]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $serie = new Serie();
        $serie->setDateCreated(new DateTime());

        $serieForm = $this->createForm(SerieType::class, $serie);

        $serieForm->handleRequest($request);

        if ($serieForm->isSubmitted() && $serieForm->isValid()){
            $entityManager->persist($serie);
            $entityManager->flush();

            $this->addFlash('success', 'Serie Added!');
            return $this->redirectToRoute('serie_details', ['id'=> $serie->getId()] );
        }

        return $this->render('serie/create.html.twig', [
            'serieForm'=>$serieForm->createView(),
        ]);

    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Serie $serie, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($serie);
        $entityManager->flush();
        return $this->redirectToRoute('app_main_home');
    }
    /**
     * @Route("/demo", name="em-demo")
     */
    public function demo(EntityManagerInterface $entityManager): Response
    {
        // crée une instance de Serie
        $serie = new Serie();

        //hydrater les propriétés
        $serie->setName('Chi');
        $serie->setBackdrop('path');
        $serie->setPoster('path');
        $serie->setDateCreated(new DateTime());
        $serie->setFirstAirDate(new DateTime("- 1 year"));
        $serie->setLastAirDate(new DateTime('- 6 month'));
        $serie->setGenres('anime');
        $serie->setOverview('Une vie de chat');
        $serie->setPopularity(93.00);
        $serie->setVote(8.2);
        $serie->setStatus('Canceled');
        $serie->setTmdbId(354894651);

        dump($serie);

        $entityManager->persist($serie);
        $entityManager->flush();

        dump($serie);

        $serie->setGenres('manga');

        //$entityManager->remove($serie);
        $entityManager->flush();
        return $this->render('serie/create.html.twig');
    }
}
