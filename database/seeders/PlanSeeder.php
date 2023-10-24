<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;
class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Monthly Plan', 
                'slug' => 'monthly-plan', 
                'stripe_plan' => 'price_1O4eA7SJxnmlyXhMRBCeoUkC', 
                'price' => 200, 
                'description' => 'Monthly Plan'
            ],
            [
                'name' => 'Yearly Plan', 
                'slug' => 'yearly-plan', 
                'stripe_plan' => 'price_1O4eBJSJxnmlyXhMrHcT4lXi', 
                'price' => 2000, 
                'description' => 'Yearly Plan'
            ]
        ];
  
        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
