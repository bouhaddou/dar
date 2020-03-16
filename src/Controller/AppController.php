<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Contact;
use App\Entity\Compteur;
use App\Entity\Garant;
use App\Entity\Kafala;
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
        $cpt = $repoCompteur->findOneBy(['id' => 5 ]);
        $zz = $this->getDoctrine()->getManager();
        $orphelin = $zz->createQuery(" SELECT count(c) FROM App\Entity\Orphelin c ")->getSingleScalarResult();
        $familly = $zz->createQuery(" SELECT count(f) FROM App\Entity\Familly f ")->getSingleScalarResult();
        $orphelinfalse = $zz->createQuery(" SELECT count(c) FROM App\Entity\Orphelin c where c.status = false ")->getSingleScalarResult();
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
          'posts' => $repoPost->findSomePost(6),
          'projets' => $repoProjet->findSomeProjets(3),
          'orphelins' => $repoOrphelin->findByStatus(2),
          'compteur' => $cpt,
          'stats'  => compact('orphelin','familly','orphelinfalse'),
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
            'posts' => $repo->findOneBy(['id' => $id])
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

    /**
     * @Route("/darALKaram", name="darAlkaram")
     */
    public function darAlkaram()
    {
        return $this->render('pages/darAlKaram.html.twig', [
        ]);
    }

     /**
     * @Route("/kafil", name="kafilPage")
     */
    public function Kafala(OrphelinRepository $repo)
    {
        $manager= $this->getDoctrine()->getManager();
        $orphelin = $manager->createQuery(" SELECT count(c) FROM App\Entity\Orphelin c where c.status = false ")->getSingleScalarResult();
        return $this->render('pages/kafil.html.twig', [
            'orphelins' => $repo->findByStatus(200),
            'cppt' => $orphelin
        ]);
    }
         /**
     * @Route("/demande/{id}", name="damandePage")
     */
    public function demande(OrphelinRepository $repo,$id,Request $request)
    {
        $manager= $this->getDoctrine()->getManager();
        $orphelin =  $repo->findOneBy(['id' => $id]);
        if($request->getMethod() === 'POST')
        {

            $garant =new Garant();
            $garant->setName($request->get('name'))
                    ->setPhone($request->get('phone'))
                    ->setPaye($request->get('paye'))
                    ->setEmail($request->get('email'));
            $manager->persist($garant);
            $kafala = new Kafala();
            $date = new \DateTime($request->get('setAt'));
            $kafala->setSetAtdebut($date)
                    ->setType($request->get('type'))
                    ->setPeriode($request->get('periode'))
                    ->setPrix($request->get('prix'))
                    ->setObservation($request->get('obser'))
                    ->setPour($request->get('pour'))
                    ->setOrphelin($orphelin)
                    ->setGarant($garant);
            $manager->persist($kafala);
            $orphelin->setStatus(true);
            $manager->persist($orphelin);
        
            $manager->flush();

            $this->addFlash(
                'success',
                '  شكرا لكم لقد تم تكفيل اليثم بنجاح '
            );

            return $this->redirectToRoute('kafilPage');
        
        }
        return $this->render('pages/demande.html.twig', [
            'orphelin' => $orphelin
        ]);
    }

    /**
     * @Route("/projet", name="projetpage")
     */
    public function projet(ProjetsRepository $repoProjet)
    {
        return $this->render('pages/projets.html.twig', [
            'projets' => $repoProjet->findSomeProjets(500),
        ]);
    }
     /**
     * @Route("/projet/{id}", name="projetDetailsPage")
     */
    public function projetdetails(ProjetsRepository $repoProjet,$id)
    {

        return $this->render('pages/projetdetails.html.twig', [
            'projets' => $repoProjet->findOneBy(['id' => $id])
        ]);
    }
}
