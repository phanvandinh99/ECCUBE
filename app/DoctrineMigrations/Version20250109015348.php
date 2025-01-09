<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250109015348 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE plg_customer_coupon_coupon_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE plg_customer_coupon_order_coupon_order_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE plg_customer_coupon (coupon_id INT NOT NULL, coupon_name VARCHAR(50) NOT NULL, discount_price NUMERIC(12, 2) NOT NULL, discount_rate INT NOT NULL, enable_flag BOOLEAN NOT NULL, available_from_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, available_to_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, create_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, update_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(coupon_id))');
        $this->addSql('COMMENT ON COLUMN plg_customer_coupon.available_from_date IS \'(DC2Type:datetime)\'');
        $this->addSql('COMMENT ON COLUMN plg_customer_coupon.available_to_date IS \'(DC2Type:datetime)\'');
        $this->addSql('COMMENT ON COLUMN plg_customer_coupon.create_date IS \'(DC2Type:datetime)\'');
        $this->addSql('COMMENT ON COLUMN plg_customer_coupon.update_date IS \'(DC2Type:datetime)\'');
        $this->addSql('CREATE TABLE plg_customer_coupon42_config (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE plg_customer_coupon_order (coupon_order_id INT NOT NULL, coupon_id INT NOT NULL, customer_id INT NOT NULL, coupon_cd VARCHAR(20) NOT NULL, coupon_name VARCHAR(50) NOT NULL, available_from_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, available_to_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, pre_order_id INT DEFAULT NULL, order_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, discount NUMERIC(12, 2) DEFAULT NULL, enable_flag BOOLEAN NOT NULL, create_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, update_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(coupon_order_id))');
        $this->addSql('CREATE INDEX IDX_43D46CD066C5951B ON plg_customer_coupon_order (coupon_id)');
        $this->addSql('COMMENT ON COLUMN plg_customer_coupon_order.available_from_date IS \'(DC2Type:datetime)\'');
        $this->addSql('COMMENT ON COLUMN plg_customer_coupon_order.available_to_date IS \'(DC2Type:datetime)\'');
        $this->addSql('COMMENT ON COLUMN plg_customer_coupon_order.order_date IS \'(DC2Type:datetime)\'');
        $this->addSql('COMMENT ON COLUMN plg_customer_coupon_order.create_date IS \'(DC2Type:datetime)\'');
        $this->addSql('COMMENT ON COLUMN plg_customer_coupon_order.update_date IS \'(DC2Type:datetime)\'');
        $this->addSql('ALTER TABLE plg_customer_coupon_order ADD CONSTRAINT FK_43D46CD066C5951B FOREIGN KEY (coupon_id) REFERENCES plg_customer_coupon (coupon_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE plg_customer_coupon_coupon_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE plg_customer_coupon_order_coupon_order_id_seq CASCADE');
        $this->addSql('ALTER TABLE plg_customer_coupon_order DROP CONSTRAINT FK_43D46CD066C5951B');
        $this->addSql('DROP TABLE plg_customer_coupon');
        $this->addSql('DROP TABLE plg_customer_coupon42_config');
        $this->addSql('DROP TABLE plg_customer_coupon_order');
    }
}
