<?php
/**
 * Created by PhpStorm.
 * User: drcha
 * Date: 04/06/2018
 * Time: 20:29
 */

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use App\Form\TicketType;
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

    public function billeterie(Request $request)
    {
        $session = $request->getSession();

        $order=new order;

        $form=$this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $session->set("order",$order);
            $em=$this->getDoctrine()->getManager();
            $em->persist($order);

            $this->addFlash('success' , "merci passons à l'étape suivante");
            return $this->redirectToRoute('app_billetterie2');

        }


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
        $order= $session->get("order");
        $form=$this->createFormBuilder();

        //CREATION D UNE BOUCLE POUR AFFICHAGE FORMULAIRE SELON LA VAR EECUPEREE
        $nombre_tickets = $order->getNbTickets();
        for ($i=0; $i<$nombre_tickets; $i++)
        {
            $form->add($i,TicketType::class, [
                "label"=>"visiteur".($i+1)
            ]);
        }
        $form->add('save', SubmitType::class, [
            'label'=>'continuer'

        ]);

        $formTicket=$form->getForm();

        return $this->render('billeterie/billet2.html.twig',[
            'order'=>$order,
            'title'=>'Choix du billet',
            'ticketForm'=>$formTicket->createView()
        ]);
    }
}

