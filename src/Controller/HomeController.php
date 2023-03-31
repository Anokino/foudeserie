<?php

namespace App\Controller;

use App\Entity\Serie;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpCache\ResponseCacheStrategy;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index()
    {
        return $this->render('home/index.html.twig');
    }

    #[route('/news', name: 'app_news')]
    public function news(): Response
    {
        return $this->render('home/news.html.twig',['nbnews'=>4]);
    }

    #[route('/testEntity', name: 'app_testEntity', methods: ['persist'])]
    
    
    public function testEntity(ManagerRegistry $doctrine): Response
    {
        $serie = new Serie();
        $serie->settitre("dragon ball super");
        $serie->setResume("la suite des aventure de goku et ces amis");
        //$serie->setDuree("");
        //$serie->setPremiereDiffusion("2015-07-05");
        $serie->setImage("https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcTupfTDfMEO8Pr_yrv_bn-7ZHNoF1LwQSpn0bXfVw9Yztadj9oN");

        $entityManager = $doctrine->getManager();

        $entityManager ->persist($serie);
        $entityManager->flush();
        return $this->render('home/testEntity.html.twing');

    }
}
