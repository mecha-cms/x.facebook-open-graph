<?php namespace x\facebook_open_graph;

function content($content) {
    if (!$content || false === \strpos($content, '</head>')) {
        return $content;
    }
    \extract(\lot(), \EXTR_SKIP);
    if (empty($page)) {
        return $content;
    }
    $y = [false, [], []];
    if ($description = \w($page->description ?? $site->description ?? "")) {
        $y[1]['og:description'] = ['meta', false, [
            'content' => $description,
            'property' => 'og:description'
        ]];
    }
    $y[1]['og:image'] = ['meta', false, [
        'content' => $page->image ?? $url . '/favicon.ico',
        'property' => 'og:image'
    ]];
    $y[1]['og:site_name'] = ['meta', false, [
        'content' => \w($site->title),
        'property' => 'og:site_name'
    ]];
    if ($title = \w($page->title ?? $t ?? "")) {
        $y[1]['og:title'] = ['meta', false, [
            'content' => $title,
            'property' => 'og:title'
        ]];
    }
    $y[1]['og:type'] = ['meta', false, [
        'content' => $site->is('page') ? 'article' : 'website',
        'property' => 'og:type'
    ]];
    $y[1]['og:url'] = ['meta', false, [
        'content' => $url->current,
        'property' => 'og:url'
    ]];
    $v = new \HTML(\Hook::fire('y.facebook-open-graph', [$y], $page), true);
    return \strtr($content, ['</head>' => $v . '</head>']);
}

\Hook::set('content', __NAMESPACE__ . "\\content", 1.9);