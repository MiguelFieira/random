<?php

namespace App\Controller;

use App\Entity\Spelers;
use App\Form\SpelersType;
use App\Repository\SpelersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/spelers")
 */
class SpelersController extends AbstractController
{
    /**
     * @Route("/", name="spelers_index", methods={"GET"})
     */
    public function index(SpelersRepository $spelersRepository): Response
    {
        return $this->render('spelers/index.html.twig', [
            'spelers' => $spelersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="spelers_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $speler = new Spelers();
        $form = $this->createForm(SpelersType::class, $speler);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($speler);
            $entityManager->flush();

            return $this->redirectToRoute('spelers_index');
        }

        return $this->render('spelers/new.html.twig', [
            'speler' => $speler,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="spelers_show", methods={"GET"})
     */
    public function show(Spelers $speler): Response
    {
        return $this->render('spelers/show.html.twig', [
            'speler' => $speler,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="spelers_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Spelers $speler): Response
    {
        $form = $this->createForm(SpelersType::class, $speler);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('spelers_index');
        }

        return $this->render('spelers/edit.html.twig', [
            'speler' => $speler,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="spelers_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Spelers $speler): Response
    {
        if ($this->isCsrfTokenValid('delete'.$speler->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($speler);
            $entityManager->flush();
        }

        return $this->redirectToRoute('spelers_index');
    }
}
