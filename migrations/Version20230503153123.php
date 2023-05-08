<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230503153123 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classroom (id INT AUTO_INCREMENT NOT NULL, buildings_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, number INT NOT NULL, UNIQUE INDEX UNIQ_497D309D1485E613 (buildings_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classroom_infrastructure (classroom_id INT NOT NULL, infrastructure_id INT NOT NULL, INDEX IDX_7F24C86278D5A8 (classroom_id), INDEX IDX_7F24C8243E7A84 (infrastructure_id), PRIMARY KEY(classroom_id, infrastructure_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE infrastructure (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, image_path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messages (id INT AUTO_INCREMENT NOT NULL, infrastructure_id INT NOT NULL, classroom_id INT NOT NULL, building_id INT NOT NULL, title VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, image_path VARCHAR(255) DEFAULT NULL, time DATETIME NOT NULL, UNIQUE INDEX UNIQ_DB021E96243E7A84 (infrastructure_id), UNIQUE INDEX UNIQ_DB021E966278D5A8 (classroom_id), UNIQUE INDEX UNIQ_DB021E964D2A7E12 (building_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classroom ADD CONSTRAINT FK_497D309D1485E613 FOREIGN KEY (buildings_id) REFERENCES building (id)');
        $this->addSql('ALTER TABLE classroom_infrastructure ADD CONSTRAINT FK_7F24C86278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classroom_infrastructure ADD CONSTRAINT FK_7F24C8243E7A84 FOREIGN KEY (infrastructure_id) REFERENCES infrastructure (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E96243E7A84 FOREIGN KEY (infrastructure_id) REFERENCES infrastructure (id)');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E966278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id)');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E964D2A7E12 FOREIGN KEY (building_id) REFERENCES building (id)');
        $this->addSql('ALTER TABLE asset DROP name, DROP category');
        $this->addSql('ALTER TABLE building ADD CONSTRAINT FK_E16F61D4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_E16F61D4A76ED395 ON building (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classroom DROP FOREIGN KEY FK_497D309D1485E613');
        $this->addSql('ALTER TABLE classroom_infrastructure DROP FOREIGN KEY FK_7F24C86278D5A8');
        $this->addSql('ALTER TABLE classroom_infrastructure DROP FOREIGN KEY FK_7F24C8243E7A84');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E96243E7A84');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E966278D5A8');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E964D2A7E12');
        $this->addSql('DROP TABLE classroom');
        $this->addSql('DROP TABLE classroom_infrastructure');
        $this->addSql('DROP TABLE infrastructure');
        $this->addSql('DROP TABLE messages');
        $this->addSql('ALTER TABLE asset ADD name VARCHAR(255) NOT NULL, ADD category VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE building DROP FOREIGN KEY FK_E16F61D4A76ED395');
        $this->addSql('DROP INDEX IDX_E16F61D4A76ED395 ON building');
    }
}
