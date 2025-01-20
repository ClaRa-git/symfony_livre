<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Editor;
use App\Entity\Serie;
use App\Entity\Type;
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

        // Appel de la méthode pour générer des genres littéraires
        $this->loadTypes($manager);

        // Appel de la méthode pour générer des éditeurs
        $this->loadEditors($manager);

        // Appel de la méthode pour générer des auteurs
        $this->loadAuthors($manager);

        // Appel de la méthode pour générer des séries littéraires
        $this->loadSeries($manager);

        // Appel de la méthode pour générer des livres
        $this->loadBooks($manager);

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

    /**
     * Méthode pour générer des genres littéraires
     * @param ObjectManager $manager
     * @return void
     */
    public function loadTypes(ObjectManager $manager): void
    {
        // Création d'un tableau avec les genres littéraires
        $array_types = [
            "Horreur",
            "Romance",
            "Aventure",
            "Science-fiction",
            "Fantasy",
            "Policier",
            "Thriller",
            "Comédie",
            "Drame",
            "Historique",
            "Mystère",
            "Action",
            "Suspense",
            "Jeunesse",
        ];

        // Boucle pour créer les genres littéraires
        foreach ($array_types as $key => $value) {
            $type = new Type();
            $type->setLabel($value);
            $manager->persist($type);

            // Définition des références
            $this->addReference('type_' . $key + 1, $type);
        }
    }

    /** Méthode pour générer des éditeurs
     * @param ObjectManager $manager
     * @return void
     */
    public function loadEditors(ObjectManager $manager): void
    {
        // Création d'un tableau avec les éditeurs
        $array_editors = [
            [
                'name' => 'Gallimard',
                'address' => '5 rue Gaston-Gallimard, 75007 Paris'
            ],
            [
                'name' => 'Hachette',
                'address' => '58 rue Jean-Bleuzen, 92170 Vanves'
            ],
            [
                'name' => 'Flammarion',
                'address' => '26 rue Racine, 75006 Paris'
            ]
        ];

        // Boucle pour créer les éditeurs
        foreach ($array_editors as $key => $value) {
            $editor = new Editor();
            $editor->setName($value['name']);
            $editor->setAdress($value['address']);
            $manager->persist($editor);

            // Définition des références
            $this->addReference('editor_' . $key + 1, $editor);
        }
    }

    /**
     * Méthode pour générer des auteurs
     * @param ObjectManager $manager
     * @return void
     */
    public function loadAuthors(ObjectManager $manager): void
    {
        // Création d'un tableau avec les auteurs
        $array_authors = [
            [
                'name' => 'Rowling',
                'firstname' => 'J.K.',
                'biography' => 'J.K. Rowling est une romancière britannique, auteure de la série Harry Potter. Elle a vendu plus de 500 millions de livres dans le monde entier et a remporté de nombreux prix littéraires pour ses écrits. Elle est également connue pour son engagement en faveur des droits des enfants et des femmes.',
            ],
            [
                'name' => 'Tolkien',
                'firstname' => 'J.R.R.',
                'biography' => 'J.R.R. Tolkien est un écrivain britannique, auteur de la trilogie Le Seigneur des Anneaux. Il est considéré comme l’un des plus grands écrivains de fantasy de tous les temps et a influencé de nombreux auteurs de fantasy et de science-fiction. Il a vendu plus de 150 millions de livres dans le monde entier et a remporté de nombreux prix littéraires pour ses écrits.',
            ],
            [
                'name' => 'Martin',
                'firstname' => 'George R.R.',
                'biography' => 'George R.R. Martin est un écrivain américain, auteur de la série Le Trône de Fer. Il est considéré comme l’un des plus grands écrivains de fantasy de tous les temps et a influencé de nombreux auteurs de fantasy et de science-fiction. Il a vendu plus de 90 millions de livres dans le monde entier et a remporté de nombreux prix littéraires pour ses écrits.',
            ]
        ];

        // Boucle pour créer les auteurs
        foreach ($array_authors as $key => $value) {
            $author = new Author();
            $author->setName($value['name']);
            $author->setFirstname($value['firstname']);
            $author->setBiography($value['biography']);
            $manager->persist($author);

            // Définition des références
            $this->addReference('author_' . $key + 1, $author);
        }
    }

    /**
     * Méthode pour générer des séries littéraires
     * @param ObjectManager $manager
     * @return void
     */
    public function loadSeries(ObjectManager $manager): void
    {
        // Création d'un tableau avec les séries littéraires
        $array_series = [
            [
                'title' => 'Harry Potter',
                'description' => 'Harry Potter est un garçon ordinaire. Mais le jour de ses onze ans, son existence bascule : un géant vient le chercher pour l’emmener à Poudlard, l’école de sorcellerie ! Voler en balai, jeter des sorts, combattre les trolls : Harry se révèle un sorcier doué. Mais un mystère entoure sa naissance et l’effroyable V..., le mage dont personne n’ose prononcer le nom. Amitié, surprises, dangers, scènes comiques, Harry découvre ses pouvoirs et la vie à Poudlard. Le premier tome des aventures du jeune héros vous ensorcelle aussitôt !',
                'numberVolumes' => 7,
                'dateStarted' => new \DateTime('1997-06-26'),
                'isFinished' => true,
                'author' => [1],
                'type' => [3, 5, 14],
                'editor' => [1]
            ],
            [
                'title' => 'Le Seigneur des Anneaux',
                'description' => 'Dans les vertes prairies de la Comté, les Hobbits, ou Semi-hommes, vivaient en paix… jusqu’au jour fatal où l’un d’entre eux, au terme d’une longue quête, rapporta de sombres nouvelles. Sauron, le Seigneur des Ténèbres, avait jadis forgé un Anneau unique, le Ruling, qui contenait une part de son âme. Désormais, Sauron cherchait à s’en emparer',
                'numberVolumes' => 3,
                'dateStarted' => new \DateTime('1954-07-29'),
                'isFinished' => true,
                'author' => [2],
                'type' => [3, 5, 14],
                'editor' => [2]
            ],
            [
                'title' => 'Le Trône de Fer',
                'description' => 'Le royaume des sept couronnes est sur le point de connaître son plus terrible hiver : par-delà le mur qui garde sa frontière nord, une armée de ténèbres se lève, menaçant de tout détruire sur son passage. Mais il en faut plus pour refroidir les ardeurs des rois, des reines, des chevaliers et des renégats qui se disputent le trône de fer, tous les coups sont permis, et seuls les plus forts, ou les plus retors, s’en sortiront indemnes…',
                'numberVolumes' => 5,
                'dateStarted' => new \DateTime('1996-08-06'),
                'isFinished' => false,
                'author' => [3],
                'type' => [3, 5, 14],
                'editor' => [3]
            ]
        ];

        // Boucle pour créer les séries littéraires
        foreach ($array_series as $key => $value) {
            $new_serie = new Serie();
            $new_serie->setTitle($value['title']);
            $new_serie->setDescription($value['description']);
            $new_serie->setNumberVolume($value['numberVolumes']);
            $new_serie->setDateStarted($value['dateStarted']);
            $new_serie->setFinished($value['isFinished']);

            // Appel à des références pour les relations

            // Boucle pour ajouter les auteurs
            foreach ($value['author'] as $author) {
                $new_serie->addAuthor($this->getReference('author_' . $author));
            }
            
            // Boucle pour ajouter les genres littéraires
            foreach ($value['type'] as $type) {
                $new_serie->addType($this->getReference('type_' . $type));
            }

            // Boucle pour ajouter les éditeurs
            foreach ($value['editor'] as $editor) {
                $new_serie->addEditor($this->getReference('editor_' . $editor));
            }

            // Sauvegarde des séries littéraires
            $manager->persist($new_serie);

            // Définition des références
            $this->addReference('serie_' . $key + 1, $new_serie);
        }
    }

    /**
     * Méthode pour générer des livres
     * @param ObjectManager $manager
     * @return void
     */
    public function loadBooks(ObjectManager $manager): void
    {
        $array_books = [
            [
                'title' => 'Harry Potter à l\'école des sorciers',
                'numberPage' => 320,
                'description' => 'Harry Potter est un garçon ordinaire. Mais le jour de ses onze ans, son existence bascule : un géant vient le chercher pour l’emmener à Poudlard, l’école de sorcellerie ! Voler en balai, jeter des sorts, combattre les trolls : Harry se révèle un sorcier doué. Mais un mystère entoure sa naissance et l’effroyable V..., le mage dont personne n’ose prononcer le nom. Amitié, surprises, dangers, scènes comiques, Harry découvre ses pouvoirs et la vie à Poudlard. Le premier tome des aventures du jeune héros vous ensorcelle aussitôt !',
                'releaseDate' => new \DateTime('1998-10-02'),
                'imagePath' => 'harry-potter-a-lecole-des-sorciers.jpg',
                'price' => 1050,
                'isbn' => '9782070612369',
                'serie' => 1
            ],
            [
                'title' => 'Harry Potter et la Chambre des secrets',
                'numberPage' => 352,
                'description' => 'Une rentrée fracassante en voiture volante, une étrange malédiction qui s’abat sur les élèves, cette deuxième année à l’école des sorciers ne s’annonce pas de tout repos ! Entre les cours de potions magiques, les matches de Quidditch et les combats de mauvais sorts, Harry et ses amis Ron et Hermione trouveront-ils le temps de percer le mystère de la Chambre des Secrets ? Le deuxième tome des aventures de Harry Potter vous emportera dans un tourbillon de surprises et d’émotions. Frissons et humour garantis !',
                'releaseDate' => new \DateTime('1999-07-02'),
                'imagePath' => 'harry-potter-et-la-chambre-des-secrets.jpg',
                'price' => 1050,
                'isbn' => '9782070612376',
                'serie' => 1
            ],
            [
                'title' => 'Harry Potter et le Prisonnier d\'Azkaban',
                'numberPage' => 448,
                'description' => 'Sirius Black, le dangereux criminel qui s’est échappé de la forteresse d’Azkaban, recherche Harry Potter. C’est donc sous bonne garde que l’apprenti sorcier fait sa troisième rentrée à Poudlard. Mais est-il vraiment hors de danger ? Le troisième tome des aventures de Harry Potter vous emportera dans un tourbillon de surprises et d’émotions. Frissons et humour garantis !',
                'releaseDate' => new \DateTime('1999-10-02'),
                'imagePath' => 'harry-potter-et-le-prisonnier-dazkaban.jpg',
                'price' => 1050,
                'isbn' => '9782070612383',
                'serie' => 1
            ],
            [
                'title' => 'Harry Potter et la Coupe de feu',
                'numberPage' => 640,
                'description' => 'Harry Potter a quatorze ans et entre en quatrième année au collège de Poudlard. Une grande nouvelle attend Harry, Ron et Hermione à leur arrivée : la tenue d’un tournoi de magie exceptionnel entre les plus célèbres écoles de sorcellerie. Déjà les délégations étrangères font leur entrée. Harry se réjouit… Trop vite. Il va se trouver plongé au cœur des événements les plus dramatiques qu’il ait jamais eu à affronter.',
                'releaseDate' => new \DateTime('2000-10-02'),
                'imagePath' => 'harry-potter-et-la-coupe-de-feu.jpg',
                'price' => 1050,
                'isbn' => '9782070612390',
                'serie' => 1
            ],
            [
                'title' => 'Harry Potter et l\'Ordre du Phénix',
                'numberPage' => 992,
                'description' => 'À quinze ans, Harry entre en cinquième année à Poudlard, mais il n’a jamais été si anxieux. L’adolescence, la perspective des examens et ces étranges cauchemars… Car Celui-Dont-On-Ne-Doit-Pas-Prononcer-Le-Nom est de retour et, plus que jamais, Harry sent peser sur lui une terrible menace. Une menace que le ministère de la Magie ne semble pas prendre au sérieux, contrairement à Dumbledore. Poudlard devient alors le terrain d’une véritable lutte de pouvoir. La résistance s’organise autour de Harry qui va devoir compter sur le courage et la fidélité de ses amis de toujours…',
                'releaseDate' => new \DateTime('2003-06-02'),
                'imagePath' => 'harry-potter-et-lordre-du-phenix.jpg',
                'price' => 1050,
                'isbn' => '9782070612406',
                'serie' => 1
            ],
            [
                'title' => 'Harry Potter et le Prince de sang-mêlé',
                'numberPage' => 704,
                'description' => 'Dans un monde de plus en plus inquiétant, Harry se prépare à retrouver Ron et Hermione. Bientôt, ce sera la rentrée à Poudlard, avec les autres étudiants de sixième année. Mais pourquoi Dumbledore vient-il en personne chercher Harry chez les Dursley ? Dans quels extraordinaires voyages au cœur de la mémoire va-t-il l’entraîner ?',
                'releaseDate' => new \DateTime('2005-10-02'),
                'imagePath' => 'harry-potter-et-le-prince-de-sang-mele.jpg',
                'price' => 1050,
                'isbn' => '9782070612413',
                'serie' => 1
            ],
            [
                'title' => 'Harry Potter et les Reliques de la Mort',
                'numberPage' => 832,
                'description' => 'Harry Potter a été chargé de cette tâche, et il la mènera jusqu’au bout. Accompagné de Ron et Hermione, il mettra tout en œuvre pour trouver le dernier Horcruxe et détruire Voldemort. Rien ne pourra les arrêter. La bataille finale est proche, et seuls les plus forts survivront. Dans ce dernier tome de la série Harry Potter, J.K. Rowling révèle enfin tous les secrets de la saga. Les fans de Harry Potter ne seront pas déçus.',
                'releaseDate' => new \DateTime('2007-10-02'),
                'imagePath' => 'harry-potter-et-les-reliques-de-la-mort.jpg',
                'price' => 1050,
                'isbn' => '9782070612420',
                'serie' => 1
            ],
            [
                'title' => 'Le Seigneur des Anneaux - La Communauté de l\'Anneau',
                'numberPage' => 576,
                'description' => 'Frodon Sacquet, un Hobbit de la Comté, hérite d’un anneau. Mais ce n’est pas un anneau ordinaire : c’est l’Anneau Unique, un instrument de pouvoir absolu qui permettrait à Sauron, le Seigneur des Ténèbres, de régner sur la Terre du Milieu et de réduire en esclavage ses peuples. Frodon doit quitter la Comté et entreprendre un long voyage pour détruire l’Anneau. Il sera aidé dans sa quête par huit compagnons : Gandalf le Gris, Aragorn le Rôdeur, Legolas l’Elfe, Gimli le Nain, Boromir de Gondor, et ses trois cousins Merry, Pippin et Sam. Ensemble, ils formeront la Communauté de l’Anneau, et devront affronter de nombreux dangers pour atteindre le Mordor, où l’Anneau pourra être détruit.',
                'releaseDate' => new \DateTime('1954-07-29'),
                'imagePath' => 'le-seigneur-des-anneaux-la-communaute-de-lanneau.jpg',
                'price' => 1050,
                'isbn' => '9782070612369',
                'serie' => 2
            ],
            [
                'title' => 'Le Seigneur des Anneaux - Les Deux Tours',
                'numberPage' => 448,
                'description' => 'La Communauté de l’Anneau s’est brisée. Frodon et Sam poursuivent leur voyage vers le Mordor, accompagnés par Gollum, une créature étrange qui a jadis possédé l’Anneau. Mais ils ignorent que Gollum les mène droit dans un piège tendu par Sauron. Pendant ce temps, Aragorn, Legolas et Gimli partent à la recherche de Merry et Pippin, enlevés par les Orques de Saroumane. Ils seront aidés dans leur quête par Gandalf, qui a survécu à sa chute dans les ténèbres de Khazad-dûm. Les Deux Tours est le deuxième tome de la trilogie Le Seigneur des Anneaux, de J.R.R. Tolkien.',
                'releaseDate' => new \DateTime('1954-11-11'),
                'imagePath' => 'le-seigneur-des-anneaux-les-deux-tours.jpg',
                'price' => 1050,
                'isbn' => '9782070612376',
                'serie' => 2
            ],
            [
                'title' => 'Le Seigneur des Anneaux - Le Retour du Roi',
                'numberPage' => 464,
                'description' => 'La guerre de l’Anneau est terminée. Sauron a été vaincu, et l’Anneau Unique a été détruit. Mais la victoire a un goût amer pour Frodon Sacquet, qui a été gravement blessé lors de sa quête. Il rentre à la Comté, où il espère trouver la paix. Mais la Comté a été envahie par les Orques de Saroumane, qui ont pris le contrôle de la région. Frodon et ses amis Merry, Pippin et Sam doivent se lancer dans une nouvelle aventure pour libérer leur pays. Le Retour du Roi est le troisième tome de la trilogie Le Seigneur des Anneaux, de J.R.R. Tolkien.',
                'releaseDate' => new \DateTime('1955-10-20'),
                'imagePath' => 'le-seigneur-des-anneaux-le-retour-du-roi.jpg',
                'price' => 1050,
                'isbn' => '9782070612383',
                'serie' => 2
            ],
            [
                'title' => 'Le Trône de Fer - Le Trône de Fer',
                'numberPage' => 576,
                'description' => 'Le royaume des sept couronnes est sur le point de connaître son plus terrible hiver : par-delà le mur qui garde sa frontière nord, une armée de ténèbres se lève, menaçant de tout détruire sur son passage. Mais il en faut plus pour refroidir les ardeurs des rois, des reines, des chevaliers et des renégats qui se disputent le trône de fer, tous les coups sont permis, et seuls les plus forts, ou les plus retors, s’en sortiront indemnes…',
                'releaseDate' => new \DateTime('1996-08-06'),
                'imagePath' => 'le-trone-de-fer-le-trone-de-fer.jpg',
                'price' => 1050,
                'isbn' => '9782070612390',
                'serie' => 3
            ],
            [
                'title' => 'Le Trône de Fer - Le Donjon Rouge',
                'numberPage' => 576,
                'description' => 'Le royaume des sept couronnes est sur le point de connaître son plus terrible hiver : par-delà le mur qui garde sa frontière nord, une armée de ténèbres se lève, menaçant de tout détruire sur son passage. Mais il en faut plus pour refroidir les ardeurs des rois, des reines, des chevaliers et des renégats qui se disputent le trône de fer, tous les coups sont permis, et seuls les plus forts, ou les plus retors, s’en sortiront indemnes…',
                'releaseDate' => new \DateTime('1998-07-02'),
                'imagePath' => 'le-trone-de-fer-le-donjon-rouge.jpg',
                'price' => 1050,
                'isbn' => '9782070612406',
                'serie' => 3
            ],
            [
                'title' => 'Le Trône de Fer - La Bataille des Rois',
                'numberPage' => 576,
                'description' => 'Le royaume des sept couronnes est sur le point de connaître son plus terrible hiver : par-delà le mur qui garde sa frontière nord, une armée de ténèbres se lève, menaçant de tout détruire sur son passage. Mais il en faut plus pour refroidir les ardeurs des rois, des reines, des chevaliers et des renégats qui se disputent le trône de fer, tous les coups sont permis, et seuls les plus forts, ou les plus retors, s’en sortiront indemnes…',
                'releaseDate' => new \DateTime('2000-10-02'),
                'imagePath' => 'le-trone-de-fer-la-bataille-des-rois.jpg',
                'price' => 1050,
                'isbn' => '9782070612413',
                'serie' => 3
            ],
            [
                'title' => 'Le Trône de Fer - L\'Ombre Maléfique',
                'numberPage' => 576,
                'description' => 'Le royaume des sept couronnes est sur le point de connaître son plus terrible hiver : par-delà le mur qui garde sa frontière nord, une armée de ténèbres se lève, menaçant de tout détruire sur son passage. Mais il en faut plus pour refroidir les ardeurs des rois, des reines, des chevaliers et des renégats qui se disputent le trône de fer, tous les coups sont permis, et seuls les plus forts, ou les plus retors, s’en sortiront indemnes…',
                'releaseDate' => new \DateTime('2003-06-02'),
                'imagePath' => 'le-troen-de-fer-lombre-malefique.jpg',
                'price' => 1050,
                'isbn' => '9782070612420',
                'serie' => 3
            ]
        ];

        // Boucle pour créer les livres
        foreach ($array_books as $key => $value) {
            $new_book = new Book();
            $new_book->setTitle($value['title']);
            $new_book->setNumberPage($value['numberPage']);
            $new_book->setDescription($value['description']);
            $new_book->setReleaseDate($value['releaseDate']);
            $new_book->setImagePath($value['imagePath']);
            $new_book->setPrice($value['price']);
            $new_book->setIsbn($value['isbn']);

            // Appel à des références pour les relations
            $new_book->setSerie($this->getReference('serie_' . $value['serie']));

            // Sauvegarde des livres
            $manager->persist($new_book);
        }
    }
}
