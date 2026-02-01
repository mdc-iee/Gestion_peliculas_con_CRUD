<x-layouts.layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black text-white p-8">
        <div class="flex items-center justify-between mb-6">
            <a href="{{ route('films.create') }}">
                <button class="btn btn-primary shadow-lg">
                    {{__("Agregar película")}}
                </button>
            </a>
        </div>
        <!-- Tabla -->
        <div class="overflow-x-auto bg-gray-900/80 backdrop-blur-md rounded-2xl shadow-2xl border border-yellow-500/20 p-6">
            <table class="table w-full text-sm">
                <thead class="text-yellow-300">
                <tr>
                    @foreach($fields as $field)
                        <th class="uppercase tracking-wide">
                            {{ ucfirst($field) }}
                        </th>
                    @endforeach
                    <th class="text-center">Editar</th>
                    <th class="text-center">Borrar</th>
                </tr>
                </thead>
                <tbody>
                @foreach($films as $film)
                    <tr class="hover:bg-gray-800 transition">
                        <td>{{ $film->name }}</td>
                        <td>{{ $film->genre }}</td>
                        <td>{{ $film->duration }} min</td>
                        <td>{{ $film->director }}</td>
                        <td class="max-w-xs truncate" title="{{ $film->description }}">
                            {{ $film->description }}
                        </td>
                        <!-- Editar -->
                        <td class="text-center">
                            <a href="{{ route('films.edit', ['film' => $film->id, 'page' => request('page')]) }}">
                                <button class="btn btn-sm btn-outline btn-info">
                                    {{__("Editar")}}
                                </button>
                            </a>
                        </td>
                        <!-- Borrar -->
                        <td class="text-center">
                            <form action="{{ route('films.destroy', ['film' => $film->id, 'page' => request('page')]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="confirmar(event)" type="submit" class="btn btn-sm btn-outline btn-error">
                                    {{__("Borrar")}}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div class="alert alert-success mt-6 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        <div class="mt-6 flex justify-center">
            <div class="bg-blue-200 px-4 py-2 rounded-xl shadow-md">
                {{ $films->links() }}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmar(e) {
            e.preventDefault();
            const form = e.currentTarget.closest("form");

            Swal.fire({
                title: "Confirmar borrado",
                text: "¿Seguro que quieres borrar esta película?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#e11d48",
                cancelButtonColor: "#6b7280",
                confirmButtonText: "Sí, borrar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
</x-layouts.layout>
