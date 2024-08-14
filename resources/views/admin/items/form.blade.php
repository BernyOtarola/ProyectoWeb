{{-- resources/views/admin/items/form.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $item ? 'Editar Canción' : 'Agregar Canción' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if($errors->any())
                <div class="bg-red-500 text-white p-4 rounded mb-6">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ $item ? route('admin.items.update', $item->id) : route('admin.items.store') }}"
                        method="POST">
                        @csrf
                        @if($item)
                            @method('PUT')
                        @endif
                        <div class="form-group mb-4">
                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" name="nombre" class="form-control mt-1 block w-full @error('nombre') border-red-500 @enderror"
                                value="{{ old('nombre', $item ? $item->nombre : '') }}" required>
                            @error('nombre')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="categoria_id" class="block text-sm font-medium text-gray-700">Categoría</label>
                            <select name="categoria_id" class="form-control mt-1 block w-full" required>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{ $item && $item->categoria_id == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary bg-blue-500 text-white rounded hover:bg-blue-600 transition">{{ $item ? 'Actualizar' : 'Agregar' }}</button>
                    </form>
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