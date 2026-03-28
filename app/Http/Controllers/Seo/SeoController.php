<?php

namespace App\Http\Controllers\Seo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function index()
    {
        $pages = [
            ['url' => '/', 'prop' => '1.0'],
            ['url' => '/pricing', 'prop' => '0.9'],
            ['url' => '/features', 'prop' => '0.8'],
            ['url' => '/contact', 'prop' => '0.7'],
            ['url' => '/binary-plan', 'prop' => '0.6'],
            ['url' => '/unilevel-plan', 'prop' => '0.6'],
            ['url' => '/matrix-plan', 'prop' => '0.6'],
            ['url' => '/blog/legality-of-mlm-in-india', 'prop' => '0.5'],
            ['url' => '/blog/how-to-select-best-mlm-software', 'prop' => '0.5'],
            ['url' => '/mlm-software-in-guwahati', 'prop' => '0.4'],
            ['url' => '/mlm-software-in-kolkata', 'prop' => '0.4'],
            ['url' => '/mlm-software-in-assam', 'prop' => '0.4'],
            ['url' => '/mlm-software-in-india', 'prop' => '0.4'],
            ['url' => '/mlm-software', 'prop' => '0.4'],
            ['url' => '/custom-mlm-software', 'prop' => '0.4'],
            ['url' => '/buy-mlm-software', 'prop' => '0.4'],
            ['url' => '/network-marketing-software', 'prop' => '0.4'],
            ['url' => '/mlm-software-development', 'prop' => '0.4'],
        ];

        return response()->view('sitemap', compact('pages'))
            ->header('Content-Type', 'text/xml');
    }
    public function features()
    {
        return view('seo.features');
    }
    public function contact()
    {
        return view('seo.contact');
    }
    public function binaryPlan()
    {
        return view('seo.binary-plan');
    }
    public function unilevelPlan()
    {
        return view('seo.unilevel-plan');
    }
    public function matrixPlan()
    {
        return view('seo.matrix-plan');
    }

    public function legalityOfMlmInIndia()
    {
        return view('seo.blog-legality-of-mlm-in-india');
    }
    public function howToSelectBestMlmSoftware()
    {
        return view('seo.blog-how-to-select-best-mlm-software');
    }
    public function mlmSoftwareGuwahati()
    {
        return view('seo.mlm-software-guwahati');
    }

    public function mlmSoftwareKolkata()
    {
        return view('seo.mlm-software-kolkata');
    }

    public function mlmSoftwareAssam()
    {
        return view('seo.mlm-software-assam');
    }

    public function mlmSoftwareIndia()
    {
        return view('seo.mlm-software-india');
    }

    public function mlmSoftware()
    {
        return view('seo.mlm-software');
    }

    public function customMlmSoftware()
    {
        return view('seo.custom-mlm-software');
    }

    public function buyMlmSoftware()
    {
        return view('seo.buy-mlm-software');
    }

    public function networkMarketingSoftware()
    {
        return view('seo.network-marketing-software');
    }

    public function mlmSoftwareDevelopment()
    {
        return view('seo.mlm-software-development');
    }
}
