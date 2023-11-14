<x-layouts.admin>

    <script>

        function deleteProducts(id) {
            var confirmacao = window.confirm("Você tem certeza que deseja executar esta operação?");

            if (confirmacao) {
                document.getElementById('delete-produto-' + id).submit();
            }
        }

        function ShowFormProducts() {
            document.getElementById('FormNewProducts').classList.remove('hidden');
            document.getElementById('FormNewProducts').classList.add('flex');
            document.getElementById('btn-NewProd').classList.add('hidden');
            document.getElementById('btn-cancel').classList.remove('hidden');
        }


        function hideFormProducts() {
            document.getElementById('FormNewProducts').classList.add('hidden');
            document.getElementById('FormNewProducts').classList.remove('flex');
            document.getElementById('btn-NewProd').classList.remove('hidden');
            document.getElementById('btn-cancel').classList.add('hidden');
        }

        function openWindow(url) {
            // Especificando largura e altura da janela
            var largura = 1000;
            var altura = 400;

            // Calculando o centro da tela
            var esquerda = (largura - window.innerWidth) / 2;
            var topo = (altura - window.innerHeight - altura) / 2;

            // Abrindo a janela com dimensões fixas
            window.open(url, 'janelaImutavel', 'width=' + largura + ',height=' + altura + ',left=' + esquerda + ',top=' +
                topo + 'scrollbars=no,resizable=no');
        }

        var loadFile = function(event) {

            var input = event.target;
            var file = input.files[0];
            var type = file.type;

            var output = document.getElementById('preview_img');


            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>

    <div class="border-2 rounded-sm p-14">

        <div class="flex justify-between">

            <div>
                <span><b>{{ $produtos->count() }}</b> Produtos listados</span>
            </div>

            <div>

                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded "
                    onclick="ShowFormProducts()" id="btn-NewProd">
                    Novo Produto
                </button>

                <button class="hidden bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                    onclick="hideFormProducts()" id="btn-cancel">
                    Cancelar
                </button>

                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                    onclick="openWindow('/admin/categorias')">
                    Categorias
                </button>

            </div>

        </div>



        <form action="{{ route('produtos.store') }}"
            class="my-16 hidden flex-col bg-gray-300 border-2 border-black p-8" id="FormNewProducts" method="POST"
            enctype="multipart/form-data">
            @csrf

            <div class="flex flex-1">
                <div class="flex flex-col mx-5  flex-1">
                    <label for="" class="text-center font-bold">Nome</label>
                    <input type="text" name="name" id="name"
                        class="h-10 rounded-md border-2 border-black text-center p-4">
                </div>

                <div class="flex flex-col mx-5 flex-1">
                    <label for="" class="text-center font-bold">Quantidade</label>
                    <input type="text" name="quantity" id="quantity"
                        class="h-10 rounded-md border-2 border-black text-center p-4">
                </div>

                <div class="flex flex-col mx-5 flex-1">
                    <label for="" class="text-center font-bold">Preço</label>
                    <input type="text" name="value" id="value"
                        class="h-10 rounded-md border-2 border-black text-center p-4">

                </div>

                <div class="flex flex-col mx-5 flex-1">

                    <label for="" class="text-center font-bold text-black">Categoria</label>
                    <select name="category" id="category" class="h-10 rounded-md border-2 border-black text-center">
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">
                                {{ $categoria->name }}</option>
                        @endforeach
                    </select>

                </div>

            </div>

            <div class="flex pt-4">

                <div class="flex flex-col mx-5 flex-1 w-1/2">
                    <label for="" class="text-center font-bold">Descrição</label>
                    <textarea name="describe" id="describe" rows="6" cols="10"
                        class=" rounded-md border-2 border-black text-left p-2">
                    </textarea>
                </div>

                <div class="w-1/2 flex flex-col justify-between">

                    <div class="flex items-center space-x-6 justify-center flex-1">
                        <div class="shrink-0">
                            <img id='preview_img' class="h-16 w-16 object-cover rounded-md"
                                src="{{ asset('Images/image-upload.jpg') }}" alt="Current profile photo" />
                        </div>
                        <label>
                            <input type="file" name="file-image" onchange="loadFile(event)"
                                class="block w-full text-sm text-slate-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-violet-50 file:text-blue-700
                            hover:file:bg-violet-100
                          " />
                        </label>
                    </div>

                    <div class="text-end">
                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                            onclick="document.getElementById('FormNewProducts').submit()">
                            Salvar
                        </button>

                    </div>
                </div>



            </div>

        </form>



        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-10">

            <table class="w-full text-sm text-left text-gray-500 ">

                <thead class="text-xs text-gray-700 uppercase bg-gray-50 text-center">

                    <tr>

                        <th scope="col" class="px-6 py-3 text-start">
                            Produto
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nome
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Categoria
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Valor
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>

                </thead>

                <tbody>

                    @foreach ($produtos as $produto)
                        <tr class="bg-white border-b hover:bg-gray-50 text-center">

                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                <img src="{{ asset('storage/' . $produto->image) }}" class="h-16 w-16 rounded-xl">
                            </th>

                            <td class="px-6 py-4">
                                {{ $produto->name }}
                            </td>

                            <td class="px-6 py-4">

                                {{ $produto->category }}

                            </td>

                            <td class="px-6 py-4">

                                {{ $produto->status == 'A' ? 'Ativo' : 'Desativado' }}

                            </td>

                            <td class="px-6 py-4">

                                R$ {{ $produto->price }}

                            </td>

                            <td class="flex px-6 py-4 justify-end items-center">

                                <a href="#"
                                    class="bg-blue-400 font-medium h-8 w-8 flex justify-center items-center mx-2 rounded-md"
                                    onclick="openWindow('/admin/produtos/{{ $produto->id }}')">
                                    <x-icons.eye />
                                </a>

                                <form action="{{ route('produtos.destroy', ['produto' => $produto->id]) }}"
                                    method="POST" id="delete-produto-{{ $produto->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#"
                                        class="bg-red-400 font-medium h-8 w-8 flex justify-center items-center rounded-md"
                                        onclick="deleteProducts({{ $produto->id }})">
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

</x-layouts.admin>
