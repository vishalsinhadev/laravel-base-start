<?php
if (! function_exists('getBaseImageUrl')) {

    /**
     *
     * @param
     *            $path
     * @param bool $secured
     *
     * @return string
     */
    function getBaseImageUrl($extra = '')
    {
        return "images.domain.com/" . $extra;
    }
}
