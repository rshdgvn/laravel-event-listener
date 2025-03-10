<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <x-guest-layout>
                    <form method="POST" action="{{ route('customer.store') }}">
                        @csrf
                        <div class="mt-4">
                            <x-input-label for="item" :value="__('Item')" />
                
                            <x-text-input id="item" class="block mt-4 w-full" type="text" name="item"/>
                
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="quantity" :value="__('Quantity')" />
                
                            <x-text-input id="quantity" class="block mt-4 w-full" type="number" name="quantity"/>
                
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4 mt-4">
                                {{ __('Add Order') }}
                            </x-primary-button>
                        </div>
                    </form>
                </x-guest-layout>
            </div>
        </div>
    </div>
</x-app-layout>