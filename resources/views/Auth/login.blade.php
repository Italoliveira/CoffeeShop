<x-layouts.auth>

    <div class="flex items-center justify-center h-screen">

        <form action="{{ route('auth') }}" method="POST"
            class="flex flex-col space-y-4 bg-gray-200 p-8 w-1/3 h-2/3 overflow shadow-sm shadow-neutral-200"
            id="formLogin">

            <div class="flex justify-center items-center mb-10">
                <span class="logo-header-login text-5xl text-black">Coffee Shop</span>
            </div>

            @csrf

            <div class="flex flex-col space-y-2">
                <label class="text-sm font-semibold">Email</label>
                <input type="email" name="email" id="email" class="border-2 border-black rounded-md h-10 p-4">
            </div>

            <div class="flex flex-col space-y-2">
                <label class="text-sm font-semibold">Senha</label>
                <input type="password" name="password" id="password" class="border-2 border-black rounded-md h-10 p-4">
            </div>

            <div class="flex text-red-500 text-sm justify-center items-center">

                @error('error')

                    <span>
                        Credenciais Invalidas
                    </span>

                @enderror

            </div>

            <div class="flex flex-col space-y-2">

                <div class="flex items-center space-x-2 my-4 text-sm">
                    <input type="checkbox" name="remenber" id="remenber" class="h-4 w-4">
                    <label>Lembrar de mim</label>
                </div>

                <input type="submit" value="Acessar"
                    class="rounded-xl h-10 bg-blue-600 hover:bg-blue-700 text-white hover:text-gray-200 font-semibold">

                <div class="text-center">
                    <a href="{{route('register')}}" class="text-sm"><span> Não tenho uma conta ainda? <b>Inscrever-se</b></span></a>
                </div>

            </div>

        </form>

    </div>



</x-layouts.auth>
