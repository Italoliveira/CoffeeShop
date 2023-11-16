<x-layouts.admin>

    <script>
        function ShowFormProducts() {
            document.getElementById('formNewUsers').classList.remove('hidden');
            document.getElementById('formNewUsers').classList.add('flex');
            document.getElementById('btn-NewProd').classList.add('hidden');
            document.getElementById('btn-cancel').classList.remove('hidden');
        }


        function hideFormProducts() {
            document.getElementById('formNewUsers').classList.add('hidden');
            document.getElementById('formNewUsers').classList.remove('flex');
            document.getElementById('btn-NewProd').classList.remove('hidden');
            document.getElementById('btn-cancel').classList.add('hidden');
        }
    </script>

    <div class="border-2 rounded-sm p-14">

        <div class="flex mb-8 justify-between">
            <form class="w-1/3">
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="search"
                        class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50"
                        placeholder="Pesquisa Nome e Email">
                </div>
            </form>

            <div>

                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-36"
                    onclick="ShowFormProducts()" id="btn-NewProd">
                    Novo Usuario
                </button>

                <button class="hidden bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-36"
                    onclick="hideFormProducts()" id="btn-cancel">
                    Cancelar
                </button>
            </div>

        </div>

        <form action="{{ route('produtos.store') }}" class="my-16 hidden flex-col bg-gray-300 border-2 border-black p-8"
            id="formNewUsers" method="POST" enctype="multipart/form-data">

        </form>

        <div>

            <table class="w-full text-sm text-left text-gray-500 ">

                <thead class="text-xs text-gray-700 uppercase bg-gray-50 text-center">

                    <tr>

                        <th scope="col" class="px-6 py-3 text-start">
                            Nome
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Telefone
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tipo
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>

                </thead>

                <tbody>

                    @foreach ($users as $user)
                        <tr class="bg-white border-b hover:bg-gray-50 text-center">

                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                <span class="flex justify-items-start">{{ $user->name }}</span>
                            </th>

                            <td class="px-6 py-4">
                                {{ $user->email }}
                            </td>

                            <td class="px-6 py-4">

                                {{ $user->phone }}

                            </td>

                            <td class="px-6 py-4">

                                {{ $user->tier }}

                            </td>

                            <td class="flex px-6 py-4 justify-end items-center">

                                <a href="#"
                                    class="bg-blue-400 font-medium h-8 w-8 flex justify-center items-center mx-2 rounded-md"
                                    onclick="openWindow('/admin/produtos/{{ $user->id }}')">
                                    <x-icons.eye />
                                </a>

                            </td>

                        </tr>
                        
                    @endforeach

                </tbody>

            </table>
        </div>

    </div>

</x-layouts.admin>
