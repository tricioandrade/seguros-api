<?php

namespace App\Traits\Common;

trait SlugGeneratorTrait
{
    /**
     * Generate a text slug
     *
     * Code from stack-overflow
     * @link https://stackoverflow.com/questions/2955251/php-function-to-make-slug-url-string
     *
     * @param $text
     * @param string|null $divider
     * @return string
     */
    public function createSlug($text, ?string $divider = '-'): string
    {
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, $divider);
        $text = preg_replace('~-+~', $divider, $text);

        return strtolower($text);
    }
}
