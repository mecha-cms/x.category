<?php

From::_('category', function($name) {
    if (is_string($name)) {
        $r = LOT . DS . 'category' . DS . $name;
        // Get from external `id` data
        if (is_file($f = $r . DS . 'id.data') && filesize($f) > 0) {
            return (int) file_get_contents($f);
        } else if ($f = File::exist([
            $r . '.archive',
            $r . '.page'
        ])) {
            // Get from embedded `id` data
            return From::page(file_get_contents($f))['id'] ?? null;
        }
    }
    // Else…
    return null;
});