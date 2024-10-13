<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241013170344 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, address VARCHAR(255) NOT NULL, additional_address VARCHAR(255) DEFAULT NULL, city VARCHAR(255) NOT NULL, zip_code VARCHAR(6) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE campus (id INT AUTO_INCREMENT NOT NULL, address_id INT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_9D096811F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membership (id INT AUTO_INCREMENT NOT NULL, approved TINYINT(1) DEFAULT 0 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, address_id INT NOT NULL, graduated_in_id INT NOT NULL, membership_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, phone_number VARCHAR(10) DEFAULT NULL, phone_prefix VARCHAR(3) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, graduated_at DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', UNIQUE INDEX UNIQ_8D93D649F5B7AF75 (address_id), INDEX IDX_8D93D6492D329C59 (graduated_in_id), UNIQUE INDEX UNIQ_8D93D6491FB354CD (membership_id), UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE campus ADD CONSTRAINT FK_9D096811F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6492D329C59 FOREIGN KEY (graduated_in_id) REFERENCES campus (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6491FB354CD FOREIGN KEY (membership_id) REFERENCES membership (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE campus DROP FOREIGN KEY FK_9D096811F5B7AF75');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649F5B7AF75');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6492D329C59');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6491FB354CD');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE campus');
        $this->addSql('DROP TABLE membership');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
