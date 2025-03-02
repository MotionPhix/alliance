<?php

return [
  // ...other configurations...

  'pages' => [
    'namespace' => 'App\\Filament\\Pages',
    'path' => app_path('Filament/Pages'),
    'register' => [
      \App\Filament\Pages\Dashboard::class,
    ],
  ],

  'widgets' => [
    'namespace' => 'App\\Filament\\Widgets',
    'path' => app_path('Filament/Widgets'),
    'register' => [
      \App\Filament\Widgets\ProjectsOverviewWidget::class,
      \App\Filament\Widgets\LatestProjectsWidget::class,
      \App\Filament\Widgets\ProjectStatisticsWidget::class,
      \App\Filament\Widgets\ProjectTagsWidget::class,
    ],
  ],

  'dark_mode' => [
    'enabled' => true,
    'switcher' => [
      'position' => 'bottom-right',
    ],
  ],

  'brand' => [
    'name' => 'Citizen Alliance',
    'logo' => resource_path('images/logo.png'),
    'colors' => [
      'primary' => [
        50 => '238, 242, 255',
        100 => '224, 231, 255',
        200 => '199, 210, 254',
        300 => '165, 180, 252',
        400 => '129, 140, 248',
        500 => '99, 102, 241',
        600 => '79, 70, 229',
        700 => '67, 56, 202',
        800 => '55, 48, 163',
        900 => '49, 46, 129',
      ],
    ],
  ],
];
