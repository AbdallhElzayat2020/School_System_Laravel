<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Counter extends Component
{
      public $search = '';

      public function render()
      {
            $users = $this->search === '' ? collect() : User::where('name', 'like', '%' . $this->search . '%')->get();

            // إضافة تعليمات تصحيحية
            Log::info('Search term: ' . $this->search);
            Log::info('Users found: ' . $users->count());

            return view('livewire.counter', [
                  'users' => $users,
            ]);
      }
}
