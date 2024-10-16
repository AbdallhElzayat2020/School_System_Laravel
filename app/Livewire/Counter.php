<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Counter extends Component
{
      public $search = '';

      public function render()
      {
            // return view('livewire.counter');

            return view('livewire.counter', [

                  'users' => User::where('name', $this->search)->get(),
              ]);
      }
}
