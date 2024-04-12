<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240412101651 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, brand VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement_room (equipement_id INT NOT NULL, room_id INT NOT NULL, INDEX IDX_9D43C8AB806F0F5C (equipement_id), INDEX IDX_9D43C8AB54177093 (room_id), PRIMARY KEY(equipement_id, room_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervention (id INT AUTO_INCREMENT NOT NULL, tech_id INT NOT NULL, contact TINYINT(1) DEFAULT NULL, type VARCHAR(100) DEFAULT NULL, resolved VARCHAR(50) DEFAULT NULL, canceled VARCHAR(20) DEFAULT NULL, description LONGTEXT DEFAULT NULL, date_time DATETIME NOT NULL, INDEX IDX_D11814AB64727BFC (tech_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervention_room (intervention_id INT NOT NULL, room_id INT NOT NULL, INDEX IDX_7D2049598EAE3863 (intervention_id), INDEX IDX_7D20495954177093 (room_id), PRIMARY KEY(intervention_id, room_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervention_equipement (intervention_id INT NOT NULL, equipement_id INT NOT NULL, INDEX IDX_FA49BCFE8EAE3863 (intervention_id), INDEX IDX_FA49BCFE806F0F5C (equipement_id), PRIMARY KEY(intervention_id, equipement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, equipement_id INT NOT NULL, name VARCHAR(150) NOT NULL, type VARCHAR(100) NOT NULL, file VARCHAR(255) NOT NULL, INDEX IDX_6A2CA10C806F0F5C (equipement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, theatre_id INT NOT NULL, number INT NOT NULL, INDEX IDX_729F519BC80060CD (theatre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tech (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_86BC3012A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theatre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(200) NOT NULL, location VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipement_room ADD CONSTRAINT FK_9D43C8AB806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipement_room ADD CONSTRAINT FK_9D43C8AB54177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814AB64727BFC FOREIGN KEY (tech_id) REFERENCES tech (id)');
        $this->addSql('ALTER TABLE intervention_room ADD CONSTRAINT FK_7D2049598EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention_room ADD CONSTRAINT FK_7D20495954177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention_equipement ADD CONSTRAINT FK_FA49BCFE8EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention_equipement ADD CONSTRAINT FK_FA49BCFE806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id)');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519BC80060CD FOREIGN KEY (theatre_id) REFERENCES theatre (id)');
        $this->addSql('ALTER TABLE tech ADD CONSTRAINT FK_86BC3012A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipement_room DROP FOREIGN KEY FK_9D43C8AB806F0F5C');
        $this->addSql('ALTER TABLE equipement_room DROP FOREIGN KEY FK_9D43C8AB54177093');
        $this->addSql('ALTER TABLE intervention DROP FOREIGN KEY FK_D11814AB64727BFC');
        $this->addSql('ALTER TABLE intervention_room DROP FOREIGN KEY FK_7D2049598EAE3863');
        $this->addSql('ALTER TABLE intervention_room DROP FOREIGN KEY FK_7D20495954177093');
        $this->addSql('ALTER TABLE intervention_equipement DROP FOREIGN KEY FK_FA49BCFE8EAE3863');
        $this->addSql('ALTER TABLE intervention_equipement DROP FOREIGN KEY FK_FA49BCFE806F0F5C');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C806F0F5C');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519BC80060CD');
        $this->addSql('ALTER TABLE tech DROP FOREIGN KEY FK_86BC3012A76ED395');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE equipement_room');
        $this->addSql('DROP TABLE intervention');
        $this->addSql('DROP TABLE intervention_room');
        $this->addSql('DROP TABLE intervention_equipement');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE tech');
        $this->addSql('DROP TABLE theatre');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
