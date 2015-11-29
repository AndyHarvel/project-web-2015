<?php

namespace manharBundle\Controller;

use Symfony\Component\Validator\Constraints\NotBlank;
use manharBundle\Entity\symtable;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use manharBundle\Form\symtableType;
use Symfony\Component\HttpFoundation\RedirectResponse;


class symtableController extends Controller
{

public function deleteAction($id, Request $request) {

    $em = $this->getDoctrine()->getManager();
    $symtable = $em->getRepository('manharBundle:symtable')->find($id);
    if (!$symtable) {
      throw $this->createNotFoundException(
              'No symtable found for id ' . $id
      );
    }

    $form = $this->createFormBuilder($symtable)
            ->add('delete', 'submit')
            ->getForm();

    $form->handleRequest($request);


    if ($form->isValid()) {
      $em->remove($symtable);
      unlink('uploads/'.$id.'.jpeg');
      $em->flush();
       return new RedirectResponse($this->generateUrl('manhar_list'));

    }
    
    $build['form'] = $form->createView();
    return $this->render('manharBundle:symtable:ne.html.twig', $build);
}





public function listAction()
{
  $symtable = $this->getDoctrine()->getRepository("manharBundle:symtable")->findAll();
   $build['symtable'] = $symtable;
   return $this->render('manharBundle:symtable:x.html.twig', $build);
}

public function attaquantAction()
{
  $symtable = $this->getDoctrine()->getRepository("manharBundle:symtable")->findAll();
   $build['symtable'] = $symtable;
   return $this->render('manharBundle:symtable:atta.html.twig', $build);
}

public function millieuAction()
{
  $symtable = $this->getDoctrine()->getRepository("manharBundle:symtable")->findAll();
   $build['symtable'] = $symtable;
   return $this->render('manharBundle:symtable:mill.html.twig', $build);
}



public function gardienAction()
{
  $symtable = $this->getDoctrine()->getRepository("manharBundle:symtable")->findAll();
   $build['symtable'] = $symtable;
   return $this->render('manharBundle:symtable:gar.html.twig', $build);
}

public function defenseurAction()
{
  $symtable = $this->getDoctrine()->getRepository("manharBundle:symtable")->findAll();
   $build['symtable'] = $symtable;
   return $this->render('manharBundle:symtable:def.html.twig', $build);
}


 public function aboutAction()
    {
        return $this->render('manharBundle:symtable:apropos.html.twig');
    }



public function showAction($id) {
      $symtable = $this->getDoctrine()
            ->getRepository('manharBundle:symtable')
            ->find($id);
      if (!$symtable) {
        throw $this->createNotFoundException('No news found by id ' . $id);
      }
    
      $build['symtable'] = $symtable;
      return $this->render('manharBundle:symtable:show.html.twig', $build);

}


public function editAction($id, Request $request) {

    $em = $this->getDoctrine()->getManager();
    $symtable = $em->getRepository('manharBundle:symtable')->find($id);
    if (!$symtable) {
      throw $this->createNotFoundException('No news found for id ' . $id);
    }
   
$form = $this->createForm(new symtableType(), $symtable);
     $form->handleRequest($request);


$validator = $this->get('validator');

    if ($form->isValid()) {

          $file = $symtable->getPhoto();

if (file_exists($file)) {
    echo "Le fichier $file existe.";



                $op = $symtable->getId();                  
               $fileName = $op.'.'.'jpeg';
              $photoDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads';
             $file->move($photoDir, $fileName);
             $symtable->setPhoto($fileName);
             $symtable->getId();
             $em->flush();

} else {
    echo "Le fichier $file n'existe pas.";
}
         $em->flush();
         return new RedirectResponse($this->generateUrl('manhar_list'));
    }
    
    $build['form'] = $form->createView();

    return $this->render('manharBundle:symtable:edit.html.twig', $build);
  }

public function ajoutAction(Request $request) {

     $symtable = new symtable();
     $form = $this->createForm(new symtableType(), $symtable);
     $form->handleRequest($request);    
    
       if ($form->isValid()) {
       $em = $this->getDoctrine()->getManager();
       $em->persist($symtable);
       $em->flush();

        $title = $form->get('title')->getData();
         
              $file = $symtable->getPhoto();
                $op = $symtable->getId();
                $fileName = $op.'.'.'jpeg'; 
            $photoDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads';
            $file->move($photoDir, $fileName);
            $symtable->setPhoto($fileName);
            $symtable->getId();
           return new RedirectResponse($this->generateUrl('manhar_list'));
     }

     $build['form'] = $form->createView();
     return $this->render('manharBundle:symtable:ajout.html.twig', $build);

 }



}