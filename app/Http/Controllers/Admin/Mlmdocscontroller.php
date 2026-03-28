<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\Extension\TableOfContents\TableOfContentsExtension;
use League\CommonMark\MarkdownConverter;

class MlmDocsController extends Controller
{
    public function index()
    {
        $mdPath = base_path('docs/MLM_CONFIG_GUIDE.md');

        abort_unless(file_exists($mdPath), 404, 'Documentation file not found.');

        $markdown = file_get_contents($mdPath);

        // Build environment with GFM + heading anchors + TOC
        $environment = new Environment([
            'heading_permalink' => [
                'html_class'        => 'doc-anchor',
                'id_prefix'         => '',
                'fragment_prefix'   => '',
                'symbol'            => '#',
                'insert'            => 'before',
                'min_heading_level' => 1,
                'max_heading_level' => 3,
            ],
            'table_of_contents' => [
                'html_class'        => 'doc-toc-list',
                'position'          => 'placeholder',
                'placeholder'       => '[TOC]',
                'style'             => 'bullet',
                'min_heading_level' => 1,
                'max_heading_level' => 3,
                'normalize'         => 'relative',
            ],
        ]);

        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new GithubFlavoredMarkdownExtension());
        $environment->addExtension(new HeadingPermalinkExtension());
        $environment->addExtension(new TableOfContentsExtension());

        $converter = new MarkdownConverter($environment);
        $html      = $converter->convert($markdown)->getContent();

        return view('admin.mlm-docs', compact('html'));
    }
}