<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240522014709 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, INDEX IDX_3AF34668727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaires (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, n_ews_id INT DEFAULT NULL, id_client VARCHAR(255) DEFAULT NULL, content VARCHAR(255) DEFAULT NULL, INDEX IDX_D9BEC0C4727ACA70 (parent_id), INDEX IDX_D9BEC0C4869F45D8 (n_ews_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE config (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, storekey VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_news (id INT AUTO_INCREMENT NOT NULL, n_ews_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, INDEX IDX_EFE973CE869F45D8 (n_ews_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, content VARCHAR(255) DEFAULT NULL, INDEX IDX_1DD39950BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscriber (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE testimoniale (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) DEFAULT NULL, designation VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, cantact VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF34668727ACA70 FOREIGN KEY (parent_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C4727ACA70 FOREIGN KEY (parent_id) REFERENCES commentaires (id)');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C4869F45D8 FOREIGN KEY (n_ews_id) REFERENCES news (id)');
        $this->addSql('ALTER TABLE image_news ADD CONSTRAINT FK_EFE973CE869F45D8 FOREIGN KEY (n_ews_id) REFERENCES news (id)');
        $this->addSql('ALTER TABLE news ADD CONSTRAINT FK_1DD39950BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE offre_destination DROP FOREIGN KEY FK_75EFB48A816C6140');
        $this->addSql('ALTER TABLE offre_destination DROP FOREIGN KEY FK_75EFB48A4CC8505A');
        $this->addSql('DROP TABLE offre_destination');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE offre_destination (offre_id INT NOT NULL, destination_id INT NOT NULL, INDEX IDX_75EFB48A816C6140 (destination_id), INDEX IDX_75EFB48A4CC8505A (offre_id), PRIMARY KEY(offre_id, destination_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE offre_destination ADD CONSTRAINT FK_75EFB48A816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offre_destination ADD CONSTRAINT FK_75EFB48A4CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY FK_3AF34668727ACA70');
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C4727ACA70');
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C4869F45D8');
        $this->addSql('ALTER TABLE image_news DROP FOREIGN KEY FK_EFE973CE869F45D8');
        $this->addSql('ALTER TABLE news DROP FOREIGN KEY FK_1DD39950BCF5E72D');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE commentaires');
        $this->addSql('DROP TABLE config');
        $this->addSql('DROP TABLE image_news');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE subscriber');
        $this->addSql('DROP TABLE testimoniale');
    }
}
