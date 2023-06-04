<?php namespace x\facebook_open_graph;

function content($content) {
    \extract($GLOBALS, \EXTR_SKIP);
    if (!empty($page)) {
        $out  = '<!-- Begin Facebook Open Graph -->';
        if ($description = \w($page->description ?? $site->description ?? "")) {
            $out .= '<meta content="' . \eat($description) . '" property="og:description">';
        }
        $out .= '<meta content="' . \eat($page->image ?? $url . '/favicon.ico') . '" property="og:image">';
        $out .= '<meta content="' . \w($site->title) . '" property="og:site_name">';
        if ($title = \w($page->title ?? $t ?? "")) {
            $out .= '<meta content="' . $title . '" property="og:title">';
        }
        $out .= '<meta content="' . ($site->is('page') ? 'article' : 'website') . '" property="og:type">';
        $out .= '<meta content="' . \eat($url->current) . '" property="og:url">';
        $out .= '<!-- End Facebook Open Graph -->';
        return \strtr($content, ['</head>' => $out . '</head>']);
    }
    return $content;
}

\Hook::set('content', __NAMESPACE__ . "\\content", 1.9);