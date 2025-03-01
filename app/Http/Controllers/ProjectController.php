<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
  public function index()
  {
    $partners = [
      [
        'name' => 'UNDP Malawi',
        'logo' => asset('images/partners/undp.png'),
        'description' => 'Supporting democratic governance and sustainable development initiatives.',
        'website' => 'https://www.mw.undp.org'
      ],
      [
        'name' => 'ActionAid Malawi',
        'logo' => asset('images/partners/actionaid.png'),
        'description' => 'Working together to fight poverty and injustice in communities.',
        'website' => 'https://malawi.actionaid.org'
      ],
      [
        'name' => 'World Bank Group',
        'logo' => asset('images/partners/world-bank.png'),
        'description' => 'Partnering on economic development and poverty reduction programs.',
        'website' => 'https://www.worldbank.org'
      ],
    ];

    $projects = [
      [
        'name' => 'Youth Empowerment Initiative',
        'description' => 'Empowering young people through skills development and entrepreneurship training.',
        'funded_by' => 'UNDP Malawi',
        'duration' => '2024 - Present',
        'image' => asset('images/projects/youth-empowerment.jpg'),
        'status' => 'ongoing',
        'key_achievements' => [
          'Trained 500+ youth in digital skills',
          'Launched 50 youth-led businesses',
          'Created 200+ employment opportunities'
        ]
      ],
      [
        'name' => 'Community Health Access Program',
        'description' => 'Improving access to healthcare services in rural communities.',
        'funded_by' => 'World Bank Group',
        'duration' => '2023 - 2025',
        'image' => asset('images/projects/health-access.jpg'),
        'status' => 'ongoing',
        'key_achievements' => [
          'Established 15 mobile clinics',
          'Served 10,000+ patients',
          'Trained 100 community health workers'
        ]
      ],
      [
        'name' => 'Sustainable Agriculture Project',
        'description' => 'Promoting climate-smart agriculture practices among smallholder farmers.',
        'funded_by' => 'ActionAid Malawi',
        'duration' => '2024 - 2026',
        'image' => asset('images/projects/agriculture.jpg'),
        'status' => 'ongoing',
        'key_achievements' => [
          'Trained 1,000+ farmers',
          'Implemented irrigation systems',
          'Increased crop yields by 40%'
        ]
      ],
    ];

    $impactStats = [
      [
        'number' => '50000',
        'suffix' => '+',
        'label' => 'People Reached',
        'icon' => 'users'
      ],
      [
        'number' => '32',
        'label' => 'Schools Supported',
        'icon' => 'academic-cap'
      ],
      [
        'number' => '85',
        'label' => 'Medical Camps',
        'icon' => 'heart'
      ],
      [
        'number' => '450',
        'suffix' => '+',
        'label' => 'Training Sessions',
        'icon' => 'academic-cap'
      ],
    ];

    return view('pages.project', compact('partners', 'projects', 'impactStats'));
  }
}
