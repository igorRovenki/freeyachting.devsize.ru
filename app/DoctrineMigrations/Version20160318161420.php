<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160318161420 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE water_areas_experience DROP INDEX UNIQ_F2454E05F92F3E70, ADD INDEX IDX_F2454E05F92F3E70 (country_id)');
        $this->addSql('ALTER TABLE water_areas_experience DROP INDEX UNIQ_F2454E05A8833921, ADD INDEX IDX_F2454E05A8833921 (aquatory_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE water_areas_experience DROP INDEX IDX_F2454E05F92F3E70, ADD UNIQUE INDEX UNIQ_F2454E05F92F3E70 (country_id)');
        $this->addSql('ALTER TABLE water_areas_experience DROP INDEX IDX_F2454E05A8833921, ADD UNIQUE INDEX UNIQ_F2454E05A8833921 (aquatory_id)');
    }
}
