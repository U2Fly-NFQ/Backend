<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220705062418 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rating (id INT AUTO_INCREMENT NOT NULL, account_id INT NOT NULL, flight_id INT NOT NULL, airline_id INT NOT NULL, rate INT NOT NULL, comment VARCHAR(255) DEFAULT NULL, INDEX IDX_D88926229B6B5FBA (account_id), INDEX IDX_D889262291F478C5 (flight_id), INDEX IDX_D8892622130D0C16 (airline_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D88926229B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D889262291F478C5 FOREIGN KEY (flight_id) REFERENCES flight (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622130D0C16 FOREIGN KEY (airline_id) REFERENCES airline (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE rating');
    }
}
