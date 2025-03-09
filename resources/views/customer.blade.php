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
                    <table class="w-full">
                        <caption class="mb-3">Your Orders</caption>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Date</th>
                            </tr>
                        @foreach ($orders as $order)
                            <tr class="text-gray-400 text-center">
                                <td>{{ $order->item }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->created_at }}</td>
                            </tr>
                        @endforeach

                    </table>
                    <a href="{{ route('order.create') }}"><x-primary-button class="mt-4">Add Order</x-primary-button></a>
                </div>
            </div>
        </div>
    </div>

   
</x-app-layout>