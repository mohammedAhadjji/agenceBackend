<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240522012701 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, client_id VARCHAR(255) DEFAULT NULL, fullname VARCHAR(255) DEFAULT NULL, company_name VARCHAR(255) DEFAULT NULL, amount INT DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, codepostal VARCHAR(255) DEFAULT NULL, pays VARCHAR(255) DEFAULT NULL, province VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, date DATETIME DEFAULT NULL, date_of_death DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offre_destination DROP FOREIGN KEY FK_75EFB48A4CC8505A');
        $this->addSql('ALTER TABLE offre_destination DROP FOREIGN KEY FK_75EFB48A816C6140');
        $this->addSql('DROP TABLE offre_destination');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE offre_destination (offre_id INT NOT NULL, destination_id INT NOT NULL, INDEX IDX_75EFB48A4CC8505A (offre_id), INDEX IDX_75EFB48A816C6140 (destination_id), PRIMARY KEY(offre_id, destination_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE offre_destination ADD CONSTRAINT FK_75EFB48A4CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offre_destination ADD CONSTRAINT FK_75EFB48A816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE `order`');
    }
}
