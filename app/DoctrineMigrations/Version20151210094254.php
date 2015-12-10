<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151210094254 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bookings (id INT AUTO_INCREMENT NOT NULL, travel_id INT DEFAULT NULL, status VARCHAR(32) NOT NULL, INDEX IDX_7A853C35ECAB15B3 (travel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bookings_has_travellers (booking_id INT NOT NULL, traveller_id INT NOT NULL, INDEX IDX_89960C9A3301C60 (booking_id), INDEX IDX_89960C9AE58489A0 (traveller_id), PRIMARY KEY(booking_id, traveller_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE travellers (id INT AUTO_INCREMENT NOT NULL, photo_id INT DEFAULT NULL, full_name VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, phone VARCHAR(64) DEFAULT NULL, age VARCHAR(64) DEFAULT NULL, gender VARCHAR(32) NOT NULL, children TINYINT(1) NOT NULL, child_number SMALLINT DEFAULT NULL, child_min_age SMALLINT DEFAULT NULL, opposite_gender_living TINYINT(1) NOT NULL, living_with_parents TINYINT(1) NOT NULL, type VARCHAR(32) NOT NULL, place_number SMALLINT NOT NULL, UNIQUE INDEX UNIQ_BE969DD47E9E4C8C (photo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bookings ADD CONSTRAINT FK_7A853C35ECAB15B3 FOREIGN KEY (travel_id) REFERENCES travels (id)');
        $this->addSql('ALTER TABLE bookings_has_travellers ADD CONSTRAINT FK_89960C9A3301C60 FOREIGN KEY (booking_id) REFERENCES bookings (id)');
        $this->addSql('ALTER TABLE bookings_has_travellers ADD CONSTRAINT FK_89960C9AE58489A0 FOREIGN KEY (traveller_id) REFERENCES travellers (id)');
        $this->addSql('ALTER TABLE travellers ADD CONSTRAINT FK_BE969DD47E9E4C8C FOREIGN KEY (photo_id) REFERENCES media__media (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bookings_has_travellers DROP FOREIGN KEY FK_89960C9A3301C60');
        $this->addSql('ALTER TABLE bookings_has_travellers DROP FOREIGN KEY FK_89960C9AE58489A0');
        $this->addSql('DROP TABLE bookings');
        $this->addSql('DROP TABLE bookings_has_travellers');
        $this->addSql('DROP TABLE travellers');
    }
}
