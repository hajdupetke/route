<button
class="btn btn-error"
x-data=""
x-on:click.prevent="$dispatch('open-modal', 'confirm-assignment-{{ $assignment->id }}-deletion')"
>{{ __('assignment.delete') }}</button>

<x-modal name='confirm-assignment-{{ $assignment->id }}-deletion' focusable>
    <form method="post" action="{{ route('assignment.destroy', $assignment) }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{__('assignment.delete-heading')}}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('assignment.are-you-sure') }}
        </p>


        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3">
                {{ __('assignment.delete') }}
            </x-danger-button>
        </div>
    </form>
</x-modal>
