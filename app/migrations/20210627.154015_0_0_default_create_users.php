<?php

namespace Migration;

use Spiral\Migrations\Migration;

class OrmDefault67a616602ac451d910a8a4fd89a7cfcd extends Migration
{
    protected const DATABASE = 'default';

    public function up(): void
    {
        $this->table('users')
            ->addColumn('id', 'integer', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('first_name', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 255
            ])
            ->addColumn('last_name', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 255
            ])
            ->setPrimaryKeys(["id"])
            ->create();
    }

    public function down(): void
    {
        $this->table('users')->drop();
    }
}
