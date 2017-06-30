<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{
  public function indexAction($page)
  {
    if ($page < 1) {
      throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
    }

    // Notre liste d'annonce en dur
    $listAdverts = array(
      array(
        'title'   => 'Recherche développpeur Symfony',
        'id'      => 1,
        'author'  => 'Alexandre',
        'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
        'date'    => new \Datetime()),
      array(
        'title'   => 'Mission de webmaster',
        'id'      => 2,
        'author'  => 'Hugo',
        'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
        'date'    => new \Datetime()),
      array(
        'title'   => 'Offre de stage webdesigner',
        'id'      => 3,
        'author'  => 'Mathieu',
        'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
        'date'    => new \Datetime())
    );

    return $this->render('OCPlatformBundle:Advert:index.html.twig', array(
      'listAdverts' => $listAdverts,
    ));
  }

  public function viewAction($id)
  {
    $advert = array(
      'title'   => 'Recherche développpeur Symfony',
      'id'      => $id,
      'author'  => 'Alexandre',
      'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
      'date'    => new \Datetime()
    );

    return $this->render('OCPlatformBundle:Advert:view.html.twig', array(
      'advert' => $advert
    ));
  }

  // ========================================
  // Route: http://localhost/Symfony/web/app_dev.php/platform/add
  public function addAction(Request $request)
  {
    $advert = new \OC\PlatformBundle\Entity\Advert;

    $this->testWriteAdvert($advert);

    // Si la requête est en POST, c'est que le visiteur a soumis le formulaire
    if ($request->isMethod('POST')) {
      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

      // Puis on redirige vers la page de visualisation de cettte annonce
      return $this->redirectToRoute('oc_platform_view', array('id' => 5));
    }

    // Si on n'est pas en POST, alors on affiche le formulaire
    return $this->render('OCPlatformBundle:Advert:add.html.twig');
  }

  public function editAction($id, Request $request)
  {
    if ($request->isMethod('POST')) {
      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

      return $this->redirectToRoute('oc_platform_view', array('id' => 5));
    }

    $advert = array(
      'title'   => 'Recherche développpeur Symfony',
      'id'      => $id,
      'author'  => 'Alexandre',
      'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
      'date'    => new \Datetime()
    );

    return $this->render('OCPlatformBundle:Advert:edit.html.twig', array(
      'advert' => $advert
    ));
  }

  public function deleteAction($id)
  {
    return $this->render('OCPlatformBundle:Advert:delete.html.twig');
  }

  public function menuAction($limit)
  {
    // On fixe en dur une liste ici, bien entendu par la suite on la récupérera depuis la BDD !
    $listAdverts = array(
      array('id' => 2, 'title' => 'Recherche développeur Symfony'),
      array('id' => 5, 'title' => 'Mission de webmaster'),
      array('id' => 9, 'title' => 'Offre de stage webdesigner')
    );

    return $this->render('OCPlatformBundle:Advert:menu.html.twig', array(
      // Tout l'intérêt est ici : le contrôleur passe les variables nécessaires au template !
      'listAdverts' => $listAdverts
    ));
  }
  // ========================================
  // Exemple: http://localhost/Symfony/web/app_dev.php/platform/find/Sam
  public function findAction($author)
  {
    $repository = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Advert');
    $listAdverts = $repository->findOneByAuthor($author);

    if (null === $listAdverts) {
      throw new \Symfony\Component\Translation\Exception\NotFoundResourceException("L'auteur ".$author." n'existe pas dans la BDD");
    }

    return $this->render('OCPlatformBundle:Advert:findByAuthor.html.twig',
        array('author' => $author,
              'result' => $listAdverts)
        );
  }
  // ========================================
  public function testSamAction()
  {
    $repository = $this->getDoctrine()->getManager()
        ->getRepository('OCPlatformBundle:Advert');

    $messages = $repository->find(1);

    if (null === $messages) {
      throw new NotFoundHttpException("l'id 1 n'existe pas dans la BDD");
    }

      return $this->render('OCPlatformBundle:Advert:testSam.html.twig',
          array('advert' => $messages));
  }

  // ========================================
  // Appelez par addAction()
  private function testWriteAdvert(\OC\PlatformBundle\Entity\Advert $advert)
  {
    $img = new \OC\PlatformBundle\Entity\Image;

    $img->setUrl("blabla.com>/img/img5.jpg");
    $img->setAlt("blabla.com/alt/alt5.jpg");

    $advert->setTitle('Recherche développeur C.');
    $advert->setAuthor('Olivier');
    $advert->setContent("Nous recherchons un développeur C");
    $advert->setPublished(false);
    $advert->setImage($img);

    // On peut ne pas définir ni la date ni la publication,
    // car ces attributs sont définis automatiquement dans le constructeur

    // On récupère l'EntityManager
    $em = $this->getDoctrine()->getManager();

    // Étape 1 : On « persiste » l'entité
    $em->persist($advert);

    // Étape 2 : On « flush » tout ce qui a été persisté avant
    $em->flush();
  }
}