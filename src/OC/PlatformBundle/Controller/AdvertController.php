<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

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
  public function viewAction($id, Request $request)
  {
    $tag = $request->query->get('tag');

//    return new Response(
//         "affichage de l'annonce d'id: ".$id
//        ." avec le tag: ".$tag
//        );

//    return $this
//        ->get('templating')
//        ->renderResponse('OCPlatformBundle:Advert:view.html.twig'
//            , array('id' => $id, 'tag' => $tag)
//            );
    return $this->render('OCPlatformBundle:Advert:view.html.twig',
        array(
           'id'   => $id
          ,'tag'  => $tag
          ,'name' => 'sam'  // Test
        ));
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