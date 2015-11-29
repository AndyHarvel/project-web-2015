<?php

namespace manharBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use manharBundle\Entity\Default;

class DefaultController extends Controller{
  
 public function indexAction(){
  $content = $this->get('templating')->render('manharBundle:Default:index.html.twig');        
  return new Response($content);
  }
/*
 public function addAction($id){
    $response = new Response;
    $response->setContent("Ceci est une page d'erreur 404");
    $response->setStatusCode(Response::HTTP_NOT_FOUND);
    return new Response($response);
  }

  public function viewSlugAction($slug, $year, $format){
        return new Response("On pourrait afficher l'annonce correspondant au slug '".$slug."', créée en ".$year." et au format ".$format.".");
    }


public function viewAction($id, Request $request)
  {
    $tag = $request->query->get('tag');
    return new Response("Affichage de l'annonce d'id : ".$id.", avec le tag : ".$tag);
  }



public function viewAction($id)
  {
    return new Response("Affichage de l'annonce d'id : ".$id);
  }


public function viewAction($id)
  {
    return $this->render('manharBundle:Default:index.html.twig',array('id'  => $id));
  }

public function viewAction($id)
{
  $url = $this->get('router')->generate('manhar_homepage');
    
  return $this->redirect($url);
}

 public function viewAction($id)
  {
return new JsonResponse(array('id' => $id));
}

public function viewAction($id, Request $request)
  {
    // Récupération de la session
    $session = $request->getSession();
    
    // On récupère le contenu de la variable user_id
    $userId = $session->get('user_id');

    // On définit une nouvelle valeur pour cette variable user_id
    $session->set('user_id', 91);

    // On n'oublie pas de renvoyer une réponse
    return new Response("Je suis une page de test, je n'ai rien à dire");
  }
 




public function viewAction($id)
  {
    return $this->render('manharBundle:Default:index.html.twig', array('id' => $id));
  }
    
  // Ajoutez cette méthode :
  public function addAction(Request $request)
  {
    $session = $request->getSession();
    $session->getFlashBag()->add('info', 'Annonce bien enregistrée');
    $session->getFlashBag()->add('info', 'Oui oui, il est bien enregistré !');
    return $this->redirect($this->generateUrl('manhar_view', array('id' => 5)));
  }



*/
public function addAction(Request $request)
  {
    $default = new Default();

    $formBuilder = $this->get('form.factory')->createBuilder('form', $default);

    $formBuilder
      ->add('date',      'date')
      ->add('title',     'text')
      ->add('content',   'textarea')
      ->add('author',    'text')
      ->add('published', 'checkbox')
      ->add('save',      'submit');

    $form = $formBuilder->getForm();

    return $this->render('manharBundle:Default:add.html.twig', array('form' => $form->createView(),));
  }
 
}

