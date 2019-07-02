<?php
/**
 * @author Denys Salamatov <denysaw@gmail.com>
 */
declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190701215532 extends AbstractMigration
{

	public function up(Schema $schema) : void
	{
		// this up() migration is auto-generated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

		$this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, model VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, fuel VARCHAR(255) NOT NULL, power INT UNSIGNED NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
		$this->addSql('CREATE TABLE employees_cars (employee_id INT NOT NULL, car_id INT NOT NULL, INDEX IDX_5081A53B8C03F15C (employee_id), INDEX IDX_5081A53BC3C6F69F (car_id), PRIMARY KEY(employee_id, car_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
		$this->addSql('ALTER TABLE employees_cars ADD CONSTRAINT FK_5081A53B8C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE');
		$this->addSql('ALTER TABLE employees_cars ADD CONSTRAINT FK_5081A53BC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE');
	}

	public function down(Schema $schema) : void
	{
		// this down() migration is auto-generated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

		$this->addSql('ALTER TABLE employees_cars DROP FOREIGN KEY FK_5081A53BC3C6F69F');
		$this->addSql('ALTER TABLE employees_cars DROP FOREIGN KEY FK_5081A53B8C03F15C');
		$this->addSql('DROP TABLE employees_cars');
		$this->addSql('DROP TABLE car');
	}
}
