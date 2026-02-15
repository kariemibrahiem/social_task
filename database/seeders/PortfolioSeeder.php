<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        Portfolio::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        Portfolio::create([
            'title' => 'Edarat',
            'description' => 'edarat is full realstate management system for pixel mart saudi company full designed and build with laravel .',
            'url' => 'https://demo.edarat365.com/admin/login',
            'image' => 'web/img/projects/edarat.png',
            'category' => 'consulting',
            'sort_order' => 1,
        ]);

        Portfolio::create([
            'title' => 'Travel',
            'description' => 'travel  is a travel agency website that provides a wide range of travel services, including  hotel reservations, and tour packages, offering users a convenient platform to all services and book their travel arrangements.',
            'url' => 'https://trvlgate.com/en',
            'image' => 'web/img/projects/travel.png',
            'category' => 'finance',
            'sort_order' => 2,
        ]);

        Portfolio::create([
            'title' => 'Mawhebtac',
            'description' => 'Mawhebtac is a comprehensive talent acquisition and management platform designed to streamline the recruitment process for businesses. It offers a range of features including talent posting, candidate sourcing, applicant tracking, and analytics to help companies efficiently find and manage top talent.',
            'url' => 'https://mawhebtac.com',
            'image' => 'web/img/projects/mawhebtac.png',
            'category' => 'marketing',
            'sort_order' => 3,
        ]);

        Portfolio::create([
            'title' => 'Elmazon',
            'description' => 'Elmazon is full LMS system connect teacher with all student and manege the learning process.',
            'url' => 'https://elmazon.com',
            'image' => 'web/img/projects/elmazon.png',
            'category' => 'consulting',
            'sort_order' => 4,
        ]);

        Portfolio::create([
            'title' => 'Clinizone CRM',
            'description' => 'Clinizone CRM is a customer relationship management system designed specifically for healthcare providers, offering features such as patient management, appointment scheduling, and communication tools to enhance patient care and streamline administrative tasks.',
            'url' => 'https://crm.clinizone.net/',
            'image' => 'web/img/projects/clinizone.png',
            'category' => 'consulting',
            'sort_order' => 5,
        ]);

        Portfolio::create([
            'title' => 'Atabe',
            'description' => 'Atabe is a platform to provide direct relation between lawyers and customers and handle all court cases steps and processes.',
            'url' => 'https://atabe.com',
            'image' => 'web/img/projects/atabe.png',
            'category' => 'finance',
            'sort_order' => 6,
        ]);

        Portfolio::create([
            'title' => 'Hub Spare Part',
            'description' => 'Hub Spare Part is an e-commerce platform that specializes in providing a wide range of spare parts for various industries, offering customers a convenient and reliable online shopping experience for their spare part needs.',
            'url' => 'https://hubsparepart.com',
            'image' => 'web/img/projects/hubsparepart.png',
            'category' => 'marketing',
            'sort_order' => 7,
        ]);

        Portfolio::create([
            'title' => 'Zakat',
            'description' => 'Zakat is a comprehensive zakat management system designed to facilitate the calculation, collection, and distribution of zakat funds in accordance with Islamic principles, providing users with a convenient platform to fulfill their zakat obligations and contribute to charitable causes.',
            'url' => 'https://zakat.topbusiness.io/admin',
            'image' => 'web/img/projects/zakar.png',
            'category' => 'marketing',
            'sort_order' => 8,
        ]);

        Portfolio::create([
            'title' => 'ESOIEgypt',
            'description' => 'ESOIEgypt is a comprehensive educational platform  build on Rocket LMS system that provides a wide range of online courses, resources, and tools to support students and educators in Egypt, fostering accessible and quality education for all.',
            'url' => 'https://esoiegypt.cloud/',
            'image' => 'web/img/projects/esoi.png',
            'category' => 'finance',
            'sort_order' => 9,
        ]);
    }
}
