<?php namespace x;

function facebook_open_graph($content) {
    \extract($GLOBALS, \EXTR_SKIP);
    if (!empty($page)) {
        $out  = '<!-- Begin Facebook Open Graph -->';
        if ($description = \w($page->description ?? $site->description ?? "")) {
            $out .= '<meta property="og:description" content="' . $description . '">';
        }
        $out .= '<meta property="og:image" content="' . ($page->image ?? $url . '/favicon.ico') . '">';
        $out .= '<meta property="og:site_name" content="' . \w($site->title) . '">';
        if ($title = \w($page->title ?? $t ?? "")) {
            $out .= '<meta property="og:title" content="' . $title . '">';
        }
        $out .= '<meta property="og:type" content="' . ($site->is('page') ? 'article' : 'website') . '">';
        $out .= '<meta property="og:url" content="' . \r('&', '&amp;', $url->current) . '">';
        $out .= '<!-- End Facebook Open Graph -->';
        return \strtr($content, ['</head>' => $out . '</head>']);
    }
    return $content;
}

\Hook::set('content', __NAMESPACE__ . "\\facebook_open_graph", 1.9);