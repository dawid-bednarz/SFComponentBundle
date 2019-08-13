<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */
declare(strict_types=1);

namespace DawBed\ComponentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\Expression;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\NotBlank;

class ListType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('orderBy', CollectionType::class, [
            'data' => array_combine($options['available_sort_column'], array_fill(0, count($options['available_sort_column']), null)),
            'constraints' => [
                new All([
                    new Expression(['expression' => 'value in ["DESC","ASC",null]'])
                ])
            ]]);
        $builder->add('page', null, [
            'constraints' => [
                new GreaterThan(['value' => 0]),
                new NotBlank()
            ]
        ]);
        $builder->add('itemsOnPage', null, [
            'constraints' => [
                new GreaterThan(['value' => 0]),
                new LessThan(['value' => 40]),
                new NotBlank()
            ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'method' => 'GET',
            'available_sort_column' => []
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}