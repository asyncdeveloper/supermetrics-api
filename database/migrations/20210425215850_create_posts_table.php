<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreatePostsTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('posts', ['signed' => false]);

        $table->addColumn('external_id', 'string')
            ->addColumn('from_name', 'string')
            ->addColumn('from_id', 'string')
            ->addColumn('message', 'text')
            ->addColumn('type', 'string')
            ->addColumn('created_time', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }
}
