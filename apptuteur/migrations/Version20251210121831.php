<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251210121831 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tuteur CHANGE nom nom VARCHAR(30) NOT NULL, CHANGE prenom prenom VARCHAR(30) NOT NULL, CHANGE email email VARCHAR(30) NOT NULL, CHANGE telephone telephone VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBB86EC68D8');
        $this->addSql('ALTER TABLE visite ADD entreprise VARCHAR(30) NOT NULL, ADD observation LONGTEXT NOT NULL, DROP commentaire, CHANGE tuteur_id tuteur_id INT NOT NULL, CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBB86EC68D8 FOREIGN KEY (tuteur_id) REFERENCES tuteur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBB86EC68D8');
        $this->addSql('ALTER TABLE visite ADD commentaire VARCHAR(60) NOT NULL, DROP entreprise, DROP observation, CHANGE tuteur_id tuteur_id INT DEFAULT NULL, CHANGE date date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBB86EC68D8 FOREIGN KEY (tuteur_id) REFERENCES visite (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE tuteur CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE prenom prenom VARCHAR(20) NOT NULL, CHANGE email email VARCHAR(20) NOT NULL, CHANGE telephone telephone VARCHAR(20) NOT NULL');
    }
}
