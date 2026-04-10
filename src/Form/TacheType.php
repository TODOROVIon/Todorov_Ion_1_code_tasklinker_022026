<?php

namespace App\Form;

use App\Entity\Status;
use App\Entity\Tache;
use App\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TacheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Titre',
                'attr' => ['class' => 'form-control']
            ])
            ->add('description', null, [
                'label' => 'Description',
                'required' => false,
                'attr' => ['class' => 'form-control', 'rows' => 4]
            ])
            ->add('deadline', DateType::class, [
                'label' => 'Date',
                'widget' => 'single_text',
                'html5' => true,
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('idStatus', EntityType::class, [
                'class' => Status::class,
                'choice_label' => 'name',
                'label' => 'Statut',
                'attr' => ['class' => 'form-control']
            ])
            ->add('idUser', EntityType::class, [
                'class' => Users::class,
                'choices' => $options['project'] ? $options['project']->getUsers() : [],
                'choice_label' => function(Users $user) {
                    return $user->getFirstName() . ' ' . $user->getLastName();
                },
                'label' => 'Membre',
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tache::class,
            'project' => null,
        ]);
    }
}
