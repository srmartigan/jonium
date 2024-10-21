<?php

namespace Migrations;

use Core\orm\DB;


class UserMigrations
{
    function up()
    {
        DB::runQuery('
    CREATE TABLE users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        email TEXT NOT NULL,
        password TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);'
        );
    }

    function down()
    {
        DB::runQuery('DROP TABLE users');
    }

}
