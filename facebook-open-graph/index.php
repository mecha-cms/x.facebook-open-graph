<?php namespace _\lot\x;

function facebook_open_graph($content) {
    extract($GLOBALS, \EXTR_SKIP);
    if (!empty($page)) {
        $out  = '<!-- Begin Facebook Open Graph -->';
        $out .= '<meta property="og:title" content="' . \w($page->title ?? $t) . '">';
        $out .= '<meta property="og:url" content="' . \r('&', '&amp;', $url->current) . '">';
        if ($w = \w($page->description ?? $site->description ?? "")) {
            $out .= '<meta property="og:description" content="' . $w . '">';
        }
        $out .= '<meta property="og:image" content="' . ($page->image ?? $url . '/favicon.ico') . '">';
        $out .= '<meta property="og:site_name" content="' . \w($site->title) . '">';
        $out .= '<meta property="og:type" content="' . ($site->is('page') ? 'article' : 'website') . '">';
        $out .= '<!-- End Facebook Open Graph -->';
        return \str_replace('</head>', $out . '</head>', $content);
    }
    return $content;
}

\Hook::set('content', __NAMESPACE__ . "\\facebook_open_graph", 1.9);
