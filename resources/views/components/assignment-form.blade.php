<form method="post" action="{{ $assignment->exists ? route('assignment.update', $assignment) : route('assignment.store') }}" class="p-6 form-control">
    @csrf
    @if ($assignment->exists)
        @method('PUT')
    @endif

    <!-- Start Address Field -->
    <div class="mb-4">
        <label for="start_address" class="label">{{ __('assignment.start_address') }}</label>
        <input
            type="text"
            name="start_address"
            id="start_address"
            value="{{ old('start_address', $assignment->start_address) }}"
            class="mt-1 block w-full input input-bordered"
            @if(!$isAdmin) disabled @endif
        />
        @error('start_address')
        <div role="alert" class="alert alert-error mt-2">
            <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6 shrink-0 stroke-current"
            fill="none"
            viewBox="0 0 24 24">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{$message}}</span>
        </div>
        @enderror
    </div>

    <!-- Delivery Address Field -->
    <div class="mb-4">
        <label for="delivery_address" class="label">{{ __('assignment.delivery_address') }}</label>
        <input
            type="text"
            name="delivery_address"
            id="delivery_address"
            value="{{ old('delivery_address', $assignment->delivery_address) }}"
            class="mt-1 block w-full input input-bordered"
            @if(!$isAdmin) disabled @endif
        />
        @error('delivery_address')
        <div role="alert" class="alert alert-error mt-2">
            <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6 shrink-0 stroke-current"
            fill="none"
            viewBox="0 0 24 24">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{$message}}</span>
        </div>
        @enderror
    </div>

    <!-- Recipient Name Field -->
    <div class="mb-4">
        <label for="recipient_name" class="label">{{ __('assignment.recipient_name') }}</label>
        <input
            type="text"
            name="recipient_name"
            id="recipient_name"
            value="{{ old('recipient_name', $assignment->recipient_name) }}"
            class="mt-1 block w-full input input-bordered"
            @if(!$isAdmin) disabled @endif
        />
        @error('recipient_name')
        <div role="alert" class="alert alert-error mt-2">
            <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6 shrink-0 stroke-current"
            fill="none"
            viewBox="0 0 24 24">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{$message}}</span>
        </div>
        @enderror
    </div>

    <!-- Recipient Phone Number Field -->
    <div class="mb-4">
        <label for="recipient_phone_number" class="label">{{ __('assignment.recipient_phone_number') }}</label>
        <input
            type="text"
            name="recipient_phone_number"
            id="recipient_phone_number"
            value="{{ old('recipient_phone_number', $assignment->recipient_phone_number) }}"
            class="mt-1 block w-full input input-bordered"
            @if(!$isAdmin) disabled @endif
        />
        @error('recipient_phone_number')
        <div role="alert" class="alert alert-error mt-2">
            <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6 shrink-0 stroke-current"
            fill="none"
            viewBox="0 0 24 24">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{$message}}</span>
        </div>
        @enderror
    </div>

    <div class="mb-4">
        <label for="status" class="label">{{ __('assignment.status') }}</label>
        <select class="mt-1 block w-full select select-bordered" id="status" name="status">
            @foreach (\App\Enums\AssignmentStatus::cases() as $status)
                <option @if($assignment->status == $status) selected @endif value="{{$status}}">{{$status->label()}}</option>
            @endforeach
        </select>
        @error('status')
        <div role="alert" class="alert alert-error mt-2">
            <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6 shrink-0 stroke-current"
            fill="none"
            viewBox="0 0 24 24">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{$message}}</span>
        </div>
        @enderror

    </div>

    <div class="mb-4">
        <label for="driver" class="label">{{ __('assignment.driver') }}</label>
        <select class="mt-1 block w-full select select-bordered" id="driver" name="driver" @if(!$isAdmin) disabled @endif>
            @foreach (\App\Models\User::where('role', \App\Enums\UserRole::Driver)->get() as $user)
                <option @if($assignment->driver == $user) selected @endif value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
        @error('driver')
        <div role="alert" class="alert alert-error mt-2">
            <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6 shrink-0 stroke-current"
            fill="none"
            viewBox="0 0 24 24">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{$message}}</span>
        </div>
        @enderror

    </div>

    <!-- Submit Button -->
    <div class="mt-6">
        <button type="submit" class="btn btn-primary">
            {{ $assignment->exists ? __('assignment.update') : __('assignment.create') }}
        </button>
    </div>
</form>
