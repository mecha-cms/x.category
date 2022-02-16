<?php namespace x\category;

function category() {
    $id = null;
    foreach ((array) $this['kind'] as $v) {
        if (\is_string($v) && 0 === \strpos($v, 'c') && \is_numeric($i = \substr($v, 1))) {
            $id = (int) $i;
            break;
        }
    }
    if (\is_int($id) && ($name = To::category($id))) {
        $r = \LOT . \DS . 'category' . \DS . $name;
        if ($file = \File::exist([
            $r . '.archive',
            $r . '.page'
        ])) {
            $category = new \Category($file);
            $category->page = $this;
            $folder = \dirname($this->path);
            if ($file = \File::exist([
                $folder . '.archive',
                $folder . '.page'
            ])) {
                $category->parent = new \Page($file);
            }
            return $category;
        }
    }
    return null;
}

\Page::_('category', __NAMESPACE__ . "\\category");