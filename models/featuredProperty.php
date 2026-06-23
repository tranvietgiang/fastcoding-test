<?php
require_once __DIR__ . '/DataStore.php';

class featuredProperty
{
    public function first(): array
    {
        $section = DataStore::fetchOne(
            'SELECT id, title, description, button_text FROM featured_property_sections ORDER BY sort_order, id LIMIT 1'
        );

        if (empty($section)) {
            return [];
        }

        $section['tabs'] = DataStore::fetchAll(
            'SELECT label, is_active FROM featured_property_tabs WHERE section_id = ' . (int) $section['id'] . ' ORDER BY sort_order, id'
        );
        $section['items'] = DataStore::fetchAll(
            'SELECT title, location, price, is_active FROM featured_property_items WHERE section_id = ' . (int) $section['id'] . ' ORDER BY sort_order, id'
        );

        return $section;
    }
}
