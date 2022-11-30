<?php

namespace App\Form;

use App\Entity\Marker;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('busqueda',TextType::class,[
                'label' => null,
                'constraints' => [
                    new \Symfony\Component\Validator\Constraints\NotBlank(),
                    new \Symfony\Component\Validator\Constraints\Length(['min' => 3]),
                ],
                'attr' => [
                    'placeholder' => 'Buscar',
                    'class' => 'form-control mr-sm-2',
                ],
            ])
            ->add('buscar',\Symfony\Component\Form\Extension\Core\Type\SubmitType::class,[
                'label' => 'Buscar',
                'attr' => [
                    'class' => 'btn btn-outline-success my-2 my-sm-0',
                ],
            ])

         
        ;
    }

   
}
