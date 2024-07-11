<?php

namespace App\Form\Type;

use Ibexa\AdminUi\Form\Type\ContentType\ContentTypeChoiceType;
use Ibexa\AdminUi\Form\Type\DateTimePickerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ContentTypeModifiedContentsType.
 */
class ContentTypeModifiedContentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'content_type',
                ContentTypeChoiceType::class,
                [
                    'label' => false,
                    'multiple' => false,
                    'expanded' => false,
                ]
            )
            ->add(
                'date_from',
                DateTimePickerType::class,
                [
                    'label' => false,
                ]
            )
            ->add(
                'page',
                HiddenType::class
            )
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'ctmc';
    }
}