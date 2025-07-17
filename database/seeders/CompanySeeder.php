<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'name' => 'TechNova',
                'role' => 'Full Stack Developer',
                'description' => 'Join our team to work on cutting-edge SaaS products.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'DataWave',
                'role' => 'Data Analyst',
                'description' => 'Analyze big data to drive business insights.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'CreativeSoft',
                'role' => 'UI/UX Designer',
                'description' => 'Design intuitive user experiences for mobile and web platforms.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'InnovativeTech',
                'role' => 'Frontend Developer',
                'description' => 'Work on responsive web applications and dynamic user interfaces.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'EcoLogic',
                'role' => 'Environmental Engineer',
                'description' => 'Develop sustainable solutions to reduce environmental impact.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'CloudWorks',
                'role' => 'Cloud Architect',
                'description' => 'Design scalable and secure cloud infrastructures.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'NextGen Systems',
                'role' => 'Software Engineer',
                'description' => 'Join a team of engineers building next-generation software solutions.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'FinTech Solutions',
                'role' => 'Financial Analyst',
                'description' => 'Analyze financial data to provide strategic insights to businesses.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Global Innovations',
                'role' => 'Product Manager',
                'description' => 'Lead cross-functional teams to build innovative products.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SmartTech',
                'role' => 'DevOps Engineer',
                'description' => 'Work on automating the deployment and monitoring of infrastructure.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
