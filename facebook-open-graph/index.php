<?php

function fn_facebook_open_graph($content) {
    if ($page = Lot::get('page')) {
        global $site, $url;
        $html  = '<!-- Begin Facebook Open Graph -->';
        $html .= '<meta property="og:title" content="' . To::text($site->page->title) . '">';
        $html .= '<meta property="og:url" content="' . $url->current . '">';
        $html .= '<meta property="og:description" content="' . To::text($page->description($site->description)) . '">';
        $html .= '<meta property="og:image" content="' . $page->image($url . '/favicon.ico') . '">';
        $html .= '<meta property="og:site_name" content="' . To::text($site->title) . '">';
        $html .= '<meta property="og:type" content="' . ($site->type === 'page' ? 'article' : 'website') . '">';
        $html .= '<!-- End Facebook Open Graph -->';
        return str_ireplace('</head>', $html . '</head>', $content);
    }
    return $content;
}

Hook::set('shield.yield', 'fn_facebook_open_graph', 1.9);