<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210621203145 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('INSERT INTO user (email, password, login, roles) values ("test@mail.com", "$2y$13$dsh.vvlKH/X7IO9l8tshGuqeNxaqmxkAVjfqIhFY2h3IaptdpKTuC", "test", "[]")');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM user WHERE login = "test@mail.com"');

    }
}
