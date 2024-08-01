<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240801101543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE departements (id INT AUTO_INCREMENT NOT NULL, regiondep_id INT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(15) NOT NULL, INDEX IDX_CF7489B2B31647E8 (regiondep_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE regions (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, regions_id INT NOT NULL, departements_id INT NOT NULL, pseudo VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, sexe VARCHAR(255) NOT NULL, age INT NOT NULL, INDEX IDX_1483A5E9FCE83E5F (regions_id), INDEX IDX_1483A5E91DB279A6 (departements_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE departements ADD CONSTRAINT FK_CF7489B2B31647E8 FOREIGN KEY (regiondep_id) REFERENCES regions (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9FCE83E5F FOREIGN KEY (regions_id) REFERENCES regions (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E91DB279A6 FOREIGN KEY (departements_id) REFERENCES departements (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE departements DROP FOREIGN KEY FK_CF7489B2B31647E8');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9FCE83E5F');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E91DB279A6');
        $this->addSql('DROP TABLE departements');
        $this->addSql('DROP TABLE regions');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
