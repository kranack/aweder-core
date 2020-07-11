<?php

namespace App\Traits;

use Illuminate\Support\Facades\Schema;

trait MigrationHelper
{
    public function doesTableHaveForeignKey(string $table, string $index): bool
    {
        $doctrineTable = Schema::getConnection()
            ->getDoctrineSchemaManager()
            ->listTableDetails($table);

        return $doctrineTable->hasForeignKey($index);
    }

    public function doesTableHaveIndexKey(string $table, string $index): bool
    {
        $doctrineTable = Schema::getConnection()
            ->getDoctrineSchemaManager()
            ->listTableDetails($table);
        dd($doctrineTable->getForeignKey());
        return $doctrineTable->hasIndex($index);
    }
}
