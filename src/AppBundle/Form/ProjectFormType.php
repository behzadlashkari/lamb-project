<?php

namespace AppBundle\Form;

use AppBundle\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ProjectFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('strapline')
            ->add('description')
            ->add('files', FileType::class, array('attr'=>array('class'=>'form-control'), 'multiple' => true))
            ->add('listingImage', FileType::class, array('attr'=>array('class'=>'form-control')))
            ->add('isPublished', ChoiceType::class, [
                'choices' => [
                    'Yes' => true,
                    'No' => false,
                ]
            ]);
    }

//    MIGHT NEED TO UNCOMMENT AND FIX CODE BELOW

//    public function setDefaultOptions(OptionsResolverInterface $resolver)
//    {
//        $resolver->setDefaults(
//            array(
//                'data_class' => 'AppBundle\Entity\ProductImages',
//            )
//        );
//    }



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => Project::class
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_project_form_type';
    }
}
