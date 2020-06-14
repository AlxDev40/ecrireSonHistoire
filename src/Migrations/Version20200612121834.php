<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200612121834 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chapter CHANGE itinerary itinerary VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE `character` CHANGE user_id user_id INT DEFAULT NULL, CHANGE class class VARCHAR(255) DEFAULT NULL, CHANGE gender gender VARCHAR(255) DEFAULT NULL, CHANGE life_point life_point VARCHAR(255) DEFAULT NULL, CHANGE dexterity dexterity VARCHAR(255) DEFAULT NULL, CHANGE attack attack VARCHAR(255) DEFAULT NULL, CHANGE defense defense VARCHAR(255) DEFAULT NULL, CHANGE level level VARCHAR(255) DEFAULT NULL, CHANGE current_chapter current_chapter INT DEFAULT NULL, CHANGE current_itinerary current_itinerary VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE road CHANGE itinerary itinerary VARCHAR(255) DEFAULT NULL, CHANGE target_chapter_id target_chapter_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE road ADD CONSTRAINT FK_95C0C4B165739FF9 FOREIGN KEY (target_chapter_id) REFERENCES chapter (id)');
        $this->addSql('CREATE INDEX IDX_95C0C4B165739FF9 ON road (target_chapter_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chapter CHANGE itinerary itinerary VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE `character` CHANGE user_id user_id INT DEFAULT NULL, CHANGE class class VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE gender gender VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE life_point life_point VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE dexterity dexterity VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE attack attack VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE defense defense VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE level level VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE current_chapter current_chapter INT DEFAULT NULL, CHANGE current_itinerary current_itinerary VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE road DROP FOREIGN KEY FK_95C0C4B165739FF9');
        $this->addSql('DROP INDEX IDX_95C0C4B165739FF9 ON road');
        $this->addSql('ALTER TABLE road CHANGE target_chapter_id target_chapter_id INT DEFAULT NULL, CHANGE itinerary itinerary VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
