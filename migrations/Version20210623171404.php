<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210623171404 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE statistics DROP FOREIGN KEY FK_E2D38B22F6AE09D7');
        $this->addSql('CREATE TABLE flashcard (id INT AUTO_INCREMENT NOT NULL, group_id INT DEFAULT NULL, content VARCHAR(255) NOT NULL, translation VARCHAR(255) NOT NULL, INDEX IDX_70511A09FE54D947 (group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE flashcard ADD CONSTRAINT FK_70511A09FE54D947 FOREIGN KEY (group_id) REFERENCES `group` (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE flash_card');
        $this->addSql('ALTER TABLE `group` DROP FOREIGN KEY FK_6DC044C59D86650F');
        $this->addSql('DROP INDEX IDX_6DC044C59D86650F ON `group`');
        $this->addSql('ALTER TABLE `group` ADD user_id INT DEFAULT NULL, DROP user_id_id');
        $this->addSql('ALTER TABLE `group` ADD CONSTRAINT FK_6DC044C5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_6DC044C5A76ED395 ON `group` (user_id)');
        $this->addSql('ALTER TABLE statistics DROP FOREIGN KEY FK_E2D38B222F68B530');
        $this->addSql('DROP INDEX UNIQ_E2D38B22F6AE09D7 ON statistics');
        $this->addSql('DROP INDEX IDX_E2D38B222F68B530 ON statistics');
        $this->addSql('ALTER TABLE statistics ADD flashcard_id INT DEFAULT NULL, ADD group_id INT DEFAULT NULL, DROP flash_card_id_id, DROP group_id_id');
        $this->addSql('ALTER TABLE statistics ADD CONSTRAINT FK_E2D38B22C5D16576 FOREIGN KEY (flashcard_id) REFERENCES flashcard (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE statistics ADD CONSTRAINT FK_E2D38B22FE54D947 FOREIGN KEY (group_id) REFERENCES `group` (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E2D38B22C5D16576 ON statistics (flashcard_id)');
        $this->addSql('CREATE INDEX IDX_E2D38B22FE54D947 ON statistics (group_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE statistics DROP FOREIGN KEY FK_E2D38B22C5D16576');
        $this->addSql('CREATE TABLE flash_card (id INT AUTO_INCREMENT NOT NULL, group_id_id INT NOT NULL, content VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, translation VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_2D5196802F68B530 (group_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE flash_card ADD CONSTRAINT FK_2D5196802F68B530 FOREIGN KEY (group_id_id) REFERENCES `group` (id)');
        $this->addSql('DROP TABLE flashcard');
        $this->addSql('ALTER TABLE `group` DROP FOREIGN KEY FK_6DC044C5A76ED395');
        $this->addSql('DROP INDEX IDX_6DC044C5A76ED395 ON `group`');
        $this->addSql('ALTER TABLE `group` ADD user_id_id INT NOT NULL, DROP user_id');
        $this->addSql('ALTER TABLE `group` ADD CONSTRAINT FK_6DC044C59D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6DC044C59D86650F ON `group` (user_id_id)');
        $this->addSql('ALTER TABLE statistics DROP FOREIGN KEY FK_E2D38B22FE54D947');
        $this->addSql('DROP INDEX UNIQ_E2D38B22C5D16576 ON statistics');
        $this->addSql('DROP INDEX IDX_E2D38B22FE54D947 ON statistics');
        $this->addSql('ALTER TABLE statistics ADD flash_card_id_id INT NOT NULL, ADD group_id_id INT NOT NULL, DROP flashcard_id, DROP group_id');
        $this->addSql('ALTER TABLE statistics ADD CONSTRAINT FK_E2D38B222F68B530 FOREIGN KEY (group_id_id) REFERENCES `group` (id)');
        $this->addSql('ALTER TABLE statistics ADD CONSTRAINT FK_E2D38B22F6AE09D7 FOREIGN KEY (flash_card_id_id) REFERENCES flash_card (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E2D38B22F6AE09D7 ON statistics (flash_card_id_id)');
        $this->addSql('CREATE INDEX IDX_E2D38B222F68B530 ON statistics (group_id_id)');
    }
}
