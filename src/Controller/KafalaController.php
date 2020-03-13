<?php

namespace App\Controller;

use App\Entity\Kafala;
use App\Form\KafalaType;
use App\Repository\KafalaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/kafala")
 */
class KafalaController extends AbstractController
{
    /**
     * @Route("/", name="kafala_index", methods={"GET"})
     */
    public function index(KafalaRepository $kafalaRepository): Response
    {
        return $this->render('kafala/index.html.twig', [
            'kafalas' => $kafalaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="kafala_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $kafala = new Kafala();
        $form = $this->createForm(KafalaType::class, $kafala);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($kafala);
            $entityManager->flush();

            return $this->redirectToRoute('kafala_index');
        }

        return $this->render('kafala/new.html.twig', [
            'kafala' => $kafala,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="kafala_show", methods={"GET"})
     */
    public function show(Kafala $kafala): Response
    {
        return $this->render('kafala/show.html.twig', [
            'kafala' => $kafala,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="kafala_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Kafala $kafala): Response
    {
        $form = $this->createForm(KafalaType::class, $kafala);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('kafala_index');
        }

        return $this->render('kafala/edit.html.twig', [
            'kafala' => $kafala,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="kafala_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Kafala $kafala): Response
    {
        if ($this->isCsrfTokenValid('delete'.$kafala->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($kafala);
            $entityManager->flush();
        }

        return $this->redirectToRoute('kafala_index');
    }
}
