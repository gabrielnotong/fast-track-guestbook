<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210117153326 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $pwd = '$argon2id$v=19$m=65536,t=4,p=1$R/ZpM0Z5Fjq7C6wS7YxBdQ$K2YIp5dfzY/1oYm6oKoaUHoGvEPDtQQoWXuZzoGehlE';
        $this->addSql("INSERT INTO admin (id, username, roles, password) VALUES (nextval('admin_id_seq'),'admin', '[\"ROLE_ADMIN\"]', '${pwd}')");
    }

    public function down(Schema $schema) : void
    {
    }
}
