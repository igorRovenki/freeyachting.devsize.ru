<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160310110655 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE skipper_has_water_experience (user_id INT NOT NULL, water_areas_experience_id INT NOT NULL, INDEX IDX_57E78F24A76ED395 (user_id), UNIQUE INDEX UNIQ_57E78F248C6D0BD (water_areas_experience_id), PRIMARY KEY(user_id, water_areas_experience_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE water_areas_experience (id INT AUTO_INCREMENT NOT NULL, country_id INT DEFAULT NULL, aquatory_id INT DEFAULT NULL, type VARCHAR(64) NOT NULL, UNIQUE INDEX UNIQ_F2454E05F92F3E70 (country_id), UNIQUE INDEX UNIQ_F2454E05A8833921 (aquatory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE skipper_has_water_experience ADD CONSTRAINT FK_57E78F24A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE skipper_has_water_experience ADD CONSTRAINT FK_57E78F248C6D0BD FOREIGN KEY (water_areas_experience_id) REFERENCES water_areas_experience (id)');
        $this->addSql('ALTER TABLE water_areas_experience ADD CONSTRAINT FK_F2454E05F92F3E70 FOREIGN KEY (country_id) REFERENCES countries (id)');
        $this->addSql('ALTER TABLE water_areas_experience ADD CONSTRAINT FK_F2454E05A8833921 FOREIGN KEY (aquatory_id) REFERENCES aquatories (id)');
        $this->addSql('ALTER TABLE users ADD skype_login VARCHAR(255) DEFAULT NULL, ADD know_russian TINYINT(1) DEFAULT NULL, ADD know_english TINYINT(1) DEFAULT NULL, ADD first_another_lang VARCHAR(64) DEFAULT NULL, ADD second_another_lang VARCHAR(64) DEFAULT NULL, ADD iyt_certificate TINYINT(1) DEFAULT NULL, ADD rya_certificate TINYINT(1) DEFAULT NULL, ADD certificate_number VARCHAR(255) DEFAULT NULL, ADD certificate_issue_date DATETIME DEFAULT NULL, ADD experience_years VARCHAR(255) DEFAULT NULL, ADD experience_miles VARCHAR(255) DEFAULT NULL, ADD job_offers_agree TINYINT(1) DEFAULT NULL, ADD email_subscribtion TINYINT(1) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE skipper_has_water_experience DROP FOREIGN KEY FK_57E78F248C6D0BD');
        $this->addSql('DROP TABLE skipper_has_water_experience');
        $this->addSql('DROP TABLE water_areas_experience');
        $this->addSql('ALTER TABLE users DROP skype_login, DROP know_russian, DROP know_english, DROP first_another_lang, DROP second_another_lang, DROP iyt_certificate, DROP rya_certificate, DROP certificate_number, DROP certificate_issue_date, DROP experience_years, DROP experience_miles, DROP job_offers_agree, DROP email_subscribtion');
    }
}
