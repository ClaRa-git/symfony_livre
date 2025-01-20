<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    // Propriété pour encoder le mot de passe
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // Appel de la méthode pour générer des utilisateurs
        $this->loadUsers($manager);

        // Sauvegarde des données
        $manager->flush();
    }

    /**
     * Méthode pour générer des utlisateurs
     * @param ObjectManager $manager
     * @return void
     */
    public function loadUsers(ObjectManager $manager): void
    {
        // Création d'un tableau avec les infos des utilisateurs
        $array_users = [
            [
                'email' => "admin@admin.com",
                'password' => 'admin',
                'roles' => ['ROLE_ADMIN'],
                'username' => 'administrateur'
            ],
            [
                'email' => "user@user.com",
                'password' => 'user',
                'roles' => ['ROLE_USER'],
                'username' => 'utilisateur'
            ]
        ];

        // Boucle pour créer les utilisateurs
        foreach ($array_users as $user) {
            // Création d'un nouvel utilisateur
            $new_user = new User();
            $new_user->setEmail($user['email']);
            $new_user->setPassword($this->encoder->hashPassword($new_user, $user['password']));
            $new_user->setRoles($user['roles']);
            $new_user->setUsername($user['username']);

            // Sauvegarde de l'utilisateur
            $manager->persist($new_user);
        }
    }
}