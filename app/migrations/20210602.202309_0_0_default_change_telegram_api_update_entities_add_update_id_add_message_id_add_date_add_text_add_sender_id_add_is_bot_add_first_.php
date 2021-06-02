<?php

namespace Migration;

use Spiral\Migrations\Migration;

class OrmDefault05b9e37f833ca9547213ac80c1b6d7d4 extends Migration
{
    protected const DATABASE = 'default';

    public function up(): void
    {
        $this->table('telegram_api_update_entities')
            ->addColumn('update_id', 'integer', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('message_id', 'integer', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('date', 'datetime', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('text', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 255
            ])
            ->addColumn('sender_id', 'integer', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('is_bot', 'boolean', [
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
            ->addColumn('username', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 255
            ])
            ->addColumn('language', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 255
            ])
            ->dropColumn('data')
            ->update();
    }

    public function down(): void
    {
        $this->table('telegram_api_update_entities')
            ->addColumn('data', 'text', [
                'nullable' => false,
                'default'  => null
            ])
            ->dropColumn('update_id')
            ->dropColumn('message_id')
            ->dropColumn('date')
            ->dropColumn('text')
            ->dropColumn('sender_id')
            ->dropColumn('is_bot')
            ->dropColumn('first_name')
            ->dropColumn('last_name')
            ->dropColumn('username')
            ->dropColumn('language')
            ->update();
    }
}
