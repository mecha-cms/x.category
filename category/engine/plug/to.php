<?php

To::_('category', function($id) {
    if (is_int($id)) {
        // Search for external `id` data
        foreach (glob(LOT . DS . 'category' . DS . '*' . DS . 'id.data', GLOB_NOSORT) as $v) {
            if (is_file($v) && $id === (int) file_get_contents($v)) {
                return basename(dirname($v));
            }
        }
        // Search for embedded `id` data
        foreach (glob(LOT . DS . 'category' . DS . '*.{archive,page}', GLOB_BRACE | GLOB_NOSORT) as $v) {
            if (is_file($v) && $id === (From::page(file_get_contents($v))['id'] ?? null)) {
                return pathinfo($v, PATHINFO_FILENAME);
            }
        }
    }
    return null;
});