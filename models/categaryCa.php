<?php
require_once __DIR__ . '/DataStore.php';

class categary
{
    public function all(): array
    {
        return DataStore::fetchAll(
            'SELECT title, description, icon FROM services ORDER BY sort_order, id'
        );
    }
}
