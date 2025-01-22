<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250122133624 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE author (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, firstname VARCHAR(50) DEFAULT NULL, biography LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, serie_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, number_page INT NOT NULL, description LONGTEXT NOT NULL, release_date DATETIME NOT NULL, image_path VARCHAR(255) NOT NULL, price INT NOT NULL, isbn VARCHAR(30) NOT NULL, INDEX IDX_CBE5A331D94388BD (serie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE editor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, address VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE editor_serie (editor_id INT NOT NULL, serie_id INT NOT NULL, INDEX IDX_486828B06995AC4C (editor_id), INDEX IDX_486828B0D94388BD (serie_id), PRIMARY KEY(editor_id, serie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, number_volume INT NOT NULL, date_started DATETIME NOT NULL, is_finished TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie_author (serie_id INT NOT NULL, author_id INT NOT NULL, INDEX IDX_4A0583A1D94388BD (serie_id), INDEX IDX_4A0583A1F675F31B (author_id), PRIMARY KEY(serie_id, author_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_serie (type_id INT NOT NULL, serie_id INT NOT NULL, INDEX IDX_A43614C3C54C8C93 (type_id), INDEX IDX_A43614C3D94388BD (serie_id), PRIMARY KEY(type_id, serie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, username VARCHAR(30) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id)');
        $this->addSql('ALTER TABLE editor_serie ADD CONSTRAINT FK_486828B06995AC4C FOREIGN KEY (editor_id) REFERENCES editor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE editor_serie ADD CONSTRAINT FK_486828B0D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_author ADD CONSTRAINT FK_4A0583A1D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_author ADD CONSTRAINT FK_4A0583A1F675F31B FOREIGN KEY (author_id) REFERENCES author (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_serie ADD CONSTRAINT FK_A43614C3C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_serie ADD CONSTRAINT FK_A43614C3D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331D94388BD');
        $this->addSql('ALTER TABLE editor_serie DROP FOREIGN KEY FK_486828B06995AC4C');
        $this->addSql('ALTER TABLE editor_serie DROP FOREIGN KEY FK_486828B0D94388BD');
        $this->addSql('ALTER TABLE serie_author DROP FOREIGN KEY FK_4A0583A1D94388BD');
        $this->addSql('ALTER TABLE serie_author DROP FOREIGN KEY FK_4A0583A1F675F31B');
        $this->addSql('ALTER TABLE type_serie DROP FOREIGN KEY FK_A43614C3C54C8C93');
        $this->addSql('ALTER TABLE type_serie DROP FOREIGN KEY FK_A43614C3D94388BD');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE editor');
        $this->addSql('DROP TABLE editor_serie');
        $this->addSql('DROP TABLE serie');
        $this->addSql('DROP TABLE serie_author');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE type_serie');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
