<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210327114208 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etat (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, nom_groupe VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, maraude_id INT DEFAULT NULL, utilisateurs_id INT DEFAULT NULL, date_inscription DATETIME NOT NULL, INDEX IDX_5E90F6D6ED9AF501 (maraude_id), INDEX IDX_5E90F6D61E969C5 (utilisateurs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lieu (id INT AUTO_INCREMENT NOT NULL, ville_id INT NOT NULL, nom_lieu VARCHAR(255) NOT NULL, rue VARCHAR(255) DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, INDEX IDX_2F577D59A73F0036 (ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maraude (id INT AUTO_INCREMENT NOT NULL, organisateur_id INT NOT NULL, groupe_id INT DEFAULT NULL, etat_id INT DEFAULT NULL, lieu_id INT NOT NULL, nom VARCHAR(30) NOT NULL, date_debut DATETIME NOT NULL, duree INT DEFAULT NULL, date_cloture DATETIME NOT NULL, nb_inscriptions_max INT NOT NULL, description_infos VARCHAR(500) DEFAULT NULL, etat_maraude INT DEFAULT NULL, url_photo VARCHAR(250) DEFAULT NULL, INDEX IDX_DA5E9CA2D936B2FA (organisateur_id), INDEX IDX_DA5E9CA27A45358C (groupe_id), INDEX IDX_DA5E9CA2D5E86FF (etat_id), INDEX IDX_DA5E9CA26AB213CC (lieu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, upload VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, groupes_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone VARCHAR(15) DEFAULT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, administrateur TINYINT(1) DEFAULT NULL, actif TINYINT(1) DEFAULT NULL, roles JSON NOT NULL, activation_token VARCHAR(50) DEFAULT NULL, reset_token VARCHAR(50) DEFAULT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), INDEX IDX_1D1C63B3305371B (groupes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, nom_ville VARCHAR(30) NOT NULL, code_postal VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6ED9AF501 FOREIGN KEY (maraude_id) REFERENCES maraude (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D61E969C5 FOREIGN KEY (utilisateurs_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE lieu ADD CONSTRAINT FK_2F577D59A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE maraude ADD CONSTRAINT FK_DA5E9CA2D936B2FA FOREIGN KEY (organisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE maraude ADD CONSTRAINT FK_DA5E9CA27A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id)');
        $this->addSql('ALTER TABLE maraude ADD CONSTRAINT FK_DA5E9CA2D5E86FF FOREIGN KEY (etat_id) REFERENCES etat (id)');
        $this->addSql('ALTER TABLE maraude ADD CONSTRAINT FK_DA5E9CA26AB213CC FOREIGN KEY (lieu_id) REFERENCES lieu (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3305371B FOREIGN KEY (groupes_id) REFERENCES groupe (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE maraude DROP FOREIGN KEY FK_DA5E9CA2D5E86FF');
        $this->addSql('ALTER TABLE maraude DROP FOREIGN KEY FK_DA5E9CA27A45358C');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3305371B');
        $this->addSql('ALTER TABLE maraude DROP FOREIGN KEY FK_DA5E9CA26AB213CC');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6ED9AF501');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D61E969C5');
        $this->addSql('ALTER TABLE maraude DROP FOREIGN KEY FK_DA5E9CA2D936B2FA');
        $this->addSql('ALTER TABLE lieu DROP FOREIGN KEY FK_2F577D59A73F0036');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE etat');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE lieu');
        $this->addSql('DROP TABLE maraude');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE ville');
    }
}
