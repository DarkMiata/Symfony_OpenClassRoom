<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AdvertController extends Controller
{
  public function indexAction($page)
  {
    $content = $this->get('templating')
        ->render('OCPlatformBundle:Advert:index.html.twig',
            array('nom' => "winzu", "page" => $page)
            );

    return new Response($content);
  }
  // ------------------------
  public function byeAction()
  {
    $content = $this->get('templating')
        ->render('OCPlatformBundle:Advert:bye.html.twig',
            array('nom' => "Sam")
            );

    return new Response($content);
  }
  // ------------------------
  public function viewAction($id)
  {
    return new Response("affichage de l'annonce d'id: ".$id);
  }
  // ------------------------
  public function viewSlugAction($year, $slug, $format)
  {
    $response = "On pourrait afficher l'annonce correspondant au slug "
        .$slug
        .", créé en "
        .$year
        ." et au format "
        .$format
        ;

    return new Response($response);
  }
  // ------------------------
}