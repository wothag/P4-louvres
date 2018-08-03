<?php
/**
 * Created by PhpStorm.
 * User: drcha
 * Date: 04/06/2018
 * Time: 20:29
 */

namespace App\Controller;

use App\Entity\Commande;
use App\Form\OrderType;
use App\Form\TicketType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class HomeController extends AbstractController
{

    /**
     * @Route("/accueil" , name="app_homepage")
     */
    public function homepage(Request $request, SessionInterface $session)
    {
       $session = $request->getSession();
       return $this->render('homepage/home.html.twig', [
        'title'=>'Bienvenue sur la billetterie en ligne du Louvre'
       ]) ;
    }

    /**
     * @Route("/billetterie" , name="app_billetterie")
     */

    public function billeterie(Request $request, EntityManagerInterface $em)
    {
        $session = $request->getSession();
        $commande=new commande;


        $form=$this->createForm(OrderType::class, $commande);
        $form->handleRequest($request);

        if ($request->isMethod('POST'))
        {
            if($form->isSubmitted() && $form->isValid())
            {
                //  creation de la session order, on y place l'objet order contenu dans $order //
                $session->set("commande",$commande);

                //  on appelle l'EntityManager
                $em=$this->getDoctrine()->getManager();
                $em->persist($commande);
                $em->flush();

                $this->addFlash('success' , "Etape suivante : Veuillez renseigner chaque ticket.");
                //  on redirect vers la deuxieme phase
                return $this->redirectToRoute('app_billetterie2');
            }
        }
        else
            return $this->render('billeterie/billet.html.twig',[
                'title'=>'Billetterie en ligne',
                'orderForm'=>$form->createView(),
            ]);
    }

    /**
     * @Route("/billetterie2" , name="app_billetterie2")
     */

    public function billeterie2(Request $request)
    {
        $session = $request->getSession();
        $commande= $session->get("commande");
        $form=$this->createFormBuilder();


        //CREATION D UNE BOUCLE POUR AFFICHAGE FORMULAIRE SELON LA VAR RECUPEREE//

        $nombre_tickets = $commande->getNbTickets();
        for ($i=0; $i<$nombre_tickets; $i++)
        {
            $form->add($i,TicketType::class, [
                "label"=>"Visiteur N° ".($i+1)
            ]);
        }
        $form->add('submit', SubmitType::class, [
            'label'=>'Etape Suivante'

        ]);

        $formTicket=$form->getForm();

        return $this->render('billeterie/billet2.html.twig',[
            'order'=>$commande,
            'title'=>'Choix du billet',
            'ticketForm'=>$formTicket->createView()
        ]);
    }

    public function resume_order(Request $request)
    {
        $session = $request->getSession();
        $resume_order = new resume;





    }
}

