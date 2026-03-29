<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260329135617 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_item CHANGE cart_id cart_id VARCHAR(255) NOT NULL, CHANGE product_id product_id VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX cart_product_unique ON cart_item (cart_id, product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX cart_product_unique ON cart_item');
        $this->addSql('ALTER TABLE cart_item CHANGE cart_id cart_id INT NOT NULL, CHANGE product_id product_id INT NOT NULL');
    }
}
