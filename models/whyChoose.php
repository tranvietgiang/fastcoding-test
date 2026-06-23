<?php
require_once __DIR__ . '/DataStore.php';

class whyChoose
{
    public function first(): array
    {
        $section = DataStore::fetchOne(
            'SELECT id, title, description, rating FROM living_sections ORDER BY sort_order, id LIMIT 1'
        );

        if (empty($section)) {
            return [];
        }

        $section['features'] = DataStore::fetchAll(
            'SELECT icon, title, description FROM living_features WHERE section_id = ' . (int) $section['id'] . ' ORDER BY sort_order, id'
        );

        return $section;
    }
}
