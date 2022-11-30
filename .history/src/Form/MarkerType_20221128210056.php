<?php

namespace App\Form;

use App\Entity\Marker;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;

class MarkerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('url')
            ->add('category')
            ->add('favorite')
            ->add('tag', Select2EntityType::class,[
                'multiple' => true,
                'remote_route' => 'app_search_tag',
                'class' => 'App\Entity\Tag',
                'primary_key' => 'id',
                'text_property' => 'name',
                'minimum_input_length' => 2,
                'delay' => 3,
               
                'placeholder' => 'Select a tag',
                'allow_add' => [
                    'enabled' => true,
                    'new_tag_text' => '(new tag)',
                    'new_tag_prefix' => '__',
                    'tag_separators' => '[",", " "]',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Marker::class,
        ]);
    }
}
