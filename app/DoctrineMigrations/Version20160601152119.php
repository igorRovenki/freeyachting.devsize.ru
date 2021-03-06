<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160601152119 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE travels ADD skipper_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE travels ADD CONSTRAINT FK_67FF2BD71C8A3E6 FOREIGN KEY (skipper_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_67FF2BD71C8A3E6 ON travels (skipper_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE travels DROP FOREIGN KEY FK_67FF2BD71C8A3E6');
        $this->addSql('DROP INDEX IDX_67FF2BD71C8A3E6 ON travels');
        $this->addSql('ALTER TABLE travels DROP skipper_id');
    }
}
