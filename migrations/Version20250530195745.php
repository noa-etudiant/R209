<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250530195745 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE vie_note (id INT AUTO_INCREMENT NOT NULL, createur_id INT NOT NULL, note_id INT NOT NULL, vie_note VARCHAR(255) NOT NULL, update_at DATETIME NOT NULL, INDEX IDX_1DB0ADB373A201E5 (createur_id), INDEX IDX_1DB0ADB326ED0855 (note_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vie_note ADD CONSTRAINT FK_1DB0ADB373A201E5 FOREIGN KEY (createur_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vie_note ADD CONSTRAINT FK_1DB0ADB326ED0855 FOREIGN KEY (note_id) REFERENCES note (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE vie_note DROP FOREIGN KEY FK_1DB0ADB373A201E5
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vie_note DROP FOREIGN KEY FK_1DB0ADB326ED0855
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE vie_note
        SQL);
    }
}
