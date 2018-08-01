<?php
/**
 * Created by PhpStorm.
 * User: drcha
 * Date: 19/06/2018
 * Time: 17:42
 */

namespace App\Form;

use App\Entity\Order;
use function Sodium\add;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class OrderType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_visit', DateType::class, [
                'label'=>'Date de visite :',
                'widget'=>'single_text',
                'html5'=>false,
                'format'=>'dd-MM-yyyy',
                'attr'=>[
                    'class'=>'datepicker'
                ]
            ])
            ->add('nb_tickets');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Order',
        ));
    }
}