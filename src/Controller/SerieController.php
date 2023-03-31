<?php

namespace App\Controller;

use App\Entity\Serie;
use App\service\PdoFouDeSerie;
use Doctrine\Persistence\ManagerRegistry;
use PhpParser\Node\Expr\Cast\Int_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SerieController extends AbstractController
{
    //#[Route('/serie', name: 'app_serie')]
    //public function showSerie(PdoFouDeSerie $pdoFouDeSerie): Response
    //{
    //    $lesSeries=$pdoFouDeSerie->getLesSeries();
    //    $nbSeries=$pdoFouDeSerie->getnbSeries();
    //    $nbSeries = count($lesSeries);
    //    return $this->render('serie/lesSeries.html.twig', [
    //        'lesSeries' => $lesSeries,
    //        'nbSeries'=> $nbSeries,
    //    ]);

        
    //}


    #[Route('/serie', name: 'app_serie')]
    public function showSerie(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Serie::class);
        //$lesSeries = $repository->findAll();
        $lesSeries = $repository->findBy([],['titre'=>'ASC']);
        //$lesSeries = $repository->findBy([],['premierediffusion' => 'DESC'],2);
        dump($lesSeries);
        return $this->render('serie/lesSeries.html.twig' ,[
            'lesSeries' => $lesSeries
        ]);

    }

    #[Route('/serie/{id}', name: 'app_serie_detail')]
    public function showlaSeries(ManagerRegistry $doctrine, $id): Response
    {
        $repository = $doctrine->getRepository(Serie::class);
        $laSerie = $repository->find($id);
        dump($laSerie);
        if(!$laSerie) {
        throw $this->createNotFoundException('La série n\'a pas été trouvée');}
        return $this->render('serie/detail.html.twig' ,[
            'laSeries' => $laSerie
        ]);

    }

    #[Route('/serie/{id}/like', name: 'app_serie_like',)]

    public function GetLikeOneSerie($id, ManagerRegistry $doctrine): Response
    {
    
        $repository = $doctrine->getRepository(Hackathons::class);
        $laSeries = $repository->find($id);
        try {
        if(!$laSeries) {
            throw $this->createNotFoundException('Le hackathon n a pas ete trouvee');}
        $nblikes = $laSeries->getLikes();
        $nblikes = $nblikes + 1;
        $laSeries->setLikes($nblikes);
        $em=$doctrine->getManager();
        $em->persist($laSeries);
        $em->flush();
        return $this->json([$nblikes]);
        }
        catch(\Exception $e){
            //on retourne une réponse json avec le code 404
            return $this->json(['error' => $e->getMessage()], 404);
        }
    }

}
