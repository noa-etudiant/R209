<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250602142412 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE etat (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, couleur VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE form_submission (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE note (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, etat_id INT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', end_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', propriete INT NOT NULL, INDEX IDX_CFBDFA14A76ED395 (user_id), INDEX IDX_CFBDFA14D5E86FF (etat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE note_tag (note_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_737A976326ED0855 (note_id), INDEX IDX_737A9763BAD26311 (tag_id), PRIMARY KEY(note_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, is_actif TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE vie_note (id INT AUTO_INCREMENT NOT NULL, createur_id INT NOT NULL, note_id INT NOT NULL, vie_note VARCHAR(255) NOT NULL, update_at DATETIME NOT NULL, INDEX IDX_1DB0ADB373A201E5 (createur_id), INDEX IDX_1DB0ADB326ED0855 (note_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14D5E86FF FOREIGN KEY (etat_id) REFERENCES etat (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE note_tag ADD CONSTRAINT FK_737A976326ED0855 FOREIGN KEY (note_id) REFERENCES note (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE note_tag ADD CONSTRAINT FK_737A9763BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE
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
            ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14D5E86FF
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE note_tag DROP FOREIGN KEY FK_737A976326ED0855
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE note_tag DROP FOREIGN KEY FK_737A9763BAD26311
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vie_note DROP FOREIGN KEY FK_1DB0ADB373A201E5
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vie_note DROP FOREIGN KEY FK_1DB0ADB326ED0855
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE etat
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE form_submission
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE note
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE note_tag
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE tag
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE user
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE vie_note
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
