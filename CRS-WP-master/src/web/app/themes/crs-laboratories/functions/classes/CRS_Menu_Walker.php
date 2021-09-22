<?php


class CRS_Menu_Walker extends Walker_Nav_Menu
{
    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        $classes = [];

        if ($depth === 0) {
            $classes[] = 'hidden-list';
        }

        $output .= sprintf(
            '<ul class="%s">',
            implode(' ', $classes)
        );
    }

    public function end_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= '</ul>';
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $classes = [];

        $subListArrow = '';

        if ($this->has_children) {
            $classes[]    = 'with-hidden-list';
            $subListArrow = '<i class="fas fa-caret-down"></i>';
        }

        if ($item->current) {
            $classes[] = 'active';
        }

        if ($depth === 0) {
            $classes[] = 'nav-list-item';

            $output .= sprintf(
                '<li class="%s"><a href="' . esc_attr(
                    $item->url
                ) . '" class="nav-link">%s %s</a>',
                implode(' ', $classes),
                $item->title,
                $subListArrow
            );
            return;
        }

        if ($depth === 1) {
            $classes[] = 'hidden-list-item';

            $output .= sprintf(
                '<li class="%s"><a href="' . esc_attr($item->url) . '">%s</a>',
                implode(' ', $classes),
                $item->title
            );

            return;
        }
    }

    public function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= '</li>';
    }
}
