<?php

namespace App\Form;

use App\Entity\Clients;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom du client : ',
                'required' => true
            ])
            //email valide en utilisant Filter de PHP ou la vadilation de symfony
            ->add('email', TextType::class, [
                'label' => 'Email du client : ',
                'required' => true
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Adresse du client : ',
                'required' => true
            ])
            // tous nombre puis formatter vers le standard E.164
            ->add('telephone', TextType::class, [
                'label' => 'Téléphone du client : ',
                'required' => true
            ])
            // tous nombre
            ->add('cin', TextType::class, [
                'label' => 'CIN du client : ',
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Clients::class,
        ]);
    }
}
