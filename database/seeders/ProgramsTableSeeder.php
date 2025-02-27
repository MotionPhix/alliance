<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramsTableSeeder extends Seeder
{
  public function run(): void
  {
    $programs = [
      [
        'title' => 'Spotlight Initiative',
        'slug' => 'spotlight-initiative',
        'description' => 'Aimed at eliminating violence against women and girls (EVAWG), including sexual and gender-based violence (SGBV) and harmful practices (HP).',
        'icon' => 'scorecard',
        'objectives' => 'Strengthen institutions, work with Gender Technical Working Groups, Chiefs, and Area Development Committees.',
        'achievements' => 'Implemented in Nkhatabay, Mzimba, Ntchisi, Dowa, Machinga, and Nsanje districts.',
        'sort_order' => 1,
        'is_published' => true,
      ],
      [
        'title' => 'Civic Space',
        'slug' => 'civic-space',
        'description' => 'Builds the capacity of civil society and citizen groups to reclaim their critical roles in growing Malawi\'s democracy.',
        'icon' => 'youth',
        'objectives' => 'Strengthen District CSOs Networks and Citizen Forums.',
        'achievements' => 'Funded by the National Endowment for Democracy.',
        'sort_order' => 2,
        'is_published' => true,
      ],
      [
        'title' => '50-50 Campaign',
        'slug' => '50-50-campaign',
        'description' => 'Seeks to increase women\'s political representation in local government and Parliament.',
        'icon' => 'scorecard',
        'objectives' => 'Implemented in Salima and Nkhotakota districts.',
        'achievements' => 'Funded by the Royal Norwegian Embassy through ActionAid Malawi.',
        'sort_order' => 3,
        'is_published' => true,
      ],
      [
        'title' => 'Local Government Accountability Programme (LGAP)',
        'slug' => 'local-government-accountability-programme',
        'description' => 'Strengthens the functionality of local government structures, including ADCs and VDCs.',
        'icon' => 'scorecard',
        'objectives' => 'Improve accountability in Lilongwe.',
        'achievements' => 'Funded by USAID-DAI.',
        'sort_order' => 4,
        'is_published' => true,
      ],
      [
        'title' => 'State of the Union (SOTU) Campaign',
        'slug' => 'state-of-the-union-campaign',
        'description' => 'Tracks government compliance with AU Charters and generates citizen-led solutions on political, economic, and social issues.',
        'icon' => 'scorecard',
        'objectives' => 'Implemented through the Bwalo la Nzika Initiative.',
        'achievements' => 'Funded by Oxfam Novib and Oxfam GB.',
        'sort_order' => 5,
        'is_published' => true,
      ],
      [
        'title' => 'Generational Leadership Initiative',
        'slug' => 'generational-leadership-initiative',
        'description' => 'Provides governance and leadership training for young generational leaders.',
        'icon' => 'youth',
        'objectives' => 'Build capacity for young leaders.',
        'achievements' => 'Funded by the European Union through NICE Trust.',
        'sort_order' => 6,
        'is_published' => true,
      ],
    ];

    DB::table('programs')->insert($programs);
  }
}
