{{-- resources/views/admin/categorias/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administrar Categorías') }}
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
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('admin.categorias.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">Agregar Categoría</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 bg-gray-100 font-semibold text-left">Nombre</th>
                                    <th class="py-2 px-4 bg-gray-100 font-semibold text-left">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categorias as $categoria)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-2 px-4 border-b">{{ $categoria->nombre }}</td>
                                        <td class="py-2 px-4 border-b">
                                            <a href="{{ route('admin.categorias.edit', $categoria->id) }}" class="px-2 py-1 text-sm text-yellow-500 hover:text-yellow-600 transition">Editar</a>
                                            <form action="{{ route('admin.categorias.destroy', $categoria->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-2 py-1 text-sm text-red-500 hover:text-red-600 transition">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                @if($categorias->isEmpty())
                                    <tr>
                                        <td colspan="2" class="text-center py-4">No hay categorías disponibles</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    alert.classList.add('opacity-0');
                    setTimeout(() => alert.remove(), 500);
                });
            }, 3000);
        });
    </script>
</x-app-layout>
