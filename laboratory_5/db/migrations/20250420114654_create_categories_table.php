<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateCategoriesTable extends AbstractMigration
{
    public function up(): void
    {
        $table = $this->table('categories');
        $table
            ->addColumn('name', 'string', ['limit' => 100])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP'
            ])
            ->addIndex(['name'], ['unique' => true])
            ->create();
    }

    public function down(): void
    {
        $this->table('categories')->drop()->save();
    }
}
