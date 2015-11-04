<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151104174116 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE travel_days (id INT AUTO_INCREMENT NOT NULL, city_departure VARCHAR(255) NOT NULL, city_arrival VARCHAR(255) NOT NULL, city_departure_latitude VARCHAR(255) DEFAULT NULL, city_departure_longitude VARCHAR(255) DEFAULT NULL, city_arrival_latitude VARCHAR(255) DEFAULT NULL, city_arrival_longitude VARCHAR(255) DEFAULT NULL, route_length VARCHAR(64) NOT NULL, full_description TEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE travel_has_days (travel_id INT NOT NULL, day_id INT NOT NULL, INDEX IDX_DCC9447CECAB15B3 (travel_id), UNIQUE INDEX UNIQ_DCC9447C9C24126 (day_id), PRIMARY KEY(travel_id, day_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE travel_has_days ADD CONSTRAINT FK_DCC9447CECAB15B3 FOREIGN KEY (travel_id) REFERENCES travels (id)');
        $this->addSql('ALTER TABLE travel_has_days ADD CONSTRAINT FK_DCC9447C9C24126 FOREIGN KEY (day_id) REFERENCES travel_days (id)');
        $this->addSql('ALTER TABLE travels DROP photos, DROP days, CHANGE travel_days days_count SMALLINT NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE travel_has_days DROP FOREIGN KEY FK_DCC9447C9C24126');
        $this->addSql('DROP TABLE travel_days');
        $this->addSql('DROP TABLE travel_has_days');
        $this->addSql('ALTER TABLE travels ADD photos LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', ADD days LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', CHANGE days_count travel_days SMALLINT NOT NULL');
    }
}
