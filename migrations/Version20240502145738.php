<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240502145738 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_destination DROP FOREIGN KEY FK_75EFB48A816C6140');
        $this->addSql('ALTER TABLE offre_destination DROP FOREIGN KEY FK_75EFB48A4CC8505A');
        $this->addSql('DROP TABLE offre_destination');
        $this->addSql('ALTER TABLE image_ville ADD ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image_ville ADD CONSTRAINT FK_54865D6AA73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('CREATE INDEX IDX_54865D6AA73F0036 ON image_ville (ville_id)');
        $this->addSql('ALTER TABLE offre ADD destination_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866F816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id)');
        $this->addSql('CREATE INDEX IDX_AF86866F816C6140 ON offre (destination_id)');
        $this->addSql('ALTER TABLE service ADD image VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE offre_destination (offre_id INT NOT NULL, destination_id INT NOT NULL, INDEX IDX_75EFB48A4CC8505A (offre_id), INDEX IDX_75EFB48A816C6140 (destination_id), PRIMARY KEY(offre_id, destination_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE offre_destination ADD CONSTRAINT FK_75EFB48A816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offre_destination ADD CONSTRAINT FK_75EFB48A4CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image_ville DROP FOREIGN KEY FK_54865D6AA73F0036');
        $this->addSql('DROP INDEX IDX_54865D6AA73F0036 ON image_ville');
        $this->addSql('ALTER TABLE image_ville DROP ville_id');
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866F816C6140');
        $this->addSql('DROP INDEX IDX_AF86866F816C6140 ON offre');
        $this->addSql('ALTER TABLE offre DROP destination_id');
        $this->addSql('ALTER TABLE service DROP image');
    }
}
