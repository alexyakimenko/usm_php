<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateRecipesTable extends AbstractMigration
{
    public function up(): void
    {
        $table = $this->table('recipes');
        $table
            ->addColumn('title', 'string', ['limit' => 255])
            ->addColumn('category', 'integer', ['signed' => false])
            ->addColumn('ingredients', 'text', ['null' => true])
            ->addColumn('description', 'text', ['null' => true])
            ->addColumn('tags', 'text', ['null' => true])
            ->addColumn('steps', 'text', ['null' => true])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP'
            ])
            ->addForeignKey('category', 'categories', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION'
            ])
            ->create();
    }

    public function down(): void
    {
        $this->table('recipes')->drop()->save();
    }
}
