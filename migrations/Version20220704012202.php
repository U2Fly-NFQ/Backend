<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220704012202 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE test');
        $this->addSql('ALTER TABLE account CHANGE passenger_id passenger_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE flight DROP start_date, CHANGE start_time start_time DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, time TIME NOT NULL COMMENT \'(DC2Type:time_immutable)\', start_date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE account CHANGE passenger_id passenger_id INT NOT NULL');
        $this->addSql('ALTER TABLE flight ADD start_date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', CHANGE start_time start_time TIME NOT NULL COMMENT \'(DC2Type:time_immutable)\'');
    }
}
