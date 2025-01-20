<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250120085910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE serie_author (serie_id INT NOT NULL, author_id INT NOT NULL, INDEX IDX_4A0583A1D94388BD (serie_id), INDEX IDX_4A0583A1F675F31B (author_id), PRIMARY KEY(serie_id, author_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE serie_author ADD CONSTRAINT FK_4A0583A1D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_author ADD CONSTRAINT FK_4A0583A1F675F31B FOREIGN KEY (author_id) REFERENCES author (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE serie_author DROP FOREIGN KEY FK_4A0583A1D94388BD');
        $this->addSql('ALTER TABLE serie_author DROP FOREIGN KEY FK_4A0583A1F675F31B');
        $this->addSql('DROP TABLE serie_author');
    }
}
