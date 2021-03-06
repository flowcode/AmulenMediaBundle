<?php

namespace Flowcode\MediaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GalleryItemType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('position', 'hidden')
            ->add('page')
            ->add('link')
            ->add('description')
            ->add('media', new MediaType())
            ->add('gallery')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amulen\MediaBundle\Entity\GalleryItem'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'flowcode_mediabundle_galleryitem';
    }
}
