<?php
require_once __DIR__ . '/DataStore.php';

class todaySell
{
    public function first(): array
    {
        $section = DataStore::fetchOne(
            'SELECT id, eyebrow, title, description FROM today_sell_sections ORDER BY sort_order, id LIMIT 1'
        );

        if (empty($section)) {
            return [];
        }

        $section['items'] = DataStore::fetchAll(
            'SELECT label FROM today_sell_items WHERE section_id = ' . (int) $section['id'] . ' ORDER BY sort_order, id'
        );
        $section['tabs'] = DataStore::fetchAll(
            'SELECT label FROM today_sell_tabs WHERE section_id = ' . (int) $section['id'] . ' ORDER BY sort_order, id'
        );

        return $section;
    }
}
