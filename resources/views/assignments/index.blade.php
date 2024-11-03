<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table w-full">
                        <thead>
                            <tr>
                              <th></th>
                              <th>{{__('Driver')}}</th>
                              <th>{{__('Delivery address')}}</th>
                              <th>{{__('Recipient name')}}</th>
                              <th>{{__('Delivery status')}}</th>
                              <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($assignments as $item)
                            <tr>
                                <td class="text-bold">{{$item->id}}</td>
                                <td>{{$item->driver->name}}</td>
                                <td>{{$item['delivery_address']}}</td>
                                <td>{{$item['recipient_name']}}</td>
                                <td> <x-status-badge :status="$item->status" /></td>
                                <td>
                                    <button class="btn btn-warning">{{__('edit')}}</button>
                                    @if (Auth::user()->role == App\Enums\UserRole::Admin)
                                        <button class="btn btn-error ml-2">{{__('delete')}}</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$assignments->links()}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
