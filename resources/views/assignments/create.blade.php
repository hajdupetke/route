<x-app-layout>
    <x-assignment-form :assignment="new \App\Models\Assignment" :isAdmin="Auth::user()->role === \App\Enums\UserRole::Admin" />
</x-app-layout>
