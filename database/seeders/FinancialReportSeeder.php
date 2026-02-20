<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FinancialReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reports = [
            [
                'period' => '2024',
                'type' => 'annual',
                'title' => 'Annual Report & Accounts',
                'subtitle' => 'Year Ended 31st December 2024',
                'file_path' => '/sample.pdf',
                'is_active' => true,
            ],
            [
                'period' => '2023',
                'type' => 'annual',
                'title' => 'Annual Report & Accounts',
                'subtitle' => 'Year Ended 31st December 2023',
                'file_path' => '/sample.pdf',
                'is_active' => true,
            ],
            [
                'period' => '2022',
                'type' => 'annual',
                'title' => 'Annual Report & Accounts',
                'subtitle' => 'Year Ended 31st December 2022',
                'file_path' => '/sample.pdf',
                'is_active' => true,
            ],
            [
                'period' => 'Q4 2024',
                'type' => 'quarterly',
                'title' => 'Unaudited Financial Results',
                'file_path' => '/sample.pdf',
                'is_active' => true,
            ],
            [
                'period' => 'Q3 2024',
                'type' => 'quarterly',
                'title' => 'Unaudited Financial Results',
                'file_path' => '/sample.pdf',
                'is_active' => true,
            ],
            [
                'period' => 'Q2 2024',
                'type' => 'quarterly',
                'title' => 'Unaudited Financial Results',
                'file_path' => '/sample.pdf',
                'is_active' => true,
            ],
            [
                'period' => 'Q1 2024',
                'type' => 'quarterly',
                'title' => 'Unaudited Financial Results',
                'file_path' => '/sample.pdf',
                'is_active' => true,
            ],
        ];

        foreach ($reports as $report) {
            \App\Models\FinancialReport::create($report);
        }
    }
}
