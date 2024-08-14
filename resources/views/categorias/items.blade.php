{{-- resources/views/categorias/items.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ítems en la Categoría: ') }}{{ $categoria->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-500 text-white p-4 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul>
                        @foreach($items as $item)
                            <li class="mb-4">
                                <a href="{{ route('items.show', $item->id) }}"
                                    class="text-blue-600 hover:underline">{{ $item->nombre }}</a>
                            </li>
                        @endforeach
                        @if($items->isEmpty())
                            <li class="text-center">No hay ítems disponibles en esta categoría</li>
                        @endif
                    </ul>
                    <a href="{{ route('categorias.index') }}" class="btn btn-secondary mt-6">Volver a Categorías</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function () {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    alert.classList.add('opacity-0');
                    setTimeout(() => alert.remove(), 500);
                });
            }, 3000);
        });
    </script>
</x-app-layout>