<x-app-layout>
    <div class="container mx-auto mt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <h1 class="text-2xl font-bold mb-4">{{ __('assignment.details')}}</h1>

            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">{{ __('assignment.start_address') }}:</label>
                <p class="mt-1 text-gray-600 dark:text-gray-300">{{ $assignment->start_address }}</p>
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">{{ __('assignment.delivery_address')}}:</label>
                <p class="mt-1 text-gray-600 dark:text-gray-300">{{ $assignment->delivery_address }}</p>
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">{{ __('assignment.recipient_name')}}:</label>
                <p class="mt-1 text-gray-600 dark:text-gray-300">{{ $assignment->recipient_name }}</p>
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">{{ __('assignment.recipient_phone_number')}}:</label>
                <p class="mt-1 text-gray-600 dark:text-gray-300">{{ $assignment->recipient_phone_number }}</p>
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">{{ __('assignment.status')}}:</label>
                <p class="mt-1 text-gray-600 dark:text-gray-300">{{ $assignment->status->label() }}</p>
            </div>

            <div class="mt-6 flex justify-end gap-2">
                <a href="{{ route('assignment.edit', $assignment) }}" class="btn btn-warning"> {{__('edit')}}</a>
                @if (Auth::user()->role == App\Enums\UserRole::Admin)
                    @include('assignments.partials.delete-assignment', ['assignment' => $assignment])
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
