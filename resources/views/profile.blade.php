<x-layouts.app>

    <div class="h-full  my-10 mx-16 bg-gray-200 shadow-white shadow-md rounded-md space-y-4 px-20 py-8">

        <div>

            <div class="text-center">
                <h1 class="font-bold text-4xl">Informação Gerais</h1>
            </div>

            <div class="flex w-full my-4 justify-end">
                <div class="flex items-center space-x-4">
                    <span class="ms-3 text-sm font-medium text-gray-900">Editar</span>
                    <label class="relative inline-flex items-center me-5 cursor-pointer">
                        <input type="checkbox" value="" class="sr-only peer" id="checkEdit">
                        <div
                            class="w-11 h-6 border-4 peer-checked:border-0 border-blue-300 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-blue-600">
                        </div>
                    </label>
                </div>
            </div>

            <form action="{{ route('UpdateProfile') }}" id="formUpdateProfile" method="POST"
                class="flex flex-col py-8 space-y-8">
                @csrf
                <div class="flex items-center flex-1 space-x-2">
                    <label class="font-semibold">Nome</label>
                    <input type="text" id="name" name="name"
                        class="h-10 flex-1 rounded-lg border-black border p-4 text-lg disabled:bg-gray-200"
                        value="{{ $user->name }}" disabled>
                </div>

                <div class="flex space-x-4">

                    <div class="flex items-center space-x-2 w-2/3">
                        <label class="font-semibold">Email</label>
                        <input type="text" id="email" name="email"
                            class="h-10 flex-1 rounded-lg border-black border  p-4 text-lg disabled:bg-gray-200"
                            value="{{ $user->email }}" disabled>
                    </div>

                    <div class="flex items-center space-x-2 w-1/3">
                        <label class="font-semibold">Telefone</label>
                        <input type="text" id="phone" name="phone"
                            class="h-10 flex-1 rounded-lg border-black border  p-4 text-lg disabled:bg-gray-200"
                            value="{{ $user->phone }}" disabled>
                    </div>

                </div>

            </form>

        </div>

        <div>

            <div class="text-center space-y-4">

                <h1 class="font-bold text-4xl">Endereços</h1>

                <div class="flex justify-end">

                    <div>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded "
                            onclick="ShowFormAdress()" id="btn-NewAdd">
                            Novo Endereço
                        </button>

                        <div class="flex items-center space-x-2">
                            <button class="hidden bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                onclick="hideFormAdress()" id="btn-cancel">
                                Cancelar
                            </button>
                            <button
                                class="hidden bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                                onclick="document.getElementById('formNewAdd').submit()" id="btn-save">
                                Salve
                            </button>
                        </div>

                    </div>

                </div>

                <form action="{{ route('registerAdress') }}" method="POST"
                    class="my-16 hidden flex flex-col bg-gray-300 border-2 border-black px-20 py-8" id="formNewAdd">
                    @csrf
                    <div class="flex space-x-2">
                        <input type="hidden" name="page" value="profile">
                        <div class="flex flex-col space-y-2 flex-1">
                            <label class="text-sm font-semibold">Endereço</label>
                            <input type="text" name="street" id="street" value="{{ old('street') }}"
                                class="border-2 border-black rounded-md h-10 p-4">
                        </div>

                    </div>

                    <div class="flex space-x-2">

                        <div class="flex flex-col space-y-2  w-2/5">
                            <label class="text-sm font-semibold">Bairro</label>
                            <input type="text" name="bairro" id="bairro" value="{{ old('bairro') }}"
                                class="border-2 border-black rounded-md h-10 p-4">
                        </div>

                        <div class="flex flex-col space-y-2  w-1/5">
                            <label class="text-sm font-semibold">Numero</label>
                            <input type="number" name="number" id="number" value="{{ old('number') }}"
                                class="border-2 border-black rounded-md h-10 p-4">
                        </div>

                        <div class="flex flex-col space-y-2  w-2/5">
                            <label class="text-sm font-semibold">Complemento</label>
                            <input type="text" name="comp" id="comp"
                                class="border-2 border-black rounded-md h-10 p-4">
                        </div>



                    </div>

                    <div class="flex text-red-500 text-sm justify-center items-center h-10">

                        @if ($errors->any())
                            <span>{{ $errors->first() }}</span>
                        @endif

                    </div>
                </form>

                <table class="w-full text-sm text-left text-gray-500 py-4  rounded-lg">

                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 text-center">

                        <tr>

                            <th scope="col" class="px-6 py-3 text-center">
                                <span>Rua</span>
                            </th>

                            <th scope="col" class="px-6 py-3">
                                Numero
                            </th>

                            <th scope="col" class="px-6 py-3">
                                Complemento
                            </th>

                            <th scope="col" class="px-6 py-3">
                                Bairro
                            </th>

                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($enderecos as $endereco)
                            <tr class="bg-white border-b hover:bg-gray-50 text-center">

                                <th scope="row" class="px-6 py-4">
                                    {{ $endereco->street }}
                                </th>

                                <td class="px-6 py-4">

                                    {{ $endereco->number }}

                                </td>

                                <td class="px-6 py-4">

                                    {{ $endereco->comp ? $endereco->comp : '-' }}

                                </td>

                                <td class="px-6 py-4">

                                    {{ $endereco->neighborhood }}

                                </td>

                                <td class="flex px-6 py-4 justify-end items-center">

                                    <form action="{{ route('deleteAdress') }}" method="POST"
                                        id="formDeleteAdd-{{ $endereco->id }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $endereco->id }}">
                                        <a href="#"
                                            class="bg-red-400 font-medium h-8 w-8 flex justify-center items-center mx-2 rounded-md"
                                            onclick="deleteAddress({{ $endereco->id }})">
                                            <x-icons.bin />
                                        </a>
                                    </form>

                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>

        </div>

    </div>

    </div>
    </div>

    <script>
        var checkEdit = document.getElementById('checkEdit');

        function ChangeEdit() {

            if (checkEdit.checked) {

                $disable = false;

                document.getElementById('name').disabled = $disable
                document.getElementById('email').disabled = $disable
                document.getElementById('phone').disabled = $disable

            } else {

                $disable = true;

                document.getElementById('formUpdateProfile').submit()
            }


        }

        checkEdit.addEventListener("change", ChangeEdit);

        const ShowFormAdress = function() {

            document.getElementById('btn-NewAdd').classList.add('hidden');
            document.getElementById('btn-NewAdd').classList.remove('flex');
            document.getElementById('btn-cancel').classList.add('flex');
            document.getElementById('btn-cancel').classList.remove('hidden');
            document.getElementById('btn-save').classList.add('flex');
            document.getElementById('btn-save').classList.remove('hidden');
            document.getElementById('formNewAdd').classList.remove('hidden');
        }

        const hideFormAdress = function() {

            document.getElementById('btn-cancel').classList.remove('flex');
            document.getElementById('btn-cancel').classList.add('hidden');
            document.getElementById('btn-save').classList.remove('flex');
            document.getElementById('btn-save').classList.add('hidden');
            document.getElementById('btn-NewAdd').classList.remove('hidden');
            document.getElementById('btn-NewAdd').classList.add('flex');
            document.getElementById('formNewAdd').classList.add('hidden');
        }

        const deleteAddress = function($id) {
            var check = confirm('Deseja excluir o endereço');

            if (check) {
                document.getElementById('formDeleteAdd-' + $id).submit();
            }
            
        }
    </script>

</x-layouts.app>
