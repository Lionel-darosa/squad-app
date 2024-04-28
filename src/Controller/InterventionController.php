<?php

namespace App\Controller;

use App\Form\InterventionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Intervention;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path:"/intervention", name:"intervention_")]
class InterventionController extends AbstractController
{
    #[Route(path:"/new", name:"new")]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $intervention = new Intervention();
        $form = $this->createForm(InterventionType::class, $intervention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $intervention = $form->getData();

            $manager->persist($intervention);
            $manager->flush();

            return $this->redirectToRoute("intervention_new", [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('intervention/new.html.twig', [
            'intervention' => $intervention,
            'form' => $form,
        ]);
    }
}