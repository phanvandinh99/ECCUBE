<?php

// Plugin/CustomerCoupon42/DoctrineMigrations/Version2025011501.php

namespace Plugin\CustomerCoupon42\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Migration to create tables for customer coupon.
 */
final class Version2025011501 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // Create table plg_customer_coupon
        $this->addSql('
            CREATE TABLE plg_customer_coupon (
                coupon_id SERIAL PRIMARY KEY,
                coupon_name VARCHAR(50) NOT NULL,
                discount_price NUMERIC(12,2),
                discount_rate INTEGER,
                enable_flag BOOLEAN DEFAULT TRUE,
                available_from_date TIMESTAMP(0) WITH TIME ZONE,
                available_to_date TIMESTAMP(0) WITH TIME ZONE,
                create_date TIMESTAMP(0) WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP,
                update_date TIMESTAMP(0) WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
            )
        ');

        // Create plg_customer_coupon_order
        $this->addSql('
            CREATE TABLE plg_customer_coupon_order (
                coupon_order_id SERIAL PRIMARY KEY,
                coupon_id INTEGER NOT NULL,
                customer_id INTEGER NOT NULL,
                coupon_cd VARCHAR(20),
                coupon_name VARCHAR(50),
                available_from_date TIMESTAMP(0) WITH TIME ZONE,
                available_to_date TIMESTAMP(0) WITH TIME ZONE,
                pre_order_id INTEGER,
                order_date TIMESTAMP(0) WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP,
                discount NUMERIC(12,2),
                enable_flag BOOLEAN DEFAULT TRUE,
                create_date TIMESTAMP(0) WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP,
                update_date TIMESTAMP(0) WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP,
                CONSTRAINT fk_coupon FOREIGN KEY (coupon_id) REFERENCES plg_customer_coupon (coupon_id) ON DELETE CASCADE,
                CONSTRAINT fk_customer FOREIGN KEY (customer_id) REFERENCES dtb_customer (id) ON DELETE CASCADE
            )
        ');

        // Insert data plg_customer_coupon
        $this->addSql('
            INSERT INTO plg_customer_coupon (coupon_name, discount_price, discount_rate, enable_flag, available_from_date, available_to_date)
            VALUES
            (\'Coupon 10%\', NULL, 10, TRUE, NOW(), NOW() + INTERVAL \'30 DAY\'),
            (\'Coupon 5000\', 5000.00, NULL, TRUE, NOW(), NOW() + INTERVAL \'30 DAY\')
        ');

        // Insert data plg_customer_coupon_order
        $this->addSql('
            INSERT INTO plg_customer_coupon_order (coupon_id, customer_id, coupon_cd, coupon_name, available_from_date, available_to_date, discount)
            VALUES
            (1, 1, \'COUPON10\', \'Coupon 10%\', NOW(), NOW() + INTERVAL \'30 DAY\', 100.00),
            (2, 2, \'COUPON5000\', \'Coupon 5000\', NOW(), NOW() + INTERVAL \'30 DAY\', 5000.00)
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE plg_customer_coupon_order');
        $this->addSql('DROP TABLE plg_customer_coupon');
    }
}
