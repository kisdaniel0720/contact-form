<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Neved',
                'required' => false
            ])
            ->add('email', TextType::class, [
                'label' => 'E-mail címed',
                'required' => false
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Üzenet szövege',
                'required' => false,
                'attr' => [
                    "rows" => 5,
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Küldés'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
