<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class PhotoDescriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'description',
                TextareaType::class,
                [
                    'required' => false
                ]
            )
        ;
    }

    public function getName()
    {
        return 'photo_description';
    }
}