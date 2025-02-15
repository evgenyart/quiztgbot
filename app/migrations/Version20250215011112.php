<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250215011112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
         $this->addSql('ALTER TABLE user_answers DROP COLUMN game_id');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user_answers ADD COLUMN game_id INT NOT NULL');
    }
}
