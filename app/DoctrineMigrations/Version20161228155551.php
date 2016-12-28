<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161228155551 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, city_id INT DEFAULT NULL, incident_id INT DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, description LONGTEXT DEFAULT NULL, views INT NOT NULL, enabled TINYINT(1) NOT NULL, deleted TINYINT(1) NOT NULL, dateTime DATETIME NOT NULL, creationDateTime DATETIME NOT NULL, imageName VARCHAR(255) NOT NULL, updatedAt DATETIME NOT NULL, INDEX IDX_14B78418A76ED395 (user_id), INDEX IDX_14B784188BAC62AF (city_id), INDEX IDX_14B7841859E53FB9 (incident_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incident_view (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, incident_id INT DEFAULT NULL, dateTime DATETIME NOT NULL, INDEX IDX_14F1DC31A76ED395 (user_id), INDEX IDX_14F1DC3159E53FB9 (incident_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, zip VARCHAR(5) NOT NULL, locId INT NOT NULL, population INT NOT NULL, area INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo_view (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, photo_id INT DEFAULT NULL, dateTime DATETIME NOT NULL, INDEX IDX_7FCC197AA76ED395 (user_id), INDEX IDX_7FCC197A7E9E4C8C (photo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incident (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, city_id INT DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, geometryType VARCHAR(255) NOT NULL, incidentType VARCHAR(255) NOT NULL, dangerLevel VARCHAR(255) DEFAULT NULL, address LONGTEXT DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, houseNumber VARCHAR(16) DEFAULT NULL, zipCode VARCHAR(5) DEFAULT NULL, suburb VARCHAR(255) DEFAULT NULL, district VARCHAR(255) DEFAULT NULL, polyline LONGTEXT DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, dateTime DATETIME DEFAULT NULL, expires TINYINT(1) NOT NULL, visibleFrom DATETIME NOT NULL, visibleTo DATETIME NOT NULL, enabled TINYINT(1) NOT NULL, creationDateTime DATETIME NOT NULL, permalink VARCHAR(255) DEFAULT NULL, views INT NOT NULL, streetviewLink LONGTEXT DEFAULT NULL, INDEX IDX_3D03A11AA76ED395 (user_id), INDEX IDX_3D03A11A8BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, incident_id INT DEFAULT NULL, dateTime DATETIME NOT NULL, text LONGTEXT NOT NULL, enabled TINYINT(1) NOT NULL, INDEX IDX_5A8A6C8DA76ED395 (user_id), INDEX IDX_5A8A6C8D59E53FB9 (incident_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', updatedAt DATETIME DEFAULT NULL, createdAt DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incident_tag (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, font_color VARCHAR(255) DEFAULT NULL, background_color VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incident_incident_tag (incident_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_E90604AC59E53FB9 (incident_id), INDEX IDX_E90604ACBAD26311 (tag_id), PRIMARY KEY(incident_id, tag_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784188BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B7841859E53FB9 FOREIGN KEY (incident_id) REFERENCES incident (id)');
        $this->addSql('ALTER TABLE incident_view ADD CONSTRAINT FK_14F1DC31A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE incident_view ADD CONSTRAINT FK_14F1DC3159E53FB9 FOREIGN KEY (incident_id) REFERENCES incident (id)');
        $this->addSql('ALTER TABLE photo_view ADD CONSTRAINT FK_7FCC197AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE photo_view ADD CONSTRAINT FK_7FCC197A7E9E4C8C FOREIGN KEY (photo_id) REFERENCES photo (id)');
        $this->addSql('ALTER TABLE incident ADD CONSTRAINT FK_3D03A11AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE incident ADD CONSTRAINT FK_3D03A11A8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D59E53FB9 FOREIGN KEY (incident_id) REFERENCES incident (id)');
        $this->addSql('ALTER TABLE incident_incident_tag ADD CONSTRAINT FK_E90604AC59E53FB9 FOREIGN KEY (incident_id) REFERENCES incident_tag (id)');
        $this->addSql('ALTER TABLE incident_incident_tag ADD CONSTRAINT FK_E90604ACBAD26311 FOREIGN KEY (tag_id) REFERENCES incident (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE photo_view DROP FOREIGN KEY FK_7FCC197A7E9E4C8C');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784188BAC62AF');
        $this->addSql('ALTER TABLE incident DROP FOREIGN KEY FK_3D03A11A8BAC62AF');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B7841859E53FB9');
        $this->addSql('ALTER TABLE incident_view DROP FOREIGN KEY FK_14F1DC3159E53FB9');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D59E53FB9');
        $this->addSql('ALTER TABLE incident_incident_tag DROP FOREIGN KEY FK_E90604ACBAD26311');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418A76ED395');
        $this->addSql('ALTER TABLE incident_view DROP FOREIGN KEY FK_14F1DC31A76ED395');
        $this->addSql('ALTER TABLE photo_view DROP FOREIGN KEY FK_7FCC197AA76ED395');
        $this->addSql('ALTER TABLE incident DROP FOREIGN KEY FK_3D03A11AA76ED395');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DA76ED395');
        $this->addSql('ALTER TABLE incident_incident_tag DROP FOREIGN KEY FK_E90604AC59E53FB9');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE incident_view');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE photo_view');
        $this->addSql('DROP TABLE incident');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE incident_tag');
        $this->addSql('DROP TABLE incident_incident_tag');
    }
}
