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

class HomeController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function homepage()
    {

       return $this->render('homepage/home.html.twig', [
        'title'=>'Accueil'


       ]) ;
    }

    /**
     * @Route("/reservation")
     */
    public function show()
    {
            return $this->render('reservation/show.html.twig');
    }
}

