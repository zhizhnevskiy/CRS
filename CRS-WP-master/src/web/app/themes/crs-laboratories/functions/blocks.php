<?php

function crs_get_acf_field(string $name, $default = null)
{
    try {
        $fieldValue = get_field($name);
    } catch (Exception $e) {
        $fieldValue = false;
    }

    if (empty($fieldValue)) {
        return $default;
    }

    return $fieldValue;
}

function crs_get_acf_widget_field(string $name, string $widget_id, $default = null)
{
    try {
        $fieldValue = get_field($name, 'widget_' . $widget_id);
    } catch (Exception $e) {
        $fieldValue = false;
    }

    if (empty($fieldValue)) {
        return $default;
    }

    return $fieldValue;
}

function crs_get_acf_field_repeater_post(string $name, $default = null)
{
    $fieldValue = crs_get_acf_field($name, $default);

    if ($fieldValue === $default) {
        return $default;
    }

    return array_map(
        static function (WP_Post $post) {
            return [
                'url' => get_permalink($post),
                'title' => $post->post_title,
                'name' => $post->post_name,
                'date' => $post->post_date,
                'post' => $post,
            ];
        },
        array_filter(array_column($fieldValue, 'post'))
    );
}

function crs_register_acf_block(string $name, string $title, array $parameters)
{
    add_action(
        'acf/init',
        static function () use ($name, $title, $parameters) {
            // check function exists
            if (function_exists('acf_register_block')) {
                $keywords = isset($parameters['keywords']) && is_array(
                    $parameters['keywords']
                ) ? $parameters['keywords'] : ['testimonial', 'quote'];

                if (!in_array('CRS', $keywords, true)) {
                    $keywords[] = 'CRS';
                }

                acf_register_block(
                    [
                        'name' => $name,
                        'title' => $title,
                        'description' => $parameters['description'] ?? '',
                        'category' => $parameters['category'] ?? 'formatting',
                        'icon' => $parameters['icon'] ?? 'icon',
                        'keywords' => $keywords,
                        'example' => $parameters['example'],
                        'render_callback' => static function ($block, $content, $isPreview, $postId) {
                            $slug = str_replace('acf/', '', $block['name']);
                            $blockTemplate = get_theme_file_path("/template-parts/block/content-{$slug}.php");

                            $block['preview'] = $isPreview;

                            $block['preview_image'] = $block['example']['attributes']['data']['preview_image'];

                            if (file_exists($blockTemplate)) {
                                /** @noinspection PhpIncludeInspection */
                                include($blockTemplate);
                            } else {
                                /** @noinspection PhpIncludeInspection */
                                include(get_theme_file_path('/template-parts/block/content-empty.php'));
                            }
                        },
                    ]
                );
            }
        }
    );
}

crs_register_acf_block(
    'crs-page-top-block1',
    'CRS Page Top block 1',
    [
        'description' => __('The top block on page'),
        'category' => 'common',
        'icon' => 'align-full-width',
        'keywords' => ['CRS', 'Top', 'Block'],
        'example' => [
            'attributes' => [
                'mode' => 'preview',
                'data' => [
                    'preview_image' => get_stylesheet_directory_uri(
                        ) . "/assets/block_screenshots/CRS_Page_Top_block_1.png",
                    "is_preview" => 1
                ],
            ]
        ],
    ]
);

crs_register_acf_block(
    'crs-page-top-block2',
    'CRS Page Top block 2',
    [
        'description' => __('The top block on page'),
        'category' => 'common',
        'icon' => 'align-full-width',
        'keywords' => ['CRS', 'Top', 'Block'],
        'example' => [
            'attributes' => [
                'mode' => 'preview',
                'data' => [
                    'preview_image' => get_stylesheet_directory_uri(
                        ) . "/assets/block_screenshots/CRS_Page_Top_block_2.png",
                    "is_preview" => 1
                ],
            ]
        ],
    ]
);

crs_register_acf_block(
    'crs-page-top-block3',
    'CRS Page Top block 3',
    [
        'description' => __('The top block on page'),
        'category' => 'common',
        'icon' => 'align-full-width',
        'keywords' => ['CRS', 'Top', 'Block'],
        'example' => [
            'attributes' => [
                'mode' => 'preview',
                'data' => [
                    'preview_image' => get_stylesheet_directory_uri(
                        ) . "/assets/block_screenshots/CRS_Page_Top_block_3.png",
                    "is_preview" => 1
                ],
            ]
        ],
    ]
);

crs_register_acf_block(
    'crs-page-top-block4',
    'CRS Page Top block 4',
    [
        'description' => __('The top block on page'),
        'category' => 'common',
        'icon' => 'align-full-width',
        'keywords' => ['CRS', 'Top', 'Block'],
        'example' => [
            'attributes' => [
                'mode' => 'preview',
                'data' => [
                    'preview_image' => get_stylesheet_directory_uri(
                        ) . "/assets/block_screenshots/CRS_Page_Top_block_4.png",
                    "is_preview" => 1
                ],
            ]
        ],
    ]
);

crs_register_acf_block(
    'crs-page-middle-block1',
    'CRS Page Middle block 1',
    [
        'description' => __('The middle block on page'),
        'category' => 'common',
        'icon' => 'align-full-width',
        'keywords' => ['CRS', 'Middle', 'Block'],
        'example' => [
            'attributes' => [
                'mode' => 'preview',
                'data' => [
                    'preview_image' => get_stylesheet_directory_uri(
                        ) . "/assets/block_screenshots/CRS_Page_Middle_block_1.png",
                    "is_preview" => 1
                ],
            ]
        ],
    ]
);

crs_register_acf_block(
    'crs-page-middle-block2',
    'CRS Page Middle block 2',
    [
        'description' => __('The middle block on page'),
        'category' => 'common',
        'icon' => 'align-full-width',
        'keywords' => ['CRS', 'Middle', 'Block'],
        'example' => [
            'attributes' => [
                'mode' => 'preview',
                'data' => [
                    'preview_image' => "",
                    "is_preview" => 1
                ],
            ]
        ],
    ]
);

crs_register_acf_block(
    'crs-page-middle-block3',
    'CRS Page Middle block 3',
    [
        'description' => __('The middle block on page'),
        'category' => 'common',
        'icon' => 'align-full-width',
        'keywords' => ['CRS', 'Middle', 'Block'],
        'example' => [
            'attributes' => [
                'mode' => 'preview',
                'data' => [
                    'preview_image' => get_stylesheet_directory_uri(
                        ) . "/assets/block_screenshots/CRS_Page_Middle_block_2.png",
                    "is_preview" => 1
                ],
            ]
        ],
    ]
);

crs_register_acf_block(
    'crs-page-bottom-block1',
    'CRS Page Bottom block 1',
    [
        'description' => __('The bottom block on page'),
        'category' => 'common',
        'icon' => 'align-full-width',
        'keywords' => ['CRS', 'Bottom', 'Block'],
        'example' => [
            'attributes' => [
                'mode' => 'preview',
                'data' => [
                    'preview_image' => get_stylesheet_directory_uri(
                        ) . "/assets/block_screenshots/CRS_Page_Bottom_block_1.png",
                    "is_preview" => 1
                ],
            ]
        ],
    ]
);

crs_register_acf_block(
    'crs-page-bottom-block2',
    'CRS Page Bottom block 2',
    [
        'description' => __('The bottom block on page'),
        'category' => 'common',
        'icon' => 'align-full-width',
        'keywords' => ['CRS', 'Bottom', 'Block'],
        'example' => [
            'attributes' => [
                'mode' => 'preview',
                'data' => [
                    'preview_image' => get_stylesheet_directory_uri(
                        ) . "/assets/block_screenshots/CRS_Page_Bottom_block_2.png",
                    "is_preview" => 1
                ],
            ]
        ],
    ]
);

crs_register_acf_block(
    'crs-page-bottom-posts',
    'CRS Page bottom posts',
    [
        'description' => __('The bottom block on page'),
        'category' => 'common',
        'icon' => 'align-full-width',
        'keywords' => ['CRS', 'Bottom', 'Block'],
        'example' => [
            'attributes' => [
                'mode' => 'preview',
                'data' => [
                    'preview_image' => get_stylesheet_directory_uri(
                        ) . "/assets/block_screenshots/CRS_Page_bottom_posts.png",
                    "is_preview" => 1
                ],
            ]
        ],
    ]
);

crs_register_acf_block(
    'crs-page-button',
    'CRS Post button block',
    [
        'description' => __('The block for page with button'),
        'category' => 'common',
        'icon' => 'align-full-width',
        'keywords' => ['CRS', 'Button', 'Block'],
        'example' => [
            'attributes' => [
                'mode' => 'preview',
                'data' => [
                    'preview_image' => get_stylesheet_directory_uri(
                        ) . "/assets/block_screenshots/CRS_Post_button_block.png",
                    "is_preview" => 1
                ],
            ]
        ],
    ]
);

crs_register_acf_block(
    'crs-post-block',
    'CRS Post block',
    [
        'description' => __('The block for post'),
        'category' => 'common',
        'icon' => 'align-full-width',
        'keywords' => ['CRS', 'Post', 'Block'],
        'example' => [
            'attributes' => [
                'mode' => 'preview',
                'data' => [
                    'preview_image' => "",
                    "is_preview" => 1
                ],
            ]
        ],
    ]
);

crs_register_acf_block(
    'crs-special-headline',
    'CRS Special headline',
    [
        'description' => __('Special headline'),
        'category'    => 'common',
        'icon'        => 'align-full-width',
        'keywords'    => ['CRS', 'Special', 'Headline'],
        'example'     => [
            'attributes' => [
                'mode' => 'preview',
                'data' => [
                    'preview_image' => '',
                    'is_preview'    => 1,
                ],
            ],
        ],
    ]
);
