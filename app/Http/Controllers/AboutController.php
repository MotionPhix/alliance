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
        'name' => 'Linda Harawa',
        'position' => 'Chairperson',
        'image' => 'img/team/linda-harawa.jpg',
        'bio' => 'Over 15 years of experience in programme development, youth leadership, and child protection.',
        'social' => [
          'linkedin' => '#',
          'twitter' => '#',
        ],
      ],
      [
        'name' => 'John Chipeta',
        'position' => 'Vice Chairperson',
        'image' => 'img/team/john-chipeta.jpg',
        'bio' => 'Public policy expert with a focus on governance, leadership, and human rights.',
        'social' => [
          'linkedin' => '#',
          'twitter' => '#',
        ],
      ],
      [
        'name' => 'Stella Nkhonya Chisangwala',
        'position' => 'Board Member',
        'image' => 'img/team/stella-nkhonya.jpg',
        'bio' => 'Champion for disability rights and empowerment of women and girls with disabilities.',
        'social' => [
          'linkedin' => '#',
          'twitter' => '#',
        ],
      ],
      [
        'name' => 'Alemekezezeke Chitanje',
        'position' => 'Board Member',
        'image' => 'img/team/alemekezezeke-chitanje.jpg',
        'bio' => 'Lecturer in Teachers Education with a passion for philanthropic work and supporting vulnerable groups.',
        'social' => [
          'linkedin' => '#',
          'twitter' => '#',
        ],
      ],
      [
        'name' => 'Cyprian Chimbinya',
        'position' => 'Board Member',
        'image' => 'img/team/cyprian-chimbinya.jpg',
        'bio' => 'Governance and advocacy expert with extensive experience in community development and project management.',
        'social' => [
          'linkedin' => '#',
          'twitter' => '#',
        ],
      ],
      [
        'name' => 'Viwemi Louis Chavula',
        'position' => 'Programs Subcommittee Chairperson',
        'image' => 'img/team/viwemi-chavula.jpg',
        'bio' => 'Human rights advocate with over 20 years of experience in democratic governance and women\'s empowerment.',
        'social' => [
          'linkedin' => '#',
          'twitter' => '#',
        ],
      ],
      [
        'name' => 'Jimmy Tsonga',
        'position' => 'Finance Subcommittee Chairperson',
        'image' => 'img/team/jimmy-tsonga.jpg',
        'bio' => 'Chartered Accountant with expertise in grants and finance management.',
        'social' => [
          'linkedin' => '#',
          'twitter' => '#',
        ],
      ],
      [
        'name' => 'Baxton Nkhoma',
        'position' => 'Secretary to the Board',
        'image' => 'img/team/baxton-nkhoma.jpg',
        'bio' => 'Governance and human rights activist with a focus on policy advocacy and institutional development.',
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
        'name' => 'United Nations Development Programme (UNDP)',
        'logo' => 'images/partners/undp.png',
        'website' => 'https://undp.org',
      ],
      [
        'name' => 'European Union',
        'logo' => 'images/partners/eu.png',
        'website' => 'https://europa.eu',
      ],
      [
        'name' => 'USAID',
        'logo' => 'images/partners/usaid.png',
        'website' => 'https://usaid.gov',
      ],
      [
        'name' => 'Oxfam',
        'logo' => 'images/partners/oxfam.png',
        'website' => 'https://oxfam.org',
      ],
      [
        'name' => 'Royal Norwegian Embassy',
        'logo' => 'images/partners/norwegian-embassy.png',
        'website' => 'https://norway.no',
      ],
      [
        'name' => 'National Endowment for Democracy',
        'logo' => 'images/partners/ned.png',
        'website' => 'https://ned.org',
      ],
      [
        'name' => 'ActionAid Malawi',
        'logo' => 'images/partners/actionaid.png',
        'website' => 'https://actionaid.org',
      ],
      [
        'name' => 'NICE Trust',
        'logo' => 'images/partners/nice-trust.png',
        'website' => 'https://nicetrust.org',
      ],
    ];
  }
}
