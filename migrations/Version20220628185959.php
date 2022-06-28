<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220628185959 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE account (id INT AUTO_INCREMENT NOT NULL, passenger_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7D3656A4E7927C74 (email), UNIQUE INDEX UNIQ_7D3656A44502E565 (passenger_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE airline (id INT AUTO_INCREMENT NOT NULL, icao VARCHAR(10) NOT NULL, name VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE airplane (id INT AUTO_INCREMENT NOT NULL, airline_id INT NOT NULL, name VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_2636002D130D0C16 (airline_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE airplane_seat_type (airplane_id INT NOT NULL, seat_type_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, seat_available INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_577E2E9996E853C (airplane_id), INDEX IDX_577E2E94ECEE001 (seat_type_id), PRIMARY KEY(airplane_id, seat_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE airport (id INT AUTO_INCREMENT NOT NULL, iata VARCHAR(10) NOT NULL, name VARCHAR(100) NOT NULL, city VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE discount (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, percent DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flight (id INT AUTO_INCREMENT NOT NULL, airplane_id INT NOT NULL, code VARCHAR(10) NOT NULL, arrival VARCHAR(100) NOT NULL, departure VARCHAR(100) NOT NULL, start_time DATETIME NOT NULL, duration DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_C257E60E996E853C (airplane_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE luggage (id INT AUTO_INCREMENT NOT NULL, account_id INT NOT NULL, weight DOUBLE PRECISION NOT NULL, taken_time DATETIME NOT NULL, INDEX IDX_5907C8DA9B6B5FBA (account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE passenger (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, gender TINYINT(1) DEFAULT NULL, birthday DATE DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, identification VARCHAR(15) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seat_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, account_id INT NOT NULL, discount_id INT DEFAULT NULL, flight_id INT NOT NULL, seat_type_id INT NOT NULL, total_price DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_97A0ADA39B6B5FBA (account_id), INDEX IDX_97A0ADA34C7C611F (discount_id), INDEX IDX_97A0ADA391F478C5 (flight_id), INDEX IDX_97A0ADA34ECEE001 (seat_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE account ADD CONSTRAINT FK_7D3656A44502E565 FOREIGN KEY (passenger_id) REFERENCES passenger (id)');
        $this->addSql('ALTER TABLE airplane ADD CONSTRAINT FK_2636002D130D0C16 FOREIGN KEY (airline_id) REFERENCES airline (id)');
        $this->addSql('ALTER TABLE airplane_seat_type ADD CONSTRAINT FK_577E2E9996E853C FOREIGN KEY (airplane_id) REFERENCES airplane (id)');
        $this->addSql('ALTER TABLE airplane_seat_type ADD CONSTRAINT FK_577E2E94ECEE001 FOREIGN KEY (seat_type_id) REFERENCES seat_type (id)');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E996E853C FOREIGN KEY (airplane_id) REFERENCES airplane (id)');
        $this->addSql('ALTER TABLE luggage ADD CONSTRAINT FK_5907C8DA9B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA39B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA34C7C611F FOREIGN KEY (discount_id) REFERENCES discount (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA391F478C5 FOREIGN KEY (flight_id) REFERENCES flight (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA34ECEE001 FOREIGN KEY (seat_type_id) REFERENCES seat_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE luggage DROP FOREIGN KEY FK_5907C8DA9B6B5FBA');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA39B6B5FBA');
        $this->addSql('ALTER TABLE airplane DROP FOREIGN KEY FK_2636002D130D0C16');
        $this->addSql('ALTER TABLE airplane_seat_type DROP FOREIGN KEY FK_577E2E9996E853C');
        $this->addSql('ALTER TABLE flight DROP FOREIGN KEY FK_C257E60E996E853C');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA34C7C611F');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA391F478C5');
        $this->addSql('ALTER TABLE account DROP FOREIGN KEY FK_7D3656A44502E565');
        $this->addSql('ALTER TABLE airplane_seat_type DROP FOREIGN KEY FK_577E2E94ECEE001');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA34ECEE001');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE airline');
        $this->addSql('DROP TABLE airplane');
        $this->addSql('DROP TABLE airplane_seat_type');
        $this->addSql('DROP TABLE airport');
        $this->addSql('DROP TABLE discount');
        $this->addSql('DROP TABLE flight');
        $this->addSql('DROP TABLE luggage');
        $this->addSql('DROP TABLE passenger');
        $this->addSql('DROP TABLE seat_type');
        $this->addSql('DROP TABLE ticket');
    }
}
