<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170516175554 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE incident_incident_tag');
        $this->addSql('ALTER TABLE incident_user DROP FOREIGN KEY FK_679FA1F6A76ED395');
        $this->addSql('DROP INDEX IDX_679FA1F6A76ED395 ON incident_user');
        $this->addSql('ALTER TABLE incident_user CHANGE user_id issuer_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE incident_user ADD CONSTRAINT FK_679FA1F677307DB7 FOREIGN KEY (issuer_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_679FA1F677307DB7 ON incident_user (issuer_user_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE incident_incident_tag (incident_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_E90604AC59E53FB9 (incident_id), INDEX IDX_E90604ACBAD26311 (tag_id), PRIMARY KEY(incident_id, tag_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE incident_incident_tag ADD CONSTRAINT FK_E90604AC59E53FB9 FOREIGN KEY (incident_id) REFERENCES incident_tag (id)');
        $this->addSql('ALTER TABLE incident_incident_tag ADD CONSTRAINT FK_E90604ACBAD26311 FOREIGN KEY (tag_id) REFERENCES incident (id)');
        $this->addSql('ALTER TABLE incident_user DROP FOREIGN KEY FK_679FA1F677307DB7');
        $this->addSql('DROP INDEX IDX_679FA1F677307DB7 ON incident_user');
        $this->addSql('ALTER TABLE incident_user CHANGE issuer_user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE incident_user ADD CONSTRAINT FK_679FA1F6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_679FA1F6A76ED395 ON incident_user (user_id)');
    }
}
