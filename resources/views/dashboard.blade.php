<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Control') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Bienvenido al Panel de Control de Manager Music</h1>
                        <p class="mt-4 text-gray-600">Administra y revisa fácilmente tus canciones y categorías desde aquí.</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 flex justify-between">
                        <a href="{{ route('admin.items.index') }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition-colors duration-300">Administrar Canciones</a>
                        <a href="{{ route('admin.categorias.index') }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition-colors duration-300">Administrar Categorías</a>
                    </div>

                    <!-- Statistics -->
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="p-4 bg-gray-50 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold text-gray-700">Total de Canciones</h3>
                            <p class="text-3xl font-bold text-indigo-600">{{ $totalItems }}</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold text-gray-700">Total de Categorías</h3>
                            <p class="text-3xl font-bold text-indigo-600">{{ $totalCategorias }}</p>
                        </div>
                    </div>

                    <!-- Recent Items -->
                    <div class="mt-8">
                        <h3 class="text-xl font-semibold text-gray-800">Canciones Recientes</h3>
                        <ul class="mt-4 space-y-2">
                            @foreach($recentItems as $item)
                                <li class="p-4 bg-gray-50 rounded-lg shadow-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-700">{{ $item->nombre }}</span>
                                        <span class="text-gray-500">Categoría: {{ $item->categoria->nombre }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
