<?php declare(strict_types=1);

namespace Migration;

use Spiral\Migrations\Migration;

class OrmDefault9fc0a3df3e8f6ae8f41d52169d176a6f extends Migration
{
    protected const DATABASE = 'default';

    public function up(): void
    {
        $this->table('telegram_api_update_entities')
            ->addColumn('id', 'primary', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('created_at', 'datetime', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('data', 'json', [
                'nullable' => false,
                'default'  => null
            ])
            ->setPrimaryKeys(["id"])
            ->create();
    }

    public function down(): void
    {
        $this->table('telegram_api_update_entities')->drop();
    }
}
