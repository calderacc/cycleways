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

        $this->addSql('ALTER TABLE incident ADD accidentLocation VARCHAR(255) DEFAULT NULL, ADD accidentInfrastructure VARCHAR(255) DEFAULT NULL, ADD accidentOpponent VARCHAR(255) DEFAULT NULL, ADD accidentSex VARCHAR(1) DEFAULT NULL, ADD accidentAge INT DEFAULT NULL, ADD accidentPedelec TINYINT(1) DEFAULT NULL, ADD accidentHelmet TINYINT(1) DEFAULT NULL, ADD accidentAlcohol DOUBLE PRECISION DEFAULT NULL, ADD accidentCyclistCaused TINYINT(1) DEFAULT NULL, ADD accidentType VARCHAR(255) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE incident DROP accidentLocation, DROP accidentInfrastructure, DROP accidentOpponent, DROP accidentSex, DROP accidentAge, DROP accidentPedelec, DROP accidentHelmet, DROP accidentAlcohol, DROP accidentCyclistCaused, DROP accidentType');
    }
}
