<?php
/**
 * Created by PhpStorm.
 * User: drcha
 * Date: 04/06/2018
 * Time: 20:29
 */

namespace App\Controller;

use App\Form\OrderType;
use App\Form\TicketType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{

    /**
     * @Route("/accueil" , name="app_homepage")
     */
    public function homepage(Request $request)
    {
       $session = $request->getSession();
       $session->set("id", "8");
       return $this->render('homepage/home.html.twig', [
        'title'=>'Bienvenue sur la billetterie en ligne du Louvre'

       ]) ;
    }

    /**
     * @Route("/billetterie" , name="app_billetterie")
     */

    public function billeterie(Request $request)
    {
        $form=$this->createForm(OrderType::class);
        $formTicket=$this->createForm(TicketType::class);

        return $this->render('billeterie/billet.html.twig',[
            'title'=>'Billetterie en ligne',
            'orderForm'=>$form->createView(),
            'ticketForm'=>$formTicket->createView()
        ]);
    }

    /**
     * @Route("/billetterie2" , name="app_billetterie2")
     */

    public function billeterie2(Request $request)
    {
        $formTicket=$this->createForm(TicketType::class);

        return $this->render('billeterie/billet2.html.twig',[
            'title'=>'Choix du billet',
            'ticketForm'=>$formTicket->createView()
        ]);
    }
}

