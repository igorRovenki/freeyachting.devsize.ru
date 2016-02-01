<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151223143444 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE yachts ADD ship_type VARCHAR(64) NOT NULL, ADD yacht_type VARCHAR(64) NOT NULL, ADD year_of_production VARCHAR(64) DEFAULT NULL, ADD yacht_length_ft VARCHAR(64) NOT NULL, ADD yacht_length_m VARCHAR(64) NOT NULL, ADD bathrooms_number VARCHAR(64) DEFAULT NULL, ADD double_cabins_number INT NOT NULL, ADD single_cabins_number INT NOT NULL, DROP shipType, DROP yachtType, DROP yearOfProduction, DROP yachtLengthFt, DROP yachtLengthM, DROP bathroomsNumber, DROP doubleCabinsNumber, DROP singleCabinsNumber');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE yachts ADD shipType VARCHAR(64) NOT NULL, ADD yachtType VARCHAR(64) NOT NULL, ADD yearOfProduction VARCHAR(64) DEFAULT NULL, ADD yachtLengthFt VARCHAR(64) NOT NULL, ADD yachtLengthM VARCHAR(64) NOT NULL, ADD bathroomsNumber VARCHAR(64) DEFAULT NULL, ADD doubleCabinsNumber VARCHAR(64) NOT NULL, ADD singleCabinsNumber VARCHAR(64) NOT NULL, DROP ship_type, DROP yacht_type, DROP year_of_production, DROP yacht_length_ft, DROP yacht_length_m, DROP bathrooms_number, DROP double_cabins_number, DROP single_cabins_number');
    }
}
