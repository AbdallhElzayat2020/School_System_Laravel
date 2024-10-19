{{-- <div style="text-align: center">
    <button wire:click="increment">+</button>
    <h1>{{ $count }}</h1>
    <button wire:click="decrement">-</button>
</div> --}}
<div>
    <input wire:model.debounce.100ms="search" type="text" placeholder="ابحث عن المستخدمين..." />
    <p>كلمة البحث: {{ $search }}</p>
    @if ($search !== '')
        <ul>
            @if ($users->count() > 0)
                @foreach ($users as $user)
                    <li>{{ $user->name }}</li>
                @endforeach
            @else
                <li>لا يوجد مستخدمين مطابقين للبحث</li>
            @endif
        </ul>
    @else
        <p>ابدأ الكتابة للبحث عن المستخدمين</p>
    @endif
    <p>عدد النتائج: {{ $users->count() }}</p>
</div>
