<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210624221257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE statistics DROP INDEX IDX_E2D38B22FE54D947, ADD UNIQUE INDEX UNIQ_E2D38B22FE54D947 (group_id)');
        $this->addSql('ALTER TABLE statistics DROP FOREIGN KEY FK_E2D38B22C5D16576');
        $this->addSql('ALTER TABLE statistics DROP FOREIGN KEY FK_E2D38B22FE54D947');
        $this->addSql('DROP INDEX UNIQ_E2D38B22C5D16576 ON statistics');
        $this->addSql('ALTER TABLE statistics DROP flashcard_id');
        $this->addSql('ALTER TABLE statistics ADD CONSTRAINT FK_E2D38B22FE54D947 FOREIGN KEY (group_id) REFERENCES flashcard (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE statistics DROP INDEX UNIQ_E2D38B22FE54D947, ADD INDEX IDX_E2D38B22FE54D947 (group_id)');
        $this->addSql('ALTER TABLE statistics DROP FOREIGN KEY FK_E2D38B22FE54D947');
        $this->addSql('ALTER TABLE statistics ADD flashcard_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE statistics ADD CONSTRAINT FK_E2D38B22C5D16576 FOREIGN KEY (flashcard_id) REFERENCES flashcard (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE statistics ADD CONSTRAINT FK_E2D38B22FE54D947 FOREIGN KEY (group_id) REFERENCES `group` (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E2D38B22C5D16576 ON statistics (flashcard_id)');
    }
}
