<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151110093522 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE yachts (id INT AUTO_INCREMENT NOT NULL, schema_image_id INT DEFAULT NULL, shipType VARCHAR(64) NOT NULL, yachtType VARCHAR(64) NOT NULL, manufacturer VARCHAR(64) NOT NULL, yearOfProduction VARCHAR(64) DEFAULT NULL, yachtLengthFt VARCHAR(64) NOT NULL, yachtLengthM VARCHAR(64) NOT NULL, bathroomsNumber VARCHAR(64) DEFAULT NULL, doubleCabinsNumber VARCHAR(64) NOT NULL, singleCabinsNumber VARCHAR(64) NOT NULL, description VARCHAR(1000) DEFAULT NULL, features VARCHAR(1000) DEFAULT NULL, INDEX IDX_D4B5FD568446CB39 (schema_image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE yachts ADD CONSTRAINT FK_D4B5FD568446CB39 FOREIGN KEY (schema_image_id) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE travels ADD yacht_id INT DEFAULT NULL, DROP yacht');
        $this->addSql('ALTER TABLE travels ADD CONSTRAINT FK_67FF2BD7A1837812 FOREIGN KEY (yacht_id) REFERENCES yachts (id)');
        $this->addSql('CREATE INDEX IDX_67FF2BD7A1837812 ON travels (yacht_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE travels DROP FOREIGN KEY FK_67FF2BD7A1837812');
        $this->addSql('DROP TABLE yachts');
        $this->addSql('DROP INDEX IDX_67FF2BD7A1837812 ON travels');
        $this->addSql('ALTER TABLE travels ADD yacht LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', DROP yacht_id');
    }
}
