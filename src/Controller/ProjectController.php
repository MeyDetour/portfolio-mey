<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjetType;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/profile')]
class ProjectController extends AbstractController
{
    #[Route('/projets', name: 'projets')]
    public function index(ProjectRepository $projetRepository): Response
    {
        $projets = $projetRepository->findAll();
        if(count($projets)==0){
            return $this->redirectToRoute('new_projet');
        }
        return $this->render('project/index.html.twig', [
            'projets'=> $projets

        ]);
    }
    #[Route('/project/new', name: 'new_projet')]
    public function new(ProjectRepository $repository,EntityManagerInterface $manager , Request $request): Response
    {

        $projet = new Project();
        $form = $this->createForm(ProjetType::class,$projet);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($projet);
            $manager->flush();
            return $this->redirectToRoute('project_add_image',['id'=>$projet->getId()]);
        }
        return $this->render('project/add.html.twig', [
            'form'=> $form->createView()
        ]);
    }
    #[Route('/project/edit/{id}', name: 'edit_projet')]
    public function edit(EntityManagerInterface $manager ,Project $projet ,Request $request): Response
    {

        $form = $this->createForm(ProjetType::class,$projet);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($projet);
            $manager->flush();
            return $this->redirectToRoute('projets');
        }
        return $this->render('project/add.html.twig', [
            'form'=> $form->createView(),
            "projet"=>$projet
        ]);
    }
    #[Route('/project/remove/{id}', name: 'remove_project')]
    public function remove(EntityManagerInterface $manager ,Project $project): Response
    {

        $manager->remove($project);
        $manager->flush();
        return  $this->redirectToRoute('projets');
    }
}
//  <a href="{{ path('remove_quality',{'id':quality.id}) }}">Supprimer</a>
//