<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170226102254 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE food_item_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) DEFAULT NULL, status SMALLINT NOT NULL, last_updated_date DATETIME DEFAULT NULL, created_date_time DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_item (id INT AUTO_INCREMENT NOT NULL, order_id INT DEFAULT NULL, food_item_id INT DEFAULT NULL, price NUMERIC(12, 2) DEFAULT NULL, quantity INT DEFAULT NULL, last_updated_date DATETIME DEFAULT NULL, created_date_time DATETIME DEFAULT NULL, INDEX IDX_52EA1F098D9F6D38 (order_id), INDEX IDX_52EA1F095DF08E66 (food_item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, status SMALLINT NOT NULL, total_cost NUMERIC(12, 2) DEFAULT NULL, last_updated_date DATETIME DEFAULT NULL, created_date_time DATETIME DEFAULT NULL, INDEX IDX_F5299398A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE food_item (id INT AUTO_INCREMENT NOT NULL, food_item_category_id INT DEFAULT NULL, name VARCHAR(20) DEFAULT NULL, price NUMERIC(12, 2) DEFAULT NULL, status SMALLINT NOT NULL, last_updated_date DATETIME DEFAULT NULL, created_date_time DATETIME DEFAULT NULL, INDEX IDX_AA3C8DCFD1FB7A21 (food_item_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F098D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F095DF08E66 FOREIGN KEY (food_item_id) REFERENCES food_item (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE food_item ADD CONSTRAINT FK_AA3C8DCFD1FB7A21 FOREIGN KEY (food_item_category_id) REFERENCES food_item_category (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE food_item DROP FOREIGN KEY FK_AA3C8DCFD1FB7A21');
        $this->addSql('ALTER TABLE order_item DROP FOREIGN KEY FK_52EA1F098D9F6D38');
        $this->addSql('ALTER TABLE order_item DROP FOREIGN KEY FK_52EA1F095DF08E66');
        $this->addSql('DROP TABLE food_item_category');
        $this->addSql('DROP TABLE order_item');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE food_item');
    }
}
