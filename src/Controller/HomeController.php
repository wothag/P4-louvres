<?php
/**
 * Created by PhpStorm.
 * User: drcha
 * Date: 04/06/2018
 * Time: 20:29
 */

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{

    /**
     * @Route("/")
     */
    public function homepage(Request $request)
    {
       $session = $request->getSession();
       $session->set("id", "8");
       return $this->render('homepage/home.html.twig', [
        'title'=>'Accueil'

       ]) ;
    }

}

