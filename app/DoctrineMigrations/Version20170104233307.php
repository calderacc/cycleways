<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170104233307 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE incident DROP FOREIGN KEY FK_3D03A11A8BAC62AF');
        $this->addSql('DROP INDEX IDX_3D03A11A8BAC62AF ON incident');
        $this->addSql('ALTER TABLE incident ADD village VARCHAR(255) DEFAULT NULL, ADD city VARCHAR(255) DEFAULT NULL, DROP city_id');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE incident ADD city_id INT DEFAULT NULL, DROP village, DROP city');
        $this->addSql('ALTER TABLE incident ADD CONSTRAINT FK_3D03A11A8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_3D03A11A8BAC62AF ON incident (city_id)');
    }
}
