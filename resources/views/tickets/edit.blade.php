<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Ticket #') . $ticket->id . ' - ' . $ticket->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                <form method="POST" action="{{ route('tickets.update', $ticket) }}">
                    @csrf
                    @method('PUT') {{-- Usamos PUT/PATCH para actualizar el ticket --}}
                    
                    {{-- Título --}}
                    <div class="mb-4">
                        <x-label for="title" value="Título del Ticket" />
                        {{-- Usamos old() para mantener el valor en caso de error, si no, usamos el valor del ticket --}}
                        <x-input id="title" type="text" name="title" :value="old('title', $ticket->title)" required autofocus />
                        <x-input-error for="title" class="mt-2" />
                    </div>

                    {{-- Categoría --}}
                    <div class="mb-4">
                        <x-label for="category_id" value="Categoría" />
                        <select id="category_id" name="category_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" required>
                            <option value="">Seleccione una categoría</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" 
                                    {{ old('category_id', $ticket->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error for="category_id" class="mt-2" />
                    </div>

                    {{-- Descripción --}}
                    <div class="mb-4">
                        <x-label for="description" value="Descripción del Problema" />
                        <textarea id="description" name="description" rows="5" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" required>{{ old('description', $ticket->description) }}</textarea>
                        <x-input-error for="description" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('tickets.show', $ticket) }}" class="text-gray-600 hover:text-gray-900 mr-4">
                            Cancelar
                        </a>
                        <x-button class="ml-4">
                            {{ __('Actualizar Ticket') }}
                        </x-button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</x-app-layout>