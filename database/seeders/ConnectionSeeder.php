<?php

namespace Database\Seeders;

use App\Models\Connection;
use App\Models\User;
use Illuminate\Database\Seeder;

class ConnectionSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::take(2)->get();
        if ($users->count() < 2) return;

        Connection::updateOrCreate(
            ['sender_id' => $users[0]->id, 'receiver_id' => $users[1]->id],
            ['status' => 'pending']
        );
    }
}
