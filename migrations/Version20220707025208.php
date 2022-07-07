<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220707025208 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE account (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_7D3656A4E7927C74 (email), UNIQUE INDEX UNIQ_7D3656A43DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE airline (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, icao VARCHAR(10) NOT NULL, name VARCHAR(100) NOT NULL, rating DOUBLE PRECISION DEFAULT NULL, number_rating INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_EC141EF83DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE airline_rule (airline_id INT NOT NULL, rule_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_3A9B50AB130D0C16 (airline_id), INDEX IDX_3A9B50AB744E0351 (rule_id), PRIMARY KEY(airline_id, rule_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE airplane (id INT AUTO_INCREMENT NOT NULL, airline_id INT NOT NULL, name VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_2636002D130D0C16 (airline_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE airplane_seat_type (airplane_id INT NOT NULL, seat_type_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, seat_available INT NOT NULL, discount DOUBLE PRECISION NOT NULL, luggage_weight DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_577E2E9996E853C (airplane_id), INDEX IDX_577E2E94ECEE001 (seat_type_id), PRIMARY KEY(airplane_id, seat_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE airport (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, iata VARCHAR(10) NOT NULL, name VARCHAR(100) NOT NULL, city VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_7E91F7C23DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, airport_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, attractive INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_2D5B02343DA5256D (image_id), INDEX IDX_2D5B0234289F53C8 (airport_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE discount (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, percent DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flight (id INT AUTO_INCREMENT NOT NULL, airplane_id INT NOT NULL, code VARCHAR(10) NOT NULL, arrival VARCHAR(100) NOT NULL, departure VARCHAR(100) NOT NULL, start_time TIME NOT NULL, start_date DATE NOT NULL, duration DOUBLE PRECISION NOT NULL, is_refund TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_C257E60E996E853C (airplane_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(600) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE passenger (id INT AUTO_INCREMENT NOT NULL, account_id INT NOT NULL, name VARCHAR(100) NOT NULL, gender TINYINT(1) DEFAULT NULL, birthday DATETIME DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, identification VARCHAR(15) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_3BEFE8DD9B6B5FBA (account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating (id INT AUTO_INCREMENT NOT NULL, account_id INT NOT NULL, airline_id INT NOT NULL, ticket_flight_id INT DEFAULT NULL, rate INT NOT NULL, comment VARCHAR(255) DEFAULT NULL, create_at DATETIME NOT NULL, INDEX IDX_D88926229B6B5FBA (account_id), INDEX IDX_D8892622130D0C16 (airline_id), INDEX IDX_D8892622BCEA28F (ticket_flight_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rule (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seat_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, passenger_id INT NOT NULL, discount_id INT DEFAULT NULL, seat_type_id INT NOT NULL, total_price DOUBLE PRECISION NOT NULL, ticket_owner VARCHAR(100) NOT NULL, payment_id VARCHAR(255) NOT NULL, status INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_97A0ADA34502E565 (passenger_id), INDEX IDX_97A0ADA34C7C611F (discount_id), INDEX IDX_97A0ADA34ECEE001 (seat_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket_flight (id INT AUTO_INCREMENT NOT NULL, flight_id INT NOT NULL, ticket_id INT NOT NULL, is_rating TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME NOT NULL, INDEX IDX_B8158CC591F478C5 (flight_id), INDEX IDX_B8158CC5700047D2 (ticket_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE account ADD CONSTRAINT FK_7D3656A43DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE airline ADD CONSTRAINT FK_EC141EF83DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE airline_rule ADD CONSTRAINT FK_3A9B50AB130D0C16 FOREIGN KEY (airline_id) REFERENCES airline (id)');
        $this->addSql('ALTER TABLE airline_rule ADD CONSTRAINT FK_3A9B50AB744E0351 FOREIGN KEY (rule_id) REFERENCES rule (id)');
        $this->addSql('ALTER TABLE airplane ADD CONSTRAINT FK_2636002D130D0C16 FOREIGN KEY (airline_id) REFERENCES airline (id)');
        $this->addSql('ALTER TABLE airplane_seat_type ADD CONSTRAINT FK_577E2E9996E853C FOREIGN KEY (airplane_id) REFERENCES airplane (id)');
        $this->addSql('ALTER TABLE airplane_seat_type ADD CONSTRAINT FK_577E2E94ECEE001 FOREIGN KEY (seat_type_id) REFERENCES seat_type (id)');
        $this->addSql('ALTER TABLE airport ADD CONSTRAINT FK_7E91F7C23DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B02343DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234289F53C8 FOREIGN KEY (airport_id) REFERENCES airport (id)');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E996E853C FOREIGN KEY (airplane_id) REFERENCES airplane (id)');
        $this->addSql('ALTER TABLE passenger ADD CONSTRAINT FK_3BEFE8DD9B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D88926229B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622130D0C16 FOREIGN KEY (airline_id) REFERENCES airline (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622BCEA28F FOREIGN KEY (ticket_flight_id) REFERENCES ticket_flight (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA34502E565 FOREIGN KEY (passenger_id) REFERENCES passenger (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA34C7C611F FOREIGN KEY (discount_id) REFERENCES discount (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA34ECEE001 FOREIGN KEY (seat_type_id) REFERENCES seat_type (id)');
        $this->addSql('ALTER TABLE ticket_flight ADD CONSTRAINT FK_B8158CC591F478C5 FOREIGN KEY (flight_id) REFERENCES flight (id)');
        $this->addSql('ALTER TABLE ticket_flight ADD CONSTRAINT FK_B8158CC5700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE passenger DROP FOREIGN KEY FK_3BEFE8DD9B6B5FBA');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D88926229B6B5FBA');
        $this->addSql('ALTER TABLE airline_rule DROP FOREIGN KEY FK_3A9B50AB130D0C16');
        $this->addSql('ALTER TABLE airplane DROP FOREIGN KEY FK_2636002D130D0C16');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622130D0C16');
        $this->addSql('ALTER TABLE airplane_seat_type DROP FOREIGN KEY FK_577E2E9996E853C');
        $this->addSql('ALTER TABLE flight DROP FOREIGN KEY FK_C257E60E996E853C');
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B0234289F53C8');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA34C7C611F');
        $this->addSql('ALTER TABLE ticket_flight DROP FOREIGN KEY FK_B8158CC591F478C5');
        $this->addSql('ALTER TABLE account DROP FOREIGN KEY FK_7D3656A43DA5256D');
        $this->addSql('ALTER TABLE airline DROP FOREIGN KEY FK_EC141EF83DA5256D');
        $this->addSql('ALTER TABLE airport DROP FOREIGN KEY FK_7E91F7C23DA5256D');
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B02343DA5256D');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA34502E565');
        $this->addSql('ALTER TABLE airline_rule DROP FOREIGN KEY FK_3A9B50AB744E0351');
        $this->addSql('ALTER TABLE airplane_seat_type DROP FOREIGN KEY FK_577E2E94ECEE001');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA34ECEE001');
        $this->addSql('ALTER TABLE ticket_flight DROP FOREIGN KEY FK_B8158CC5700047D2');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622BCEA28F');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE airline');
        $this->addSql('DROP TABLE airline_rule');
        $this->addSql('DROP TABLE airplane');
        $this->addSql('DROP TABLE airplane_seat_type');
        $this->addSql('DROP TABLE airport');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE discount');
        $this->addSql('DROP TABLE flight');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE passenger');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE rule');
        $this->addSql('DROP TABLE seat_type');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('DROP TABLE ticket_flight');
    }
}
