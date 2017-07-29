<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170516170225 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, caption VARCHAR(255) NOT NULL, style VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incident_user (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, incident_id INT DEFAULT NULL, dateTime DATETIME NOT NULL, INDEX IDX_679FA1F6A76ED395 (user_id), INDEX IDX_679FA1F659E53FB9 (incident_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, caption VARCHAR(255) NOT NULL, style VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incident_status (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, incident_id INT DEFAULT NULL, status_id INT DEFAULT NULL, dateTime DATETIME NOT NULL, INDEX IDX_D63CD9F8A76ED395 (user_id), INDEX IDX_D63CD9F859E53FB9 (incident_id), INDEX IDX_D63CD9F86BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE incident_user ADD CONSTRAINT FK_679FA1F6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE incident_user ADD CONSTRAINT FK_679FA1F659E53FB9 FOREIGN KEY (incident_id) REFERENCES incident (id)');
        $this->addSql('ALTER TABLE incident_status ADD CONSTRAINT FK_D63CD9F8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE incident_status ADD CONSTRAINT FK_D63CD9F859E53FB9 FOREIGN KEY (incident_id) REFERENCES incident (id)');
        $this->addSql('ALTER TABLE incident_status ADD CONSTRAINT FK_D63CD9F86BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('DROP TABLE incident_incident_tag');
        $this->addSql('ALTER TABLE incident ADD status_id INT DEFAULT NULL, ADD issuer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE incident ADD CONSTRAINT FK_3D03A11A6BF700BD FOREIGN KEY (status_id) REFERENCES incident_status (id)');
        $this->addSql('ALTER TABLE incident ADD CONSTRAINT FK_3D03A11ABB9D6FEE FOREIGN KEY (issuer_id) REFERENCES incident_user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3D03A11A6BF700BD ON incident (status_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3D03A11ABB9D6FEE ON incident (issuer_id)');
        $this->addSql('ALTER TABLE incident_tag ADD user_created_id INT DEFAULT NULL, ADD user_removed_id INT DEFAULT NULL, ADD incident_id INT DEFAULT NULL, ADD tag_id INT DEFAULT NULL, ADD dateTimeAdded DATETIME NOT NULL, ADD dateTimeRemoved DATETIME DEFAULT NULL, DROP title, DROP font_color, DROP background_color');
        $this->addSql('ALTER TABLE incident_tag ADD CONSTRAINT FK_DAB93107F987D8A8 FOREIGN KEY (user_created_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE incident_tag ADD CONSTRAINT FK_DAB931073758DC25 FOREIGN KEY (user_removed_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE incident_tag ADD CONSTRAINT FK_DAB9310759E53FB9 FOREIGN KEY (incident_id) REFERENCES incident (id)');
        $this->addSql('ALTER TABLE incident_tag ADD CONSTRAINT FK_DAB93107BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id)');
        $this->addSql('CREATE INDEX IDX_DAB93107F987D8A8 ON incident_tag (user_created_id)');
        $this->addSql('CREATE INDEX IDX_DAB931073758DC25 ON incident_tag (user_removed_id)');
        $this->addSql('CREATE INDEX IDX_DAB9310759E53FB9 ON incident_tag (incident_id)');
        $this->addSql('CREATE INDEX IDX_DAB93107BAD26311 ON incident_tag (tag_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE incident_tag DROP FOREIGN KEY FK_DAB93107BAD26311');
        $this->addSql('ALTER TABLE incident DROP FOREIGN KEY FK_3D03A11ABB9D6FEE');
        $this->addSql('ALTER TABLE incident_status DROP FOREIGN KEY FK_D63CD9F86BF700BD');
        $this->addSql('ALTER TABLE incident DROP FOREIGN KEY FK_3D03A11A6BF700BD');
        $this->addSql('CREATE TABLE incident_incident_tag (incident_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_E90604AC59E53FB9 (incident_id), INDEX IDX_E90604ACBAD26311 (tag_id), PRIMARY KEY(incident_id, tag_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE incident_incident_tag ADD CONSTRAINT FK_E90604AC59E53FB9 FOREIGN KEY (incident_id) REFERENCES incident_tag (id)');
        $this->addSql('ALTER TABLE incident_incident_tag ADD CONSTRAINT FK_E90604ACBAD26311 FOREIGN KEY (tag_id) REFERENCES incident (id)');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE incident_user');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE incident_status');
        $this->addSql('DROP INDEX UNIQ_3D03A11A6BF700BD ON incident');
        $this->addSql('DROP INDEX UNIQ_3D03A11ABB9D6FEE ON incident');
        $this->addSql('ALTER TABLE incident DROP status_id, DROP issuer_id');
        $this->addSql('ALTER TABLE incident_tag DROP FOREIGN KEY FK_DAB93107F987D8A8');
        $this->addSql('ALTER TABLE incident_tag DROP FOREIGN KEY FK_DAB931073758DC25');
        $this->addSql('ALTER TABLE incident_tag DROP FOREIGN KEY FK_DAB9310759E53FB9');
        $this->addSql('DROP INDEX IDX_DAB93107F987D8A8 ON incident_tag');
        $this->addSql('DROP INDEX IDX_DAB931073758DC25 ON incident_tag');
        $this->addSql('DROP INDEX IDX_DAB9310759E53FB9 ON incident_tag');
        $this->addSql('DROP INDEX IDX_DAB93107BAD26311 ON incident_tag');
        $this->addSql('ALTER TABLE incident_tag ADD title VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, ADD font_color VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, ADD background_color VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, DROP user_created_id, DROP user_removed_id, DROP incident_id, DROP tag_id, DROP dateTimeAdded, DROP dateTimeRemoved');
    }
}
