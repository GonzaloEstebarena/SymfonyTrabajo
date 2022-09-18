<?php

namespace App\Controller;
use App\Form\AddCancionType;
use App\Entity\Canciones;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(): Response
    {
        return $this->render('main/main.html.twig');
    }
    #[Route('/canciones', name: 'canciones')]
    public function canciones(EntityManagerInterface $em): Response
    {

        $respositorio = $em->getRepository(Canciones::class);  
        $canciones = $respositorio->findAll();
        return $this->render('main/canciones.html.twig',["canciones"=>$canciones]);
    }
    #[Route('/addcancion', name: 'addcancion')]
    public function addcancion(EntityManagerInterface $em, Request $request): Response
    {

        $form = $this->createForm(AddCancionType::class);
        $form -> handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cancion = $form->getData();
            $em->persist($cancion);
            $em->flush();

            return $this->redirectToRoute("canciones");
        }

        return $this->renderForm('main/addCancion.html.twig', ["cancionForm"=>$form]);
    }
    // #[Route('/getinfo/{id}', name: 'getinfo')]
    // public function getinfo(EntityManagerInterface $em, $id): Response
    // {
    //     $respositorio=$em->getRepository(Canciones::class);
    //     $cancion=$respositorio->find($id);

    //     return $this->render('main/infoCancion.html.twig',["cancion"=>$cancion]);
    // }

    #[Route('/getinfo/{id}', name: 'getinfo')]
    public function getinfo(EntityManagerInterface $em, $id): Response
    {
        $respositorio = $em->getRepository(Canciones::class);
        $cancion = $respositorio->find($id);
        return $this->render('main/infoCancion.html.twig', ["cancion" => $cancion]);
    }
}

