<?php

class Navwalker extends Walker_Nav_Menu
{
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $hasChildren = $args->walker->has_children;
        $hasTarget = $item->target;

        $liClasses = "navbar-item";

        $liClasses .= $item->classes[0] === "button" ? " {$item->classes[0]} " : null;
        $liClasses .= $item->classes[1] === "is-primary" || $item->classes[1] === "is-secondary"  ? "{$item->classes[1]}" : null;

        if ($hasChildren) {
            $output .= "<div class='{$liClasses} has-dropdown'>";
            $output .= "<div class='navbar-link'>{$item->title}</div>";
        } else {
            if ($hasTarget) {
                $output .= "<a class='{$liClasses}' href='{$item->url}' target='_blank' rel='noopener noreferrer'>{$item->title}";
            } else {
                $output .= "<a class='{$liClasses}' href='{$item->url}'>{$item->title}";
            }
        }

        // Adds has_children class to the item so end_el can determine if the current element has children
        if ($hasChildren) {
            $item->classes[] = 'has_children';
        }
    }

    public function end_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        if (in_array("has_children", $item->classes)) {

            $output .= "</div>";
        }
        $output .= "</a>";
    }

    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        $output .= "<div class='navbar-dropdown'>";
    }

    public function end_lvl(&$output, $depth = 0, $args = array())
    {

        $output .= "</div>";
    }
}
