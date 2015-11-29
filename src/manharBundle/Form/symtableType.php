<?php
// src/Blogger/BlogBundle/Form/EnquiryType.php

namespace manharBundle\Form;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use manharBundle\Entity\symtable;

class symtableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title','choice', array('choices' => symtable::getTypes(), 'expanded' => true))->add('photo', 'file', array('data_class' => null))->add('coment','textarea')->add('author', 'text')->add('date', 'date')->add('time', 'time')->add('submit', 'submit');
                        
        //$builder->add('body', 'textarea');
    }

    public function getName()
    {
        return 'contact';
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'manharBundle\Entity\symtable',
        ));
    }


   public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('title', new NotBlank());
         $metadata->addPropertyConstraint('coment', new NotBlank());
        $metadata->addPropertyConstraint('author', new NotBlank());
       $metadata->addPropertyConstraint('photo', new NotBlank());
    }

}







