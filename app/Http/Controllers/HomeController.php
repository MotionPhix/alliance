<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
  public function index(): View
  {
    return view('pages.home', [
      'slides' => $this->getSliderData(),
      'approaches' => $this->getApproachData(),
    ]);
  }

  private function getSliderData(): array
  {
    return [
      [
        'image' => 'images/slide2.jpg',
        'title' => 'Empowering Communities',
        'description' => 'Building stronger communities through citizen engagement and advocacy',
      ],
      [
        'image' => 'images/slide1.jpg',
        'title' => 'Promoting Governance',
        'description' => 'Fostering transparency and accountability in governance processes',
      ],
      [
        'image' => 'images/slide3.jpg',
        'title' => 'Citizen Participation',
        'description' => 'Facilitating active citizen participation in development initiatives',
      ],
    ];
  }

  private function getApproachData(): array
  {
    return [
      [
        'title' => 'Bwalo la Nzika Approach',
        'description' => 'A mobilization tool aimed at facilitating policy dialogues between citizens and decision makers/duty bearers.',
        'icon' => 'chat-bubble-left-right',
      ],
      [
        'title' => 'Advocacy & Campaign Approach',
        'description' => 'Influencing change on matters affecting the vulnerable and marginalized groups.',
        'icon' => 'megaphone',
      ],
      [
        'title' => 'Research Approach',
        'description' => 'Collection of data and information to inform advocacy interventions.',
        'icon' => 'chart-bar',
      ],
    ];
  }
}
