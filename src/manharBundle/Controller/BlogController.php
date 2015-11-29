<?php
// src/Sdz/BlogBundle/Controller/BlogController.php

use manharBundle\Entity\Article;

// …

public function ajouterAction()
{
  // On crée un objet Article
  $article = new Article();

  // On crée le FormBuilder grâce à la méthode du contrôleur
  $formBuilder = $this->createFormBuilder($article);

  // On ajoute les champs de l'entité que l'on veut à notre formulaire
  $formBuilder
    ->add('date',        'date')
    ->add('titre',       'text')
    ->add('contenu',     'textarea')
    ->add('auteur',      'text')
    ->add('publication', 'checkbox');
  // Pour l'instant, pas de commentaires, catégories, etc., on les gérera plus tard

  // À partir du formBuilder, on génère le formulaire
  $form = $formBuilder->getForm();

  // On passe la méthode createView() du formulaire à la vue afin qu'elle puisse afficher le formulaire toute seule
  return $this->render('manharBundle:Blog:ajouter.html.twig', array(
    'form' => $form->createView(),
  ));
}
