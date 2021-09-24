<?php

class PageSelectorWidget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'PageSelectorWidget',
            __('Page selector Widget', 'crs-laboratories'),
            ['description' => __('Sample widget based on WPBeginner Tutorial', 'crs-laboratories'),]
        );
    }

    public function widget($args, $instance)
    {
        $page = $this->getPost($args);

        require get_theme_file_path("/template-parts/widget/back-button.php");
    }

    public function form($instance)
    {
    }

    protected function getPost($args): ?WP_Post
    {
        $post = crs_get_acf_widget_field('page', $args['widget_id']);

        if (empty($post)) {
            return null;
        }

        if (!function_exists('pll_current_language')) {
            return $post;
        }

        $currentLang = pll_current_language();
        $postLang    = pll_get_post_language($post->ID);

        if ($postLang === $currentLang) {
            return $post;
        }

        $postIdTranslated = pll_get_post($post->ID, $currentLang);

        if (empty($postIdTranslated)) {
            return null;
        }

        return get_post($postIdTranslated);
    }
}

add_action(
    'widgets_init',
    static function () {
        register_widget('PageSelectorWidget');
    }
);
