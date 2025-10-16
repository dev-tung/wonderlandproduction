<?php
namespace Building\Models;

class BuildingModel {

    public function page() {
        return get_term(get_queried_object_id(), 'product_cat');
    }

    public function quans($taxonomy, $hide_empty = false) {
        $terms = get_terms([
            'taxonomy'   => taxonomyQuanKey($taxonomy),
            'hide_empty' => $hide_empty,
        ]);

        return !is_wp_error($terms) ? $terms : [];
    }

    public function hangs($taxonomy)
    {
        $province = get_term_by('slug', $taxonomy, 'product_cat');

        if (!$province) {
            return [];
        }

        return get_terms([
            'taxonomy'   => 'product_cat',
            'hide_empty' => false,
            'parent'     => $province->term_id,
        ]);
    }


    public function buildingsQuan($taxonomy, $quans) {
        $response = [];

        foreach ($quans as $quan) {
            $response[$quan->term_id] = [
                'quan'      => $quan,
                'buildings' => get_posts(
                    [
                        'post_type'      => 'product',
                        'posts_per_page' => 4,
                        'tax_query'      => [
                            [
                                'taxonomy' => taxonomyQuanKey($taxonomy),
                                'field'    => 'term_id',
                                'terms'    => $quan->term_id,
                            ],
                        ],
                    ]
                )
            ];
        }  

        return $response;
    }

    public function buildings($taxonomy) {

        $args = [
            'post_type'      => 'product',
            'posts_per_page' => -1,
        ];

        // Tìm kiếm theo keyword
        if (!empty($_GET['s'])) {
            $args['s'] = sanitize_text_field($_GET['s']);
        }

        // Filter theo quận
        $filterQuanKey = filterQuanKey($taxonomy);

        if (!empty($_GET[$filterQuanKey])) {
            $terms = array_map('sanitize_text_field', explode(',', $_GET[$filterQuanKey]));
            $args['tax_query'][] = [
                'taxonomy' => taxonomyQuanKey($taxonomy),
                'field'    => 'slug',
                'terms'    => $terms,
                'operator' => 'IN',
            ];
        }

        // Lọc theo hạng (con của tỉnh đã chọn)
        if (!empty($_GET['filter_hang'])) {
            $terms = array_map('sanitize_text_field', explode(',', $_GET['filter_hang']));
            $args['tax_query'][] = [
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $terms,
                'operator' => 'IN',
            ];
        }

        // Lọc theo giá
        if (!empty($_GET['min_price']) || !empty($_GET['max_price'])) {
            $meta_query = ['relation' => 'AND'];

            if (!empty($_GET['min_price'])) {
                $meta_query[] = [
                    'key'     => '_price',
                    'value'   => (float) $_GET['min_price'],
                    'compare' => '>=',
                    'type'    => 'NUMERIC',
                ];
            }

            if (!empty($_GET['max_price'])) {
                $meta_query[] = [
                    'key'     => '_price',
                    'value'   => (float) $_GET['max_price'],
                    'compare' => '<=',
                    'type'    => 'NUMERIC',
                ];
            }

            $args['meta_query'] = $meta_query;
        }

        // Nếu có nhiều tax_query thì thêm relation
        if (!empty($args['tax_query']) && count($args['tax_query']) > 1) {
            $args['tax_query']['relation'] = 'AND';
        }

        return get_posts($args);
    }
}