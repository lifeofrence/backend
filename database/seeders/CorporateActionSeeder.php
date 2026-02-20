<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CorporateActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actions = [
            [
                'date' => '2025-05-15',
                'category' => 'Dividend',
                'title' => 'Declaration of Final Dividend for the Year Ended 31st December 2024',
                'summary' => 'The Board of Directors has recommended the payment of a final dividend of ₦1.50 per share...',
            ],
            [
                'date' => '2025-04-02',
                'category' => 'General Meeting',
                'title' => 'Notice of 35th Annual General Meeting',
                'summary' => 'Notice is hereby given that the 35th Annual General Meeting of Abuja International Hotels will hold...',
            ],
            [
                'date' => '2025-02-28',
                'category' => 'Board Meeting',
                'title' => 'Notice of Board Meeting to Approve Audited Accounts',
                'summary' => 'A meeting of the Board of Directors has been scheduled to consider and approve the audited financial statements...',
            ],
            [
                'date' => '2025-01-10',
                'category' => 'Appointment',
                'title' => 'Appointment of New Non-Executive Director',
                'summary' => 'Abuja International Hotels is pleased to announce the appointment of Mrs. Ngozi Okonjo (fictional) to the Board...',
            ],
        ];

        foreach ($actions as $action) {
            \App\Models\CorporateAction::create($action);
        }
    }
}
