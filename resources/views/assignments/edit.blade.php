<x-app-layout>
    <x-assignment-form :assignment="$assignment" :isAdmin="Auth::user()->role === \App\Enums\UserRole::Admin" />
</x-app-layout>
