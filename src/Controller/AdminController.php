<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Form\SerieType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\ManagerRegistry as DoctrineManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Regex;

class AdminController extends AbstractController
{
    #[Route(' /admin/series/all', name: 'list_adimn_serie_id')]
    public function lstIdSerie(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Serie::class);
        //$lesSeries = $repository->findAll();
        $lesSeries = $repository->findBy([],['titre'=>'ASC']);
        //$lesSeries = $repository->findBy([],['premierediffusion' => 'DESC'],2);
        dump($lesSeries);
        return $this->render('serie/all.html.twig' ,[
            'lesSeries' => $lesSeries
        ]);
    }

    #[Route(' /admin/series/{id}', name: 'sup__serie_by_id', methods:'DELETE')]
    public function suppSerie(ManagerRegistry $doctrine, $id, Request $request): Response
    {

        $em=$doctrine->getManager();
        $repository = $em->getRepository(serie::class);
        $laSerie=$repository->find($id);
        if ($this->isCsrfTokenValid('delete_serie',$request->get('token'))){
        $em->remove($laSerie);
        $em->flush();
        }
        return $this->redirectToRoute('list_adimn_serie_id');

    }
    
    
    #[Route('/admin/series', name: 'app_admin_addSerie')]
    public function addSerie(Request $request, ManagerRegistry $doctrine): Response
    {
        $serie= new Serie();
        $form=$this->createForm(SerieType::class, $serie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em=$doctrine->getManager();
            $em->persist($serie);
            $em->flush();
            //return $this->redirectToRoute('app_serie');
        }
        return $this->render('admin/addSerie.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/series/{id}', name: 'app_admin_modifSeries')]
    public function modifySerie( ManagerRegistry $doctrine, $id,Request $request): Response
    {
        $repository = $doctrine->getRepository(Serie::class);
        $laSerie = $repository->find($id);
        $form=$this->createForm(SerieType::class, $laSerie);

        $form->handleRequest($request);// recup les données du form
        if($form->isSubmitted() && $form->isValid())
        {
            $EntityManager=$doctrine->getManager();
            $EntityManager->flush(); // ajoute dans la bdd
            return $this->redirectToRoute('app_serie'); //redirige sur la page des series
        }


        return $this->render('admin/modifSerie.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    

}
