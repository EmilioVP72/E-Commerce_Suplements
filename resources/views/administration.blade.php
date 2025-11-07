<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Administración') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Bienvenido al panel de administración') }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Aquí podrás gestionar las diferentes entidades del sistema.') }}
                    </p>

                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <a href="{{ route('brands.index') }}" class="block p-4 bg-gray-100 dark:bg-gray-700 rounded-lg shadow hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-150 ease-in-out">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Marcas') }}</h4>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ __('Gestionar marcas de productos.') }}</p>
                        </a>
                        <a href="{{ route('products.index') }}" class="block p-4 bg-gray-100 dark:bg-gray-700 rounded-lg shadow hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-150 ease-in-out">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Productos') }}</h4>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ __('Gestionar productos y sus detalles.') }}</p>
                        </a>
                        <a href="{{ route('suppliers.index') }}" class="block p-4 bg-gray-100 dark:bg-gray-700 rounded-lg shadow hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-150 ease-in-out">
                            <h4 class="text-lg font-semibold text-xl text-gray-900 dark:text-gray-100">{{ __('Proveedores') }}</h4>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ __('Gestionar proveedores de productos.') }}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
