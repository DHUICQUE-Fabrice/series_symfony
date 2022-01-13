<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/","name=main_")
 */
class MainController extends AbstractController
{
    /**
     * @Route ("","name=home")
     */
    public function home(): Response{
        return $this->render('main/home.html.twig');
    }

    /**
     * @Route ("/test","name=test")
     */
    public function test(): Response{
        $serie = [
            'title' => "<h1>Game of Thrones</h1>",
            'year' => 2000
        ];
        return $this->render('main/test.html.twig', [
            "mySerie"=>$serie,
            "autreVar"=>65465465
        ]);
    }
}