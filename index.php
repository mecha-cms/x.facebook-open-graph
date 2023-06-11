<?php namespace x\facebook_open_graph;

function content($content) {
    if (!$content || false === \strpos($content, '</head>')) {
        return $content;
    }
    \extract($GLOBALS, \EXTR_SKIP);
    if (empty($page)) {
        return $content;
    }
    $out = [false, [], []];
    if ($description = \w($page->description ?? $site->description ?? "")) {
        $out[1]['og:description'] = ['meta', false, [
            'content' => $description,
            'property' => 'og:description'
        ]];
    }
    $out[1]['og:image'] = ['meta', false, [
        'content' => $page->image ?? $url . '/favicon.ico',
        'property' => 'og:image'
    ]];
    $out[1]['og:site_name'] = ['meta', false, [
        'content' => \w($site->title),
        'property' => 'og:site_name'
    ]];
    if ($title = \w($page->title ?? $t ?? "")) {
        $out[1]['og:title'] = ['meta', false, [
            'content' => $title,
            'property' => 'og:title'
        ]];
    }
    $out[1]['og:type'] = ['meta', false, [
        'content' => $site->is('page') ? 'article' : 'website',
        'property' => 'og:type'
    ]];
    $out[1]['og:url'] = ['meta', false, [
        'content' => $url->current,
        'property' => 'og:url'
    ]];
    $out = new \HTML(\Hook::fire('y.facebook-open-graph', [$out], $page), true);
    return \strtr($content, ['</head>' => $out . '</head>']);
}

\Hook::set('content', __NAMESPACE__ . "\\content", 1.9);