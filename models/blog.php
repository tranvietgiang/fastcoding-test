<?php
require_once __DIR__ . '/DataStore.php';

class blog
{
    public function all(): array
    {
        return DataStore::fetchAll(
            [
                'SELECT date, category, title, description, author FROM blogs ORDER BY sort_order, id',
                'SELECT published_date AS date, category, title, description, author FROM blogs ORDER BY sort_order, id',
            ]
        );
    }
}
