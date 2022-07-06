<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220706155533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, avatar_id INT DEFAULT NULL, airport_id INT DEFAULT NULL, city_name VARCHAR(100) NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_2D5B023486383B10 (avatar_id), INDEX IDX_2D5B0234289F53C8 (airport_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B023486383B10 FOREIGN KEY (avatar_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234289F53C8 FOREIGN KEY (airport_id) REFERENCES airport (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE city');
    }
}
