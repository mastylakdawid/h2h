<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, ['label' => 'Imię'])
            ->add('lastName', TextType::class, ['label' => 'Nazwisko'])
            ->add('email', TextType::class, ['label' => 'Adres e-mail'])
            ->add('subiect', ChoiceType::class, [
                'choices'  => [
                    'wybierz...' => '',
                    'Praca' => 'Praca',
                    'Inne' => 'Inne'
                ],
                'label' => 'Temat'
            ])
            ->add('message', TextareaType::class, ['label' => 'Wiadomość'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class
        ]);
    }
}
