<?php
if (!function_exists('dump')) {
    function dump(...$vars) {
        echo '<pre>';
        foreach ($vars as $v) {
            var_dump($v);
        }
        echo '</pre>';
    }
}

if (!function_exists('dd')) {
    function dd(...$vars) {
        dump(...$vars);
        die(1);
    }
}


if (!function_exists('filterQuanKey')) {
    /**
     * Sinh ra key filter_quan-{taxonomy}
     */
    function filterQuanKey($taxonomy) {
        return 'filter_quan-' . sanitize_key($taxonomy);
    }
}

if (!function_exists('taxonomyQuanKey')) {
    /**
     * Sinh ra taxonomy pa_quan-{taxonomy}
     */
    function taxonomyQuanKey($taxonomy) {
        return 'pa_quan-' . sanitize_key($taxonomy);
    }
}

if (!function_exists('quanLink')) {
    /**
     * Sinh ra taxonomy pa_quan-{taxonomy}
     */
    function quanLink($taxonomy, $slug) {
        // Key động cho filter_quan
        $filterQuanKey = filterQuanKey($taxonomy);

        // Gán giá trị quận hiện tại
        $_GET[$filterQuanKey] = $slug;

        // Tạo URL
        return add_query_arg($_GET, get_term_link( get_queried_object_id() ));
    }
}