<?php

namespace Database\Seeders;

use App\Models\Conversation;
use App\Models\ConversationParticipant;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $conv = Conversation::create(['is_group' => false]);
        ConversationParticipant::create(['conversation_id' => $conv->id, 'user_id' => 1]);
        ConversationParticipant::create(['conversation_id' => $conv->id, 'user_id' => 2]);
    }
}
