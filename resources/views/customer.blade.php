<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Customer Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="w-full border border-gray-500 border-collapse">
                        <caption class="mb-3">Your Orders</caption>
                        <thead>
                            <tr class="text-gray-400 bg-gray-700">
                                <th class="text-center p-3 border border-gray-500">Item</th>
                                <th class="text-center p-3 border border-gray-500">Quantity</th>
                                <th class="text-center p-3 border border-gray-500">Date</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr class="border border-gray-500">
                                    <td class="text-center p-3 border border-gray-500">{{ $order->item }}</td>
                                    <td class="text-center p-3 border border-gray-500">{{ $order->quantity }}</td>
                                    <td class="text-center p-3 border border-gray-500">{{ $order->created_at }}</td>
                                    <td>
                                        <a href="{{ route('customer.edit', compact('order')) }}" class="mb-2"><x-secondary-button>edit</x-secondary-button></a>
                                    </td>
                                    <td>
                                        <form action="{{ route('customer.destroy', compact('order')) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                            <x-danger-button>Delete</x-danger-button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>                    
                    <a href="{{ route('customer.create') }}"><x-primary-button class="mt-4">Add Order</x-primary-button></a>
                </div>
            </div>
        </div>
    </div>

   
</x-app-layout>