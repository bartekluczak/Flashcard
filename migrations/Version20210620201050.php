<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210620201050 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE statistics (id INT AUTO_INCREMENT NOT NULL, flash_card_id_id INT NOT NULL, group_id_id INT NOT NULL, correct_count INT DEFAULT NULL, incorrect_count INT DEFAULT NULL, UNIQUE INDEX UNIQ_E2D38B22F6AE09D7 (flash_card_id_id), INDEX IDX_E2D38B222F68B530 (group_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE statistics ADD CONSTRAINT FK_E2D38B22F6AE09D7 FOREIGN KEY (flash_card_id_id) REFERENCES flash_card (id)');
        $this->addSql('ALTER TABLE statistics ADD CONSTRAINT FK_E2D38B222F68B530 FOREIGN KEY (group_id_id) REFERENCES `group` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE statistics');
    }
}
