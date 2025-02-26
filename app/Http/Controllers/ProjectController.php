<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
  public function index()
  {
    $partners = [
      [
        'name' => 'United Nations Development Programme (UNDP)',
        'logo' => asset('images/partners/undp-logo.png'),
        'description' => 'Supporting the Spotlight Initiative to eliminate violence against women and girls.',
      ],
      [
        'name' => 'European Union',
        'logo' => asset('images/partners/eu-logo.png'),
        'description' => 'Funding governance and capacity-building initiatives across Malawi.',
      ],
      [
        'name' => 'USAID',
        'logo' => asset('images/partners/usaid-logo.png'),
        'description' => 'Strengthening local government structures for improved accountability.',
      ],
      // Add more partners as needed
    ];

    $projects = [
      [
        'name' => 'Spotlight Initiative',
        'description' => 'Eliminating violence against women and girls in Malawi.',
        'funded_by' => 'UNDP and European Union',
      ],
      [
        'name' => 'Civic Space',
        'description' => 'Building the capacity of civil society and citizen groups.',
        'funded_by' => 'National Endowment for Democracy',
      ],
      [
        'name' => '50-50 Campaign',
        'description' => 'Increasing women\'s political representation in local government and Parliament.',
        'funded_by' => 'Royal Norwegian Embassy',
      ],
      // Add more projects as needed
    ];

    return view('pages.project', compact('partners', 'projects'));
  }
}
