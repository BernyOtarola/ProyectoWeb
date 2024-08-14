{{-- resources/views/items/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de canciones') }}
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
                                <span class="text-gray-600">- Categoría:
                                    {{ $item->categoria?->nombre ?? 'Sin categoría' }}</span>
                            </li>
                        @endforeach
                        @if($items->isEmpty())
                            <li class="text-center">No hay canciones disponibles</li>
                        @endif
                    </ul>
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