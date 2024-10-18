<?php

namespace Migrations;

use Core\orm\DB;


class UserMigrations
{
    function up()
    {
        DB::runQuery('
    CREATE TABLE users (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);'
        );
    }

    function down()
    {
        DB::runQuery('DROP TABLE users');
    }

}
