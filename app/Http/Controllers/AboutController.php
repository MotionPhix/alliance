<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AboutController extends Controller
{
  public function index(): View
  {
    return view('pages.about', [
      'values' => $this->getValues(),
      'team' => $this->getTeamMembers(),
      'timeline' => $this->getTimeline(),
      'partners' => $this->getPartners(),
    ]);
  }

  private function getValues(): array
  {
    return [
      [
        'icon' => 'scale',
        'title' => 'Integrity',
        'description' => 'We maintain high ethical standards and transparency in all our operations and relationships.',
      ],
      [
        'icon' => 'users',
        'title' => 'Community Focus',
        'description' => 'We prioritize the needs and voices of local communities in all our initiatives.',
      ],
      [
        'icon' => 'light-bulb',
        'title' => 'Innovation',
        'description' => 'We embrace creative solutions and new approaches to address development challenges.',
      ],
      [
        'icon' => 'hand',
        'title' => 'Accountability',
        'description' => 'We take responsibility for our actions and maintain transparency with our stakeholders.',
      ],
    ];
  }

  private function getTeamMembers(): array
  {
    return [
      [
        'name' => 'John Doe',
        'position' => 'Executive Director',
        'image' => 'img/team/director.jpg',
        'bio' => 'Over 15 years of experience in civil society organizations and community development.',
        'social' => [
          'linkedin' => '#',
          'twitter' => '#',
        ],
      ],
    ];
  }

  private function getTimeline(): array
  {
    return [
      [
        'year' => '2012',
        'title' => 'Foundation',
        'description' => 'Establishment of Citizen Alliance as a coalition of civil society organizations.',
      ],
      [
        'year' => '2015',
        'title' => 'Growth Phase',
        'description' => 'Expanded operations to cover all districts through Citizen Forums.',
      ],
      [
        'year' => '2018',
        'title' => 'Major Milestone',
        'description' => 'Successfully implemented nationwide governance monitoring program.',
      ],
      [
        'year' => '2023',
        'title' => 'Digital Transformation',
        'description' => 'Launched digital platforms for enhanced citizen engagement.',
      ],
    ];
  }

  private function getPartners(): array
  {
    return [
      [
        'name' => 'UNICEF',
        'logo' => 'images/partners/unicef.png',
        'website' => 'https://unicef.org',
      ],
    ];
  }
}
