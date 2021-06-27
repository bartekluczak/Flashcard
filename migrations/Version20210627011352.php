<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210627011352 extends AbstractMigration
{
    public function gettranslation(): string
    {
        return 'Add defualt data';
    }

    public function up(Schema $schema): void
    {
        
        $this->addSql('INSERT INTO user (email, password, login, roles) VALUES ("aplikacjeinternetowe@mail.com", "$2y$13$dsh.vvlKH/X7IO9l8tshGuqeNxaqmxkAVjfqIhFY2h3IaptdpKTuC", "Aplikacje-Internetowe", "[]")');
        $this->addSql('INSERT INTO flashcard.group (user_id, name, description) VALUES (2, "Kuchnia", "Grupa do nauki słówek związanych z wyposażeniem kuchni")');
        $this->addSql('INSERT INTO flashcard (group_id, content, translation) VALUES (1, "Widelec", "Fork")');
        $this->addSql('INSERT INTO flashcard (group_id, content, translation) VALUES (1, "Lodówka", "Fridge")');
        $this->addSql('INSERT INTO flashcard (group_id, content, translation) VALUES (1, "Piekarnik", "Owen")');
        $this->addSql('INSERT INTO flashcard (group_id, content, translation) VALUES (1, "Talerz", "Plate")');
        $this->addSql('INSERT INTO flashcard (group_id, content, translation) VALUES (1, "Nóż", "Knife")');
        $this->addSql('INSERT INTO flashcard (group_id, content, translation) VALUES (1, "Łyżka", "Spoon")');
        $this->addSql('INSERT INTO flashcard (group_id, content, translation) VALUES (1, "Zlew", "Sink")');
        $this->addSql('INSERT INTO flashcard (group_id, content, translation) VALUES (1, "Szklanka", "Glass")');
        $this->addSql('INSERT INTO flashcard (group_id, content, translation) VALUES (1, "Kubek", "Cup")');
        $this->addSql('INSERT INTO flashcard (group_id, content, translation) VALUES (1, "Zmywarka", "Dishwasher")');
        

    }

    public function down(Schema $schema): void
    {
        
        $this->addSql('DELETE FROM flashcard WHERE content = "Widelec"');
        $this->addSql('DELETE FROM flashcard WHERE content = "Lodówka"');
        $this->addSql('DELETE FROM flashcard WHERE content = "Piekarnik"');
        $this->addSql('DELETE FROM flashcard WHERE content = "Talerz"');
        $this->addSql('DELETE FROM flashcard WHERE content = "Nóż"');
        $this->addSql('DELETE FROM flashcard WHERE content = "Łyżka"');
        $this->addSql('DELETE FROM flashcard WHERE content = "Zlew"');
        $this->addSql('DELETE FROM flashcard WHERE content = "Szklanka"');
        $this->addSql('DELETE FROM flashcard WHERE content = "Kuchenka Mikrofalowa"');
        $this->addSql('DELETE FROM flashcard WHERE content = "Zmywarka"');
        $this->addSql('DELETE FROM user WHERE email = "aplikacjeinternetowe@mail.com")');
        $this->addSql('DELETE FROM flashcard.group WHERE name = "Kuchnia"');
    }
}
