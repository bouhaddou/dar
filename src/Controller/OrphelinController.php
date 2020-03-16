<?php

namespace App\Controller;

use App\Entity\Orphelin;
use App\Form\OrphelinType;
use App\Form\EditorphelinType;
use App\Repository\GarantRepository;
use App\Repository\KafalaRepository;
use App\Repository\OrphelinRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/orphelin")
 */
class OrphelinController extends AbstractController
{
    /**
     * @Route("/", name="orphelin_index", methods={"GET"})
     */
    public function index(OrphelinRepository $orphelinRepository): Response
    {
        return $this->render('admin/orphelin/index.html.twig', [
            'orphelins' => $orphelinRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="orphelin_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $orphelin = new Orphelin();
        $form = $this->createForm(OrphelinType::class, $orphelin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $file = $form['image']->getData();
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $filename);
            $orphelin->setImage($filename);

            $entityManager->persist($orphelin);
            $entityManager->flush();

            return $this->redirectToRoute('orphelin_index');
        }

        return $this->render('admin/orphelin/new.html.twig', [
            'orphelin' => $orphelin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/show", name="orphelin_show", methods={"GET"})
     */
    public function show(Orphelin $orphelin,KafalaRepository $repokafala,GarantRepository $repoGarant,OrphelinRepository $rep): Response
    {
        return $this->render('admin/orphelin/show.html.twig', [
            'orphelin' => $orphelin,
            'kafala' => $repokafala->kafalaFunction($orphelin),
            'garant' => $repoGarant->garantfunction($orphelin)
        ]);
    }

    /**
     * @Route("/{id}/edit", name="orphelin_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Orphelin $orphelin): Response
    {
        $form = $this->createForm(EditorphelinType::class, $orphelin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('orphelin_index');
        }

        return $this->render('admin/orphelin/edit.html.twig', [
            'orphelin' => $orphelin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="orphelin_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Orphelin $orphelin): Response
    {
        if ($this->isCsrfTokenValid('delete'.$orphelin->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($orphelin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('orphelin_index');
    }
}
