<?php
/**
 * Created by PhpStorm.
 * User: drcha
 * Date: 04/06/2018
 * Time: 20:29
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    /**
     * @Route("/")
     */
    public function homepage()
    {
       return new Response('test  homepage') ;
    }

    /**
     * @Route("/reservation")
     */
    public function BookingPage()
    {
            return new Response('Future page de reservation avec formulaire');
    }
}

