<?php namespace _;

function facebook_open_graph($content) {
    extract($GLOBALS, \EXTR_SKIP);
    if (!empty($page)) {
        $out  = '<!-- Begin Facebook Open Graph -->';
        $out .= '<meta property="og:title" content="' . \w($site->trace) . '">';
        $out .= '<meta property="og:url" content="' . \r('&', '&amp;', $url->current) . '">';
        $out .= '<meta property="og:description" content="' . \w($page->description ?? $config->description) . '">';
        $out .= '<meta property="og:image" content="' . ($page->image ?? $url . '/favicon.ico') . '">';
        $out .= '<meta property="og:site_name" content="' . \w($config->title) . '">';
        $out .= '<meta property="og:type" content="' . ($config->is('page') ? 'article' : 'website') . '">';
        $out .= '<!-- End Facebook Open Graph -->';
        return \str_replace('</head>', $out . '</head>', $content);
    }
    return $content;
}

\Hook::set('content', __NAMESPACE__ . "\\facebook_open_graph", 1.9);