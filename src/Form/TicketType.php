<?php

namespace App\Form;

use App\Entity\Ticket;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom', TextType::class, [
                'label'=>'Votre nom :'
            ])
            ->add('Prenom', TextType::class, [
                'label'=>'Votre prénom :'
            ])
            ->add('Naissance', BirthdayType::class, [
                'label'=>'Date de Naissance'
            ])
            ->add('pays', ChoiceType::class, [
                'required'=> false,
                'label'=>"Votre lieu de résidence",])
            ->add('reduction')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\Ticket',
        ]);
    }
}
