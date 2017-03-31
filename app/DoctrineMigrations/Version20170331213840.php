<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170331213840 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE Accident');
        $this->addSql('ALTER TABLE incident ADD accidentLocation VARCHAR(255) DEFAULT NULL, ADD accidentInfrastructure VARCHAR(255) DEFAULT NULL, ADD accidentOpponent VARCHAR(255) DEFAULT NULL, ADD accidentSex VARCHAR(1) DEFAULT NULL, ADD accidentAge INT DEFAULT NULL, ADD accidentPedelec TINYINT(1) DEFAULT NULL, ADD accidentHelmet TINYINT(1) DEFAULT NULL, ADD accidentAlcohol DOUBLE PRECISION DEFAULT NULL, ADD accidentCyclistCaused TINYINT(1) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Accident (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, description LONGTEXT NOT NULL COLLATE utf8_unicode_ci, geometryType VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, incidentType VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, dangerLevel VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, address LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, street VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, houseNumber VARCHAR(16) DEFAULT NULL COLLATE utf8_unicode_ci, zipCode VARCHAR(5) DEFAULT NULL COLLATE utf8_unicode_ci, suburb VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, district VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, town VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, village VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, city VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, polyline LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, latitude DOUBLE PRECISION DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, dateTime DATETIME DEFAULT NULL, expires TINYINT(1) NOT NULL, visibleFrom DATETIME NOT NULL, visibleTo DATETIME NOT NULL, enabled TINYINT(1) NOT NULL, creationDateTime DATETIME NOT NULL, permalink VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, views INT NOT NULL, streetviewLink LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE incident DROP accidentLocation, DROP accidentInfrastructure, DROP accidentOpponent, DROP accidentSex, DROP accidentAge, DROP accidentPedelec, DROP accidentHelmet, DROP accidentAlcohol, DROP accidentCyclistCaused');
    }
}
