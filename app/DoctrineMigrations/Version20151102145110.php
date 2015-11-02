<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151102145110 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE aquatories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE countries (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE travels (id INT AUTO_INCREMENT NOT NULL, country_id INT DEFAULT NULL, aquatory_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(64) NOT NULL, participant_level VARCHAR(64) NOT NULL, day_price NUMERIC(10, 0) NOT NULL, day_price_currency VARCHAR(32) NOT NULL, week_price NUMERIC(10, 0) NOT NULL, week_price_currency VARCHAR(32) NOT NULL, children TINYINT(1) NOT NULL, min_child_age SMALLINT DEFAULT NULL, hot_offers TINYINT(1) NOT NULL, percent_of_discount SMALLINT NOT NULL, time_for_discount_activation SMALLINT DEFAULT NULL, min_places_for_travel SMALLINT NOT NULL, skipper_confirmation TINYINT(1) NOT NULL, date_start DATETIME NOT NULL, date_end DATETIME NOT NULL, travel_days SMALLINT NOT NULL, yacht LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', skipper_payment_method VARCHAR(64) NOT NULL, website_comission SMALLINT NOT NULL, place_of_arrival VARCHAR(255) NOT NULL, place_of_departure VARCHAR(255) NOT NULL, transfer_from_airport VARCHAR(64) NOT NULL, transfer_price NUMERIC(10, 0) NOT NULL, transfer_price_currency VARCHAR(64) NOT NULL, team_gathering_address TEXT NOT NULL, team_gathering_latitude VARCHAR(255) NOT NULL, team_gathering_longitude VARCHAR(255) NOT NULL, team_gathering_time TIME NOT NULL, included TEXT NOT NULL, excluded TEXT NOT NULL, photos LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', days LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', INDEX IDX_67FF2BD7F92F3E70 (country_id), INDEX IDX_67FF2BD7A8833921 (aquatory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE travels ADD CONSTRAINT FK_67FF2BD7F92F3E70 FOREIGN KEY (country_id) REFERENCES countries (id)');
        $this->addSql('ALTER TABLE travels ADD CONSTRAINT FK_67FF2BD7A8833921 FOREIGN KEY (aquatory_id) REFERENCES aquatories (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE travels DROP FOREIGN KEY FK_67FF2BD7A8833921');
        $this->addSql('ALTER TABLE travels DROP FOREIGN KEY FK_67FF2BD7F92F3E70');
        $this->addSql('DROP TABLE aquatories');
        $this->addSql('DROP TABLE countries');
        $this->addSql('DROP TABLE travels');
    }
}
