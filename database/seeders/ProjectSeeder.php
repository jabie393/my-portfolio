<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing projects to keep seeder idempotent in dev
        DB::table('projects')->truncate();

        Project::create([
            'title' => 'Website Redesign',
            'subtitle' => 'Corporate site refresh',
            'description' => 'Redesign corporate website with responsive layout and CMS integration.',
            'tools' => 'Laravel, Livewire, Tailwind',
            'images' => ['images/work1.jpg'],
            'link' => 'https://example.com/website-redesign',
        ]);

        Project::create([
            'title' => 'Mobile App',
            'subtitle' => 'iOS & Android app',
            'description' => 'Build cross-platform mobile app for customers to manage accounts.',
            'tools' => 'Flutter, Firebase',
            'images' => ['images/work3.jpg'],
            'link' => 'https://example.com/mobile-app',
        ]);

        Project::create([
            'title' => 'Marketing Campaign',
            'subtitle' => 'Q4 launch',
            'description' => 'Run multi-channel marketing campaign for product launch.',
            'tools' => 'Google Ads, Facebook Ads',
            'images' => [ 'images/work2.jpg'],
            'link' => 'https://example.com/marketing-campaign',
        ]);

        // Additional sample projects so portfolio has at least 6 items
        Project::create([
            'title' => 'E-commerce Platform',
            'subtitle' => 'Online store',
            'description' => 'Developed full-featured e-commerce platform with payment gateway integration.',
            'tools' => 'Laravel, MySQL, Stripe',
            'images' => ['images/work4.jpg'],
            'link' => 'https://example.com/ecommerce',
        ]);

        Project::create([
            'title' => 'Admin Dashboard',
            'subtitle' => 'Internal tools',
            'description' => 'Admin dashboard for data visualization and user management.',
            'tools' => 'Vue, Chart.js, Laravel',
            'images' => ['images/work5.jpg'],
            'link' => 'https://example.com/admin-dashboard',
        ]);

        Project::create([
            'title' => 'Landing Page',
            'subtitle' => 'Product lead capture',
            'description' => 'High-converting landing page with A/B testing setup.',
            'tools' => 'HTML, CSS, Google Optimize',
            'images' => ['images/work6.jpg'],
            'link' => 'https://example.com/landing-page',
        ]);

        Project::create([
            'title' => 'GTA 7',
            'subtitle' => 'Games',
            'description' => 'Admin dashboard for data visualization and user management.',
            'tools' => 'Vue, Chart.js, Laravel',
            'images' => ['images/work1.jpg'],
            'link' => 'https://example.com/admin-dashboard',
        ]);

        Project::create([
            'title' => 'Library',
            'subtitle' => 'Books & Articles',
            'description' => 'High-converting landing page with A/B testing setup.',
            'tools' => 'HTML, CSS, Google Optimize',
            'images' => ['images/work2.jpg'],
            'link' => 'https://example.com/landing-page',
        ]);

        Project::create([
            'title' => 'PT Indonusa',
            'subtitle' => 'Warehouse System',
            'description' => 'Redesign corporate website with responsive layout and CMS integration.',
            'tools' => 'Laravel, Livewire, Tailwind',
            'images' => ['images/work3.jpg'],
            'link' => 'https://example.com/website-redesign',
        ]);

        Project::create([
            'title' => 'Country Api',
            'subtitle' => 'Rest API',
            'description' => 'Build cross-platform mobile app for customers to manage accounts.',
            'tools' => 'Flutter, Firebase',
            'images' => ['images/work4.jpg'],
            'link' => 'https://example.com/mobile-app',
        ]);
    }
}
