<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190812193632 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE menu_section (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, section_number SMALLINT NOT NULL, section_title VARCHAR(255) NOT NULL, section_image VARCHAR(255) DEFAULT NULL, INDEX IDX_A5A86751A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_item (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, menu_section_id INT DEFAULT NULL, item_description VARCHAR(255) NOT NULL, item_price NUMERIC(5, 2) NOT NULL, item_image VARCHAR(255) DEFAULT NULL, INDEX IDX_D754D550A76ED395 (user_id), INDEX IDX_D754D550F98E57A8 (menu_section_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu_section ADD CONSTRAINT FK_A5A86751A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE menu_item ADD CONSTRAINT FK_D754D550A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE menu_item ADD CONSTRAINT FK_D754D550F98E57A8 FOREIGN KEY (menu_section_id) REFERENCES menu_section (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE menu_item DROP FOREIGN KEY FK_D754D550F98E57A8');
        $this->addSql('DROP TABLE menu_section');
        $this->addSql('DROP TABLE menu_item');
    }
}
