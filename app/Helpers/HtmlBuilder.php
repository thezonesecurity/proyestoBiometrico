<?php

namespace App\Helpers;

use Illuminate\Support\HtmlString;

class HtmlBuilder
{
    /**
     * @method toHtmlString
     * @param  string       $html
     * @return string | html
     */
    public function toHtmlString($html) {
        return new HtmlString($html);
    }

    /**
     * @param array $attributes
     * @return string
     */
    public function attributes($attributes) {
        $html = [];
        foreach ((array) $attributes as $key => $value) {
            $element = $this->attributeElement($key, $value);

            if (! is_null($element)) {
                $html[] = $element;
            }
        }
        return count($html) > 0 ? ' ' . implode(' ', $html) : '';
    }

    /**
     * @param string $key
     * @param string $value
     * @return string
     */
    protected function attributeElement($key, $value){
        if (is_numeric($key)) {
            $key = $value;
        }

        if (! is_null($value)) {
            return $key . '="' . $this->escapeAll($value) . '"';
        }
    }

    /**
     * @method escapeAll
     * @param string $value
     * @return string
     */
    public function escapeAll($value) {
        return htmlentities($value, ENT_QUOTES, 'UTF-8');
    }
}
