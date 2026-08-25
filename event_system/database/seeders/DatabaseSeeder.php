<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Roles
        $adminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Admin']);
        $managerRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Manager']);
        $employeeRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Employee']);

        // Create Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@reliant.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
            ]
        );
        $admin->assignRole($adminRole);

        // Create Approver (Manager)
        $manager = User::firstOrCreate(
            ['email' => 'manager@reliant.com'],
            [
                'name' => 'Manager (Approver)',
                'password' => bcrypt('password'),
            ]
        );
        $manager->assignRole($managerRole);

        // Create Standard User (Employee)
        $employee = User::firstOrCreate(
            ['email' => 'employee@reliant.com'],
            [
                'name' => 'Regular Employee',
                'password' => bcrypt('password'),
            ]
        );
        $employee->assignRole($employeeRole);

        // Seed Multiple Diverse Events
        $sampleEvents = [
            [
                'name' => 'Annual Corporate Tech Summit 2026',
                'description' => 'Join industry leaders and innovators to discuss cloud technology, AI advancement, and enterprise digital strategy.',
                'start_date' => now()->addDays(5),
                'end_date' => now()->addDays(7),
                'location' => 'Grand Auditorium, HQ North Building',
            ],
            [
                'name' => 'Leadership & Executive Growth Retreat',
                'description' => 'An exclusive 3-day workshop focused on high-impact executive communication, strategic decision making, and team mentorship.',
                'start_date' => now()->addDays(12),
                'end_date' => now()->addDays(15),
                'location' => 'Pacific Bay Resort & Conference Center',
            ],
            [
                'name' => 'Global Cybersecurity Hackathon',
                'description' => 'Test your defensive skills and solve real-world vulnerability scenarios with developers from around the world.',
                'start_date' => now()->addDays(20),
                'end_date' => now()->addDays(21),
                'location' => 'Innovation Lab & Virtual Streams',
            ],
            [
                'name' => 'Product Strategy & UX Design Expo',
                'description' => 'Discover cutting-edge UI/UX trends, modern design systems, and rapid prototyping workflows for enterprise software.',
                'start_date' => now()->addDays(25),
                'end_date' => now()->addDays(26),
                'location' => 'Design Studio Hall B',
            ],
            [
                'name' => 'Data Science & Machine Learning Bootcamp',
                'description' => 'Hands-on training session covering python models, neural networks, and scalable data pipeline management.',
                'start_date' => now()->addDays(30),
                'end_date' => now()->addDays(32),
                'location' => 'Virtual Live Classrooms',
            ],
            [
                'name' => 'Enterprise Architecture & Cloud Optimization',
                'description' => 'Learn strategies for multi-cloud deployment, cost management, and microservice resilience at enterprise scale.',
                'start_date' => now()->addDays(35),
                'end_date' => now()->addDays(36),
                'location' => 'Tech Hub Conference Room 3',
            ],
            [
                'name' => 'Q3 Global Town Hall & Strategy Review',
                'description' => 'Company-wide updates from executive leadership, team recognition, and Q3 corporate roadmap alignment.',
                'start_date' => now()->addDays(40),
                'end_date' => now()->addDays(40),
                'location' => 'Main Amphitheater & Global Stream',
            ],
            [
                'name' => 'Agile Transformation & Scrum Mastery Workshop',
                'description' => 'Master sprint planning, velocity tracking, and cross-functional team collaboration for agile practitioners.',
                'start_date' => now()->addDays(45),
                'end_date' => now()->addDays(46),
                'location' => 'Agile Center of Excellence',
            ],
            [
                'name' => 'Sustainability & Green Tech Forum',
                'description' => 'Exploring carbon footprint reduction in data centers, eco-friendly logistics, and sustainable corporate governance.',
                'start_date' => now()->addDays(50),
                'end_date' => now()->addDays(51),
                'location' => 'Eco-Pavilion Hall 1',
            ],
            [
                'name' => 'Customer Success & Support Excellence Summit',
                'description' => 'Best practices for customer retention, automated support workflows, and building customer-centric organizations.',
                'start_date' => now()->addDays(55),
                'end_date' => now()->addDays(56),
                'location' => 'Customer Experience Center',
            ],
            [
                'name' => 'Financial Planning & Risk Management Seminar',
                'description' => 'Corporate finance overview covering compliance regulations, treasury management, and risk mitigation models.',
                'start_date' => now()->addDays(60),
                'end_date' => now()->addDays(61),
                'location' => 'Finance Executive Suite',
            ],
            [
                'name' => 'DevOps Automation & CI/CD Pipeline Summit',
                'description' => 'Automating infrastructure deployment with Kubernetes, Terraform, and GitHub Actions pipelines.',
                'start_date' => now()->addDays(65),
                'end_date' => now()->addDays(66),
                'location' => 'DevOps Training Hub',
            ]
        ];

        foreach ($sampleEvents as $data) {
            $e = \App\Models\Event::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'location' => $data['location'],
                'created_by' => $admin->id,
                'form_schema' => json_encode([
                    ['name' => 'department', 'label' => 'Department', 'type' => 'select', 'required' => true, 'options' => ['Engineering', 'HR', 'Marketing', 'Sales', 'Finance', 'Design']],
                    ['name' => 'dietary', 'label' => 'Dietary Requirements', 'type' => 'text', 'required' => false]
                ])
            ]);

            $e->quotas()->create(['role_name' => 'Employee', 'quota_limit' => 50]);
            $e->quotas()->create(['role_name' => 'Manager', 'quota_limit' => 15]);
            $e->approvalBands()->create(['role_name' => 'Manager', 'level_sequence' => 1]);
        }

        // Seed Multiple Registrations with Varied Statuses
        $events = \App\Models\Event::take(5)->get();

        // 1. Pending Registration
        \App\Models\Registration::create([
            'event_id' => $events[0]->id,
            'user_id' => $employee->id,
            'status' => 'pending',
            'form_data' => json_encode(['department' => 'Engineering', 'dietary' => 'Vegetarian']),
            'current_approval_level' => 1
        ]);

        // 2. Another Pending Registration
        \App\Models\Registration::create([
            'event_id' => $events[1]->id,
            'user_id' => $employee->id,
            'status' => 'pending',
            'form_data' => json_encode(['department' => 'Marketing', 'dietary' => 'None']),
            'current_approval_level' => 1
        ]);

        // 3. Approved Registration
        $approvedReg = \App\Models\Registration::create([
            'event_id' => $events[2]->id,
            'user_id' => $employee->id,
            'status' => 'approved',
            'form_data' => json_encode(['department' => 'Sales', 'dietary' => 'Gluten Free']),
            'current_approval_level' => 1
        ]);

        $approvedReg->approvals()->create([
            'approver_id' => $admin->id,
            'status' => 'approved',
            'comments' => 'Approved - Quota verified.'
        ]);

        // 4. Rejected Registration
        $rejectedReg = \App\Models\Registration::create([
            'event_id' => $events[3]->id,
            'user_id' => $employee->id,
            'status' => 'rejected',
            'form_data' => json_encode(['department' => 'Design', 'dietary' => 'None']),
            'current_approval_level' => 1
        ]);

        $rejectedReg->approvals()->create([
            'approver_id' => $manager->id,
            'status' => 'rejected',
            'comments' => 'Department allocation limit reached for this session.'
        ]);

        // 5. Waitlisted Registration
        \App\Models\Registration::create([
            'event_id' => $events[4]->id,
            'user_id' => $employee->id,
            'status' => 'waitlisted',
            'form_data' => json_encode(['department' => 'HR', 'dietary' => 'Vegan']),
            'current_approval_level' => 1
        ]);
    }
}
