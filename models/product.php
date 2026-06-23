<?php
require_once __DIR__ . '/DataStore.php';

class product
{
    public function all(): array
    {
        return DataStore::fetchAll(
            'SELECT type, area, title, address, price FROM properties ORDER BY sort_order, id'
        );
    }
}
