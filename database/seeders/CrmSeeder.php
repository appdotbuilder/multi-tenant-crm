<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Deal;
use App\Models\Lead;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class CrmSeeder extends Seeder
{
    /**
     * Run the CRM database seeds.
     */
    public function run(): void
    {
        // Get existing users or create additional ones
        $existingUserCount = User::count();
        if ($existingUserCount < 4) {
            User::factory(4 - $existingUserCount)->create();
        }
        $allUsers = User::all();

        // Create companies first
        $this->command->info('Creating companies...');
        $companies = Company::factory(20)->create();
        
        // Create contacts, some with companies, some without
        $this->command->info('Creating contacts...');
        $contacts = collect();
        
        // Create contacts for companies
        $companies->each(function ($company) use (&$contacts) {
            $companyContacts = Contact::factory(random_int(1, 3))
                ->create(['company_id' => $company->id]);
            $contacts = $contacts->merge($companyContacts);
        });
        
        // Create independent contacts
        $independentContacts = Contact::factory(15)->create(['company_id' => null]);
        $contacts = $contacts->merge($independentContacts);

        // Create leads
        $this->command->info('Creating leads...');
        $leads = collect();
        for ($i = 0; $i < 25; $i++) {
            $lead = Lead::factory()->create([
                'assigned_to' => $allUsers->random()->id
            ]);
            $leads->push($lead);
        }

        // Create deals
        $this->command->info('Creating deals...');
        $deals = collect();
        for ($i = 0; $i < 20; $i++) {
            $deal = Deal::factory()->create([
                'company_id' => $companies->random()->id,
                'contact_id' => $contacts->random()->id,
                'assigned_to' => $allUsers->random()->id
            ]);
            $deals->push($deal);
        }
        
        // Create some closed won deals for revenue
        for ($i = 0; $i < 10; $i++) {
            Deal::factory()->closedWon()->create([
                'company_id' => $companies->random()->id,
                'contact_id' => $contacts->random()->id,
                'assigned_to' => $allUsers->random()->id
            ]);
        }

        // Create tasks for various entities
        $this->command->info('Creating tasks...');
        $taskables = $contacts->merge($companies)->merge($deals)->merge($leads);
        
        // Create regular tasks
        for ($i = 0; $i < 40; $i++) {
            $taskable = $taskables->random();
            Task::factory()->create([
                'assigned_to' => $allUsers->random()->id,
                'taskable_type' => get_class($taskable),
                'taskable_id' => $taskable->id
            ]);
        }

        // Create some overdue tasks  
        for ($i = 0; $i < 8; $i++) {
            $taskable = $taskables->random();
            Task::factory()->overdue()->create([
                'assigned_to' => $allUsers->random()->id,
                'taskable_type' => get_class($taskable),
                'taskable_id' => $taskable->id
            ]);
        }

        $this->command->info('CRM data seeded successfully!');
        $this->command->info("Created:");
        $this->command->info("- " . Company::count() . " companies");
        $this->command->info("- " . Contact::count() . " contacts");
        $this->command->info("- " . Deal::count() . " deals");
        $this->command->info("- " . Lead::count() . " leads");
        $this->command->info("- " . Task::count() . " tasks");
    }
}