<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeadershipMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            [
                'name' => 'BOARD MEMBER 1',
                'title' => 'CHAIRMAN OF THE BOARD',
                'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...',
                'image_path' => '/Portrait_Placeholder.png',
                'type' => 'board',
                'order_index' => 1
            ],
            [
                'name' => 'BOARD MEMBER 2',
                'title' => 'PRESIDENT, CHIEF EXECUTIVE OFFICER AND DIRECTOR',
                'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...',
                'image_path' => '/Portrait_Placeholder.png',
                'type' => 'board',
                'order_index' => 2
            ],
            [
                'name' => 'BOARD MEMBER 3',
                'title' => 'DIRECTOR',
                'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...',
                'image_path' => '/Portrait_Placeholder.png',
                'type' => 'board',
                'order_index' => 3
            ],
            [
                'name' => 'MANAGEMENT MEMBER 1',
                'title' => 'GENERAL MANAGER',
                'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...',
                'image_path' => '/Portrait_Placeholder.png',
                'type' => 'management',
                'order_index' => 1
            ],
            [
                'name' => 'MANAGEMENT MEMBER 2',
                'title' => 'HEAD OF OPERATIONS',
                'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...',
                'image_path' => '/Portrait_Placeholder.png',
                'type' => 'management',
                'order_index' => 2
            ],
        ];

        foreach ($members as $member) {
            \App\Models\LeadershipMember::create($member);
        }
    }
}
