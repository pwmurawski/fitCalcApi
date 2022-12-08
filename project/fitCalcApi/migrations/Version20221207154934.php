<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221207154934 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "foodProduct" (id UUID NOT NULL, user_id UUID NOT NULL, name VARCHAR(255) NOT NULL, kcal DOUBLE PRECISION NOT NULL, protein DOUBLE PRECISION NOT NULL, fat DOUBLE PRECISION NOT NULL, carbs DOUBLE PRECISION NOT NULL, code VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN "foodProduct".id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "foodProduct".user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE "meal" (id UUID NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN "meal".id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE "selectedProduct" (id UUID NOT NULL, meal_id UUID NOT NULL, user_id UUID NOT NULL, weight DOUBLE PRECISION NOT NULL, date_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, food_product_name VARCHAR(255) NOT NULL, food_product_kcal DOUBLE PRECISION NOT NULL, food_product_protein DOUBLE PRECISION NOT NULL, food_product_fat DOUBLE PRECISION NOT NULL, food_product_carbs DOUBLE PRECISION NOT NULL, food_product_code VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_196E77F5639666D6 ON "selectedProduct" (meal_id)');
        $this->addSql('COMMENT ON COLUMN "selectedProduct".id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "selectedProduct".meal_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "selectedProduct".user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE "user" (id UUID NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('COMMENT ON COLUMN "user".id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE "selectedProduct" ADD CONSTRAINT FK_196E77F5639666D6 FOREIGN KEY (meal_id) REFERENCES "meal" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "selectedProduct" DROP CONSTRAINT FK_196E77F5639666D6');
        $this->addSql('DROP TABLE "foodProduct"');
        $this->addSql('DROP TABLE "meal"');
        $this->addSql('DROP TABLE "selectedProduct"');
        $this->addSql('DROP TABLE "user"');
    }
}
