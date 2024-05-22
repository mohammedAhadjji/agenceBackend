<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240522022022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sittings (id INT AUTO_INCREMENT NOT NULL, logo VARCHAR(255) DEFAULT NULL, favicon VARCHAR(255) DEFAULT NULL, footer_copyright VARCHAR(255) DEFAULT NULL, footerphone VARCHAR(255) DEFAULT NULL, topbar_email VARCHAR(255) DEFAULT NULL, topbar_phone_number VARCHAR(255) DEFAULT NULL, send_for_email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
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
        $this->addSql('DROP TABLE sittings');
    }
}
