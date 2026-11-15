<?php

it('shows the plan profit simulator at the top of the landing hero', function () {
    $html = $this->get('/')
        ->assertOk()
        ->assertSee('id="plan-simulator"', false)
        ->assertSee(route('website.plan-calculator'), false)
        ->assertSee('Profitability advisor')
        ->assertSee('js/plan-simulator.js', false)
        ->getContent();

    // The simulator comes before the original hero headline.
    expect(strpos($html, 'id="plan-simulator"'))->toBeLessThan(strpos($html, 'class="hero-eyebrow"'));
});

it('serves the dedicated MLM plan calculator page with SEO markup', function () {
    $this->get('/mlm-plan-calculator')
        ->assertOk()
        ->assertSee('<title>Free MLM Plan Calculator &amp; Profit Simulator (India)', false)
        ->assertSee('<meta name="description"', false)
        ->assertSee('rel="canonical" href="'.route('website.plan-calculator').'"', false)
        ->assertSee('"@type": "WebApplication"', false)
        ->assertSee('"@type": "FAQPage"', false)
        ->assertSee('"@type": "BreadcrumbList"', false)
        ->assertSee('id="plan-simulator"', false)
        ->assertSee('How is binary pair income calculated?');
});

it('lists the calculator in the sitemap', function () {
    $this->get('/sitemap.xml')->assertOk()->assertSee(url('/mlm-plan-calculator'), false);
});

it('ships the simulator script with every plan type', function () {
    $js = file_get_contents(public_path('js/plan-simulator.js'));

    foreach (['binary', 'unilevel', 'matrix', 'monoline', 'board'] as $plan) {
        expect($js)->toContain("{$plan}: [");
    }
});
