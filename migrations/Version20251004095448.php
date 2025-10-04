<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251004095448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE visites_environnement (visites_id INT NOT NULL, environnement_id INT NOT NULL, INDEX IDX_13A16A73F50791A9 (visites_id), INDEX IDX_13A16A73BAFB82A1 (environnement_id), PRIMARY KEY(visites_id, environnement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE visites_environnement ADD CONSTRAINT FK_13A16A73F50791A9 FOREIGN KEY (visites_id) REFERENCES visites (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE visites_environnement ADD CONSTRAINT FK_13A16A73BAFB82A1 FOREIGN KEY (environnement_id) REFERENCES environnement (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE visites_environnement DROP FOREIGN KEY FK_13A16A73F50791A9');
        $this->addSql('ALTER TABLE visites_environnement DROP FOREIGN KEY FK_13A16A73BAFB82A1');
        $this->addSql('DROP TABLE visites_environnement');
    }
}
