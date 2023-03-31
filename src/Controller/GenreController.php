<?php

namespace App\Controller;

use app\Entity\Genre;
use app\Entity\Serie;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GenreController extends AbstractController
{
    #[Route('/testGenre', name: 'app_genre')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $unGenre= new Genre();
        $unGenre->setLibelle("Drames");
        $repository=$doctrine->getRepository(Serie::class);
        $laSerie = $repository->find(2);
        $laSerie->addSeries($unGenre);
        $entityManager = $doctrine->getManager();
        $entityManager->persist($unGenre);
        $entityManager->flush();
        
        return $this->render('genre/testgenre.html.twig', [
            'controller_name' => 'GenreController',
        ]);
    }
}
