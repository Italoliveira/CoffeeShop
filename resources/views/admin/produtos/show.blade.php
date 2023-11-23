<x-layouts.window>

    <div class="flex items-center justify-end my-6">
        <div>
            <h1></h1>
        </div>
        <div class="flex items-center space-x-4">
            <span class="ms-3 text-sm font-medium text-gray-900">Editar</span>
            <label class="relative inline-flex items-center me-5 cursor-pointer">
                <input type="checkbox" value="" class="sr-only peer" id="checkEdit">
                <div
                    class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-blue-600">
                </div>
            </label>
        </div>
    </div>

    <form method="POST" action="{{ route('produtos.update', ['produto' => $produto->id]) }}" class="flex flex-col"
        enctype="multipart/form-data">

        @csrf
        @method('PATCH')

        <div class="flex flex-1">
            <div class="flex flex-col mx-5  flex-1">
                <label for="" class="text-center font-bold">Nome</label>
                <input type="text" name="name" id="name"
                    class="h-10 rounded-md border-2 border-black text-center p-4 disabled:bg-gray-200"
                    value="{{ $produto->name }}" disabled>
            </div>

            <div class="flex flex-col mx-5 flex-1">
                <label for="" class="text-center font-bold">Quantidade</label>
                <input type="text" name="quantity_unit" id="quantity_unit"
                    class="h-10 rounded-md border-2 border-black text-center p-4 disabled:bg-gray-200"
                    value="{{ $produto->quantity_unit }}" disabled>
            </div>

            <div class="flex flex-col mx-5 flex-1">
                <label for="" class="text-center font-bold">Preço</label>
                <input type="text" name="price" id="value"
                    class="h-10 rounded-md border-2 border-black text-center p-4 disabled:bg-gray-200"
                    value="{{ $produto->price }}" disabled>
            </div>

            <div class="flex flex-col mx-5 flex-1">

                <label for="" class="text-center font-bold text-black">Categoria</label>

                <select name="category" id="category"
                    class="h-10 rounded-md border-2 border-black text-center disabled:bg-gray-200">

                    @foreach ($categorias as $categoria)
                        <option {{ $categoria->id == $produto->category ? 'selected' : '' }}
                            value="{{ $produto->category }}">
                            {{ $categoria->name }}</option>
                    @endforeach

                </select>

            </div>
        </div>

        <div class="flex pt-4">
            <div class="flex flex-col mx-5 flex-1 w-1/2">
                <label for="" class="text-center font-bold">Descrição</label>
                <textarea name="description" id="describe" rows="6" cols="10"
                    class=" rounded-md border-2 border-black text-left p-2 disabled:bg-gray-200 ">
                    {{ $produto->description }}
                    </textarea>
            </div>

            <div class="w-1/2 flex flex-col justify-between">

                <div class="flex items-center space-x-6 justify-center flex-1">
                    <div class="shrink-0">
                        <img id='preview_img' class="h-16 w-16 object-cover rounded-sm"
                            src="{{ asset( $produto->image) }}" alt="Current profile photo" />
                    </div>
                    <label>
                        <input type="file" onchange="loadFile(event)"
                            class="block w-full text-sm text-slate-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-violet-50 file:text-blue-700
                        hover:file:bg-violet-100 
                      "
                            id='file-image'name='file-image' />
                    </label>
                </div>

                <div class="flex justify-between">


                    <div class="flex flex-col mx-5 flex-1">

                        <label for="" class="text-center font-bold text-black">Status</label>

                        <select name="status" id="status"
                            class="h-10 rounded-md border-2 border-black text-center disabled:bg-gray-200">

                            <option value="A">Ativo</option>
                            <option value="D">Desativado</option>

                        </select>

                    </div>

                    <div class="w-1/2 flex justify-end items-end">
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded h-10 mx-4"
                            onclick="window.close()">
                            Fechar
                        </button>
                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded h-10"
                            onclick="document.getElementById('FormNewProducts').submit()">
                            Guardar
                        </button>
                    </div>
                </div>
            </div>

    </form>

    <script>
        var checkEdit = document.getElementById('checkEdit');

        function ChangeEdit() {

            if (checkEdit.checked) {

                $disable = false;

            } else {

                $disable = true;
                location.reload();
            }

            document.getElementById('name').disabled = $disable
            document.getElementById('quantity_unit').disabled = $disable
            document.getElementById('value').disabled = $disable
            document.getElementById('category').disabled = $disable
            document.getElementById('describe').disabled = $disable
            document.getElementById('file-image').disabled = $disable
            document.getElementById('status').disabled = $disable
        }

        checkEdit.addEventListener("change", ChangeEdit);


        var loadFile = function(event) {

            var input = event.target;
            var file = input.files[0];
            var type = file.type;

            var output = document.getElementById('preview_img');

            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
    </script>

</x-layouts.window>
