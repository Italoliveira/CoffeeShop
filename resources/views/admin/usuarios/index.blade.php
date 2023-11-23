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

        function AlterStatus($id) {
            document.getElementById('formAlterStatus-' + $id).submit();
        }

        function DeleteUser($id, $user) {

            if ( $id == $user) {

                alert('Não é possivel excluir a conta que está logada')

            } else {

                if (confirm('Deseja excluir o Usuario N° ' + $id + '?')) {
                    document.getElementById('formDelete-' + $id).submit();
                }

            }


        }
        
    </script>

    <div class="border-2 rounded-sm p-14">

        <div class="flex mb-8 justify-end">

            <div>

                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-36 {{ $errors->any() ? 'hidden' : 'flex' }} "
                    onclick="ShowFormProducts()" id="btn-NewProd">
                    Novo Usuario
                </button>

                <button
                    class="{{ $errors->any() ? '' : 'hidden' }}  bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-36"
                    onclick="hideFormProducts()" id="btn-cancel">
                    Cancelar
                </button>

            </div>

        </div>

        <form action="{{ route('usuarios.store') }}"
            class="my-16 {{ $errors->any() ? 'flex' : 'hidden' }} flex-col bg-gray-300 border-2 border-black p-8 "
            id="formNewUsers" method="POST" enctype="multipart/form-data">
            @csrf

            @if ($errors->any())
                <div class="text-red-500 text-center my-2 font-semibold">
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <div class="flex pb-4">

                <div class="flex flex-col mx-5 w-1/2">
                    <label for="" class="text-center font-bold">Nome</label>
                    <input type="text" name="name" id="name"
                        class="h-10 rounded-md border-2 border-black text-center p-4 disabled:bg-gray-200"
                        value="{{ old('name') }}">
                </div>

                <div class="flex flex-col mx-5  w-1/3">
                    <label for="" class="text-center font-bold">Senha</label>
                    <input type="password" name="password" id="password"
                        class="h-10 rounded-md border-2 border-black text-center p-4 disabled:bg-gray-200"
                        value="">
                </div>

                <div class="flex flex-col mx-5  w-1/6">
                    <label for="" class="text-center font-bold">Status</label>
                    <select name="status" id="status"
                        class="h-10 rounded-md border-2 border-black text-center font-semibold">
                        <option value="A" class="text-black">Ativo</option>
                        <option value="D" class="text-black" selected>Desativo</option>
                    </select>
                </div>

            </div>

            <div class="flex">

                <div class="flex flex-col mx-5 w-1/2">
                    <label for="" class="text-center font-bold">Email</label>
                    <input type="email" name="email" id="email"
                        class="h-10 rounded-md border-2 border-black text-center p-4 disabled:bg-gray-200"
                        value="{{ old('email') }}">
                </div>

                <div class="flex flex-col mx-5  w-1/3">
                    <label for="" class="text-center font-bold">Confirmar Senha</label>
                    <input type="password" name="confirm_password" id="confirm_password"
                        class="h-10 rounded-md border-2 border-black text-center p-4 disabled:bg-gray-200"
                        value="">
                </div>

                <div class="flex flex-col mx-5  w-1/6">
                    <input type="submit" value="Salvar"
                        class="h-10 rounded-md border-black border bg-green-600 mt-6 font-bold hover:bg-green-700">
                </div>

            </div>

        </form>

        <div>

            <table class="w-full text-sm text-left text-gray-500 ">

                <thead class="text-xs text-gray-700 uppercase bg-gray-50 text-center">

                    <tr>

                        <th scope="col" class="px-6 py-3 text-start">
                            <span class="sr-only">Id</span>
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Nome
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Status
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
                                <span class="flex text-center">{{ $user->id }}</span>
                            </th>

                            <td class="px-6 py-4">
                                {{ $user->name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $user->email }}
                            </td>

                            <td class="px-6 py-4">
                                <form action="{{ route('usuarios.update', ['usuario' => $user->id]) }}" method="post"
                                    id="formAlterStatus-{{ $user->id }}"
                                    onchange="AlterStatus({{ $user->id }})">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" id="status-{{ $user->id }}"
                                        class="rounded h-8 w-24 text-center">
                                        <option value="A" class="p-4"
                                            {{ $user->status == 'A' ? 'selected' : '' }}>Ativo</option>
                                        <option value="D" class="p-4"
                                            {{ $user->status == 'D' ? 'selected' : '' }}>Desativo</option>
                                    </select>
                                </form>
                            </td>

                            <td class="flex px-6 py-4 justify-end items-center">

                                <form action="{{ route('usuarios.destroy', ['usuario' => $user->id]) }}" method="post"
                                    id="formDelete-{{ $user->id }}">

                                    @csrf
                                    @method('DELETE')

                                </form>

                                <a href="#"
                                    class="bg-red-400 font-medium h-8 w-8 flex justify-center items-center mx-2 rounded-md"
                                    onclick="DeleteUser({{ $user->id }}, {{ Auth::user()->id }})">
                                    <x-icons.bin />
                                </a>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>

    </div>

</x-layouts.admin>
