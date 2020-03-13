<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Contact;
use App\Entity\Compteur;
use App\Form\ContactType;
use App\Repository\PostRepository;
use App\Repository\ProjetsRepository;
use App\Repository\CompteurRepository;
use App\Repository\OrphelinRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="pageIndex")
     */
    public function index(PostRepository $repoPost,ProjetsRepository $repoProjet,CompteurRepository $repoCompteur,OrphelinRepository $repoOrphelin,Request $request)
    {
        $cpt = $repoCompteur->findOneBy(['id' => 4 ]);
        $zz = $this->getDoctrine()->getManager();
        $orphelin = $zz->createQuery(" SELECT count(c) FROM App\Entity\Orphelin c ")->getSingleScalarResult();
        $familly = $zz->createQuery(" SELECT count(f) FROM App\Entity\Familly f ")->getSingleScalarResult();
         if(($cpt == null) )
         {
        $com = new Compteur();
         $com->setCpt(1);
         $zz->persist($com);
         $zz->flush();
        }else{
            $cpt->setCpt($cpt->getCpt() + 1);
        }
        $zz->persist($cpt);
            $zz->flush();

        return $this->render('pages/index.html.twig', [
          'posts' => $repoPost->findSomePost(4),
          'projets' => $repoProjet->findSomeProjets(3),
          'orphelins' => $repoOrphelin->findAll(4),
          'compteur' => $cpt,
          'stats'  => compact('orphelin','familly'),
        ]);
    }

    /**
     * @Route("/news", name="newsPage")
     */
    public function news(PostRepository $repo)
    {
        return $this->render('pages/new.html.twig', [
            'posts' => $repo->findBy([],['id' => 'DESC'])
        ]);
    }

    /**
     * @Route("/news/{id}", name="newsDetailsPage")
     */
    public function newsDetails(PostRepository $repo,$id)
    {
        return $this->render('pages/newsDetails.html.twig', [
            'posts' => $repo->findBy([],['id' => 'DESC'])
        ]);
    }

    /**
     * @Route("/contact", name="contactPage")
     */
    public function contactPage(Request $request, \Swift_Mailer $mailer)
    {
        $contact = new Contact();
       

        if ($request->getMethod() === 'POST') {

           
            $entityManager = $this->getDoctrine()->getManager();
            $contact->setNom($request->get('nom'))
                    ->setPhone($request->get('phone'))
                    ->setObjet($request->get('objet'))
                    ->setMessage($request->get('message'))
                    ->setEmail($request->get('email'));
          
            $entityManager->persist($contact);
            $entityManager->flush();
            
            $message = (new \Swift_Message('Nouveau contact'))
                        ->setFrom($contact->getEmail())
                        ->setTo('brahimbouhaddou12@gmail.com')
                        ->setBody(
                            $this->renderView(
                                'email/contact.html.twig',compact('contact')
                            ),
                            'text/html'
                        )
                        ;

                        $mailer->send($message);

            return $this->redirectToRoute('contactPage');
        }

      
        return $this->render('pages/contact.html.twig', [
        ]);
    }

    

}
