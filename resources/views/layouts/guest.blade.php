<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cormorant-garamond:400,500,600,700i&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=dm-sans:300,400,500&display=swap" rel="stylesheet" />

    <!-- App CSS + Theme CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">

    {{-- ── Theme variable injection — mirrors app.blade.php exactly ── --}}
    @php
        $theme = session('mlm_theme')
            ?? request()->cookie('mlm_theme')
            ?? 'obsidian';

        $themes = [
            'obsidian' => [
                '--bg'          => '#0A0A0F',
                '--bg-2'        => '#111118',
                '--bg-3'        => '#1C1C24',
                '--sidebar-bg'  => '#111118',
                '--topbar-bg'   => '#0F0F15',
                '--accent'      => '#8b5cf6',
                '--accent-dim'  => 'rgba(139,92,246,0.12)',
                '--accent-text' => '#c4b5fd',
                '--accentGlow'  => 'rgba(139,92,246,0.25)',
                '--border'      => 'rgba(139,92,246,0.15)',
                '--border-soft' => 'rgba(255,255,255,0.06)',
                '--text'        => '#F0EDE6',
                '--text-muted'  => 'rgba(240,237,230,0.45)',
                '--text-faint'  => 'rgba(240,237,230,0.25)',
                '--success'     => '#4ade80',
                '--warning'     => '#fbbf24',
                '--danger'      => '#f87171',
                '--shadow'      => '0 4px 24px rgba(0,0,0,0.5)',
            ],
            'arctic' => [
                '--bg'          => '#F8F9FC',
                '--bg-2'        => '#FFFFFF',
                '--bg-3'        => '#F0F2F7',
                '--sidebar-bg'  => '#FFFFFF',
                '--topbar-bg'   => '#FFFFFF',
                '--accent'      => '#1A1A2E',
                '--accent-dim'  => 'rgba(26,26,46,0.08)',
                '--accent-text' => '#1A1A2E',
                '--accentGlow'  => 'rgba(26,26,46,0.15)',
                '--border'      => '#E2E5F0',
                '--border-soft' => '#EEF0F7',
                '--text'        => '#1A1A2E',
                '--text-muted'  => '#64748b',
                '--text-faint'  => '#94a3b8',
                '--success'     => '#16a34a',
                '--warning'     => '#d97706',
                '--danger'      => '#dc2626',
                '--shadow'      => '0 2px 12px rgba(26,26,46,0.08)',
            ],
            'ember' => [
                '--bg'          => '#0F0A0A',
                '--bg-2'        => '#150D0D',
                '--bg-3'        => '#1E1212',
                '--sidebar-bg'  => '#130B0B',
                '--topbar-bg'   => '#0F0A0A',
                '--accent'      => '#ef4444',
                '--accent-dim'  => 'rgba(239,68,68,0.12)',
                '--accent-text' => '#fca5a5',
                '--accentGlow'  => 'rgba(239,68,68,0.25)',
                '--border'      => 'rgba(239,68,68,0.15)',
                '--border-soft' => 'rgba(255,255,255,0.05)',
                '--text'        => '#FFF1F1',
                '--text-muted'  => 'rgba(255,241,241,0.45)',
                '--text-faint'  => 'rgba(255,241,241,0.22)',
                '--success'     => '#4ade80',
                '--warning'     => '#fbbf24',
                '--danger'      => '#f87171',
                '--shadow'      => '0 4px 24px rgba(0,0,0,0.55)',
            ],
            'forest' => [
                '--bg'          => '#07100C',
                '--bg-2'        => '#0C1610',
                '--bg-3'        => '#111F15',
                '--sidebar-bg'  => '#0B150E',
                '--topbar-bg'   => '#08110C',
                '--accent'      => '#22c55e',
                '--accent-dim'  => 'rgba(34,197,94,0.12)',
                '--accent-text' => '#86efac',
                '--accentGlow'  => 'rgba(34,197,94,0.22)',
                '--border'      => 'rgba(34,197,94,0.14)',
                '--border-soft' => 'rgba(255,255,255,0.05)',
                '--text'        => '#F0FAF3',
                '--text-muted'  => 'rgba(240,250,243,0.45)',
                '--text-faint'  => 'rgba(240,250,243,0.22)',
                '--success'     => '#4ade80',
                '--warning'     => '#fbbf24',
                '--danger'      => '#f87171',
                '--shadow'      => '0 4px 24px rgba(0,0,0,0.55)',
            ],
            'sapphire' => [
                '--bg'          => '#070B14',
                '--bg-2'        => '#0B1020',
                '--bg-3'        => '#111828',
                '--sidebar-bg'  => '#0A1020',
                '--topbar-bg'   => '#080D18',
                '--accent'      => '#3b82f6',
                '--accent-dim'  => 'rgba(59,130,246,0.12)',
                '--accent-text' => '#93c5fd',
                '--accentGlow'  => 'rgba(59,130,246,0.25)',
                '--border'      => 'rgba(59,130,246,0.15)',
                '--border-soft' => 'rgba(255,255,255,0.05)',
                '--text'        => '#EFF6FF',
                '--text-muted'  => 'rgba(239,246,255,0.45)',
                '--text-faint'  => 'rgba(239,246,255,0.22)',
                '--success'     => '#4ade80',
                '--warning'     => '#fbbf24',
                '--danger'      => '#f87171',
                '--shadow'      => '0 4px 24px rgba(0,0,0,0.55)',
            ],
            'luxe' => [
                '--bg'          => '#0A0800',
                '--bg-2'        => '#120F02',
                '--bg-3'        => '#1A1500',
                '--sidebar-bg'  => '#100D00',
                '--topbar-bg'   => '#0D0A00',
                '--accent'      => '#C9A84C',
                '--accent-dim'  => 'rgba(201,168,76,0.12)',
                '--accent-text' => '#E8C97A',
                '--accentGlow'  => 'rgba(201,168,76,0.22)',
                '--border'      => 'rgba(201,168,76,0.18)',
                '--border-soft' => 'rgba(255,255,255,0.05)',
                '--text'        => '#FDF6E3',
                '--text-muted'  => 'rgba(253,246,227,0.45)',
                '--text-faint'  => 'rgba(253,246,227,0.22)',
                '--success'     => '#4ade80',
                '--warning'     => '#fbbf24',
                '--danger'      => '#f87171',
                '--shadow'      => '0 4px 24px rgba(0,0,0,0.55)',
            ],
        ];

        $vars    = $themes[$theme] ?? $themes['obsidian'];
        $cssVars = collect($vars)->map(fn($v, $k) => "$k: $v")->implode('; ');
    @endphp

    <style>
        :root {
            {{ $cssVars }};
            --font-display : 'Cormorant Garamond', Georgia, serif;
            --font-body    : 'DM Sans', sans-serif;
            --font-mono    : 'Fira Code', 'Cascadia Code', monospace;
        }
    </style>
</head>

<body>
    {{ $slot }}
</body>
</html>