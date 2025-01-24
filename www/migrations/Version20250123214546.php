<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250123214546 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE serie_editor (serie_id INT NOT NULL, editor_id INT NOT NULL, INDEX IDX_3B5BAAD3D94388BD (serie_id), INDEX IDX_3B5BAAD36995AC4C (editor_id), PRIMARY KEY(serie_id, editor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie_type (serie_id INT NOT NULL, type_id INT NOT NULL, INDEX IDX_57BB431BD94388BD (serie_id), INDEX IDX_57BB431BC54C8C93 (type_id), PRIMARY KEY(serie_id, type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE serie_editor ADD CONSTRAINT FK_3B5BAAD3D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_editor ADD CONSTRAINT FK_3B5BAAD36995AC4C FOREIGN KEY (editor_id) REFERENCES editor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_type ADD CONSTRAINT FK_57BB431BD94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_type ADD CONSTRAINT FK_57BB431BC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_serie DROP FOREIGN KEY FK_A43614C3D94388BD');
        $this->addSql('ALTER TABLE type_serie DROP FOREIGN KEY FK_A43614C3C54C8C93');
        $this->addSql('ALTER TABLE editor_serie DROP FOREIGN KEY FK_486828B06995AC4C');
        $this->addSql('ALTER TABLE editor_serie DROP FOREIGN KEY FK_486828B0D94388BD');
        $this->addSql('DROP TABLE type_serie');
        $this->addSql('DROP TABLE editor_serie');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE type_serie (type_id INT NOT NULL, serie_id INT NOT NULL, INDEX IDX_A43614C3C54C8C93 (type_id), INDEX IDX_A43614C3D94388BD (serie_id), PRIMARY KEY(type_id, serie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE editor_serie (editor_id INT NOT NULL, serie_id INT NOT NULL, INDEX IDX_486828B06995AC4C (editor_id), INDEX IDX_486828B0D94388BD (serie_id), PRIMARY KEY(editor_id, serie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE type_serie ADD CONSTRAINT FK_A43614C3D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_serie ADD CONSTRAINT FK_A43614C3C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE editor_serie ADD CONSTRAINT FK_486828B06995AC4C FOREIGN KEY (editor_id) REFERENCES editor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE editor_serie ADD CONSTRAINT FK_486828B0D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_editor DROP FOREIGN KEY FK_3B5BAAD3D94388BD');
        $this->addSql('ALTER TABLE serie_editor DROP FOREIGN KEY FK_3B5BAAD36995AC4C');
        $this->addSql('ALTER TABLE serie_type DROP FOREIGN KEY FK_57BB431BD94388BD');
        $this->addSql('ALTER TABLE serie_type DROP FOREIGN KEY FK_57BB431BC54C8C93');
        $this->addSql('DROP TABLE serie_editor');
        $this->addSql('DROP TABLE serie_type');
    }
}
