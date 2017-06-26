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
  // ========================================
  public function byeAction()
  {
    $content = $this->get('templating')
        ->render('OCPlatformBundle:Advert:bye.html.twig',
            array('nom' => "Sam")
            );

    return new Response($content);
  }
  // ========================================
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
  // ========================================
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
  // ========================================
  public function redirectAction()
  {
    return $this->redirectToRoute('oc_platform_home');
  }
  // ========================================
  public function sessionAction(Request $request)
  {
    $session = $request->getSession();

    $userId = $session->get('user_id');

    $session->set('user_id', 91);

    return new Response("<body>Je suis une page de test</body>");
  }
  // ========================================
  public function addAction(Request $request)
  {
    $session = $request->getSession();

    // Bien sûr, cette méthode devra réellement ajouter l'annonce

    // Mais faisons comme si c'était le cas
    $session->getFlashBag()->add('info', 'Annonce bien enregistrée');

    // Le « flashBag » est ce qui contient les messages flash dans la session
    // Il peut bien sûr contenir plusieurs messages :
    $session->getFlashBag()->add('info', 'Oui oui, elle est bien enregistrée !');

    // Puis on redirige vers la page de visualisation de cette annonce
    return $this->redirectToRoute('oc_platform_viewflash', array('id' => 5));
  }
  // ========================================
  public function viewFlashAction($id, Request $request)
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
    return $this->render('OCPlatformBundle:Advert:viewFlashSession.html.twig',
        array(
           'id'   => $id
          ,'tag'  => $tag
          ,'name' => 'sam'  // Test
        ));
  }
}