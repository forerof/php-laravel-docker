<?php

if (! function_exists('selected_class')) {
    /**
     * Return a CSS class when the current request value for a key matches the given value.
     *
     * @param  string  $key
     * @param  mixed   $value
     * @param  string  $class
     * @return string
     */
    function selected_class(string $key, $value, string $class = 'text-danger'): string
    {
        return request($key) === $value ? $class : '';
    }
}

if (! function_exists('is_selected')) {
    /**
     * Return boolean whether the current request value for a key matches the given value.
     * Useful for Blade's @class directive.
     *
     * @param  string  $key
     * @param  mixed   $value
     * @return bool
     */
    function is_selected(string $key, $value): bool
    {
        return request($key) === $value;
    }
}
