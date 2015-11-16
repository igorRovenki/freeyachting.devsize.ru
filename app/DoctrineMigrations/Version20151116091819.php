<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151116091819 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users ADD photo_id INT DEFAULT NULL, ADD last_name VARCHAR(255) NOT NULL, ADD name VARCHAR(255) NOT NULL, ADD patronomic VARCHAR(255) DEFAULT NULL, ADD gender VARCHAR(32) NOT NULL, ADD birthday DATE DEFAULT NULL, ADD phone VARCHAR(64) DEFAULT NULL, ADD interests VARCHAR(1000) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E97E9E4C8C FOREIGN KEY (photo_id) REFERENCES media__media (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E97E9E4C8C ON users (photo_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E97E9E4C8C');
        $this->addSql('DROP INDEX UNIQ_1483A5E97E9E4C8C ON users');
        $this->addSql('ALTER TABLE users DROP photo_id, DROP last_name, DROP name, DROP patronomic, DROP gender, DROP birthday, DROP phone, DROP interests');
    }
}
