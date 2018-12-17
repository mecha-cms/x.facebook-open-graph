<?php namespace fn;

function facebook_open_graph($content) {
    extract(\Lot::get());
    if (!empty($page)) {
        $out  = '<!-- Begin Facebook Open Graph -->';
        $out .= '<meta property="og:title" content="' . \To::text($site->trace) . '">';
        $out .= '<meta property="og:url" content="' . $url->current . '">';
        $out .= '<meta property="og:description" content="' . \To::text($page->description ?: $config->description) . '">';
        $out .= '<meta property="og:image" content="' . ($page->image ?: $url . '/favicon.ico') . '">';
        $out .= '<meta property="og:site_name" content="' . \To::text($config->title) . '">';
        $out .= '<meta property="og:type" content="' . ($config->is('page') ? 'article' : 'website') . '">';
        $out .= '<!-- End Facebook Open Graph -->';
        return str_replace('</head>', $out . '</head>', $content);
    }
    return $content;
}

\Hook::set('shield.yield', __NAMESPACE__ . "\\facebook_open_graph", 1.9);