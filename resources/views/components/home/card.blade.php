<div class="w-full max-w-sm bg-neutral-100 border border-gray-200 rounded-lg shadow ">
    <a href="#">
        <img class="p-8 rounded-t-lg" src="{{asset($asset)}}" alt="product image" />
    </a>
    <div class="px-5 pb-5">
        <a href="#">
            <h5 class="text-xl font-semibold tracking-tight text-gray-900">
                {{$product}}
            </h5>
        </a>

        <div class="flex items-center justify-between">
            <span class="text-3xl font-bold text-gray-900 ">R$ {{$value}}</span>
            <a href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Detalhe</a>
        </div>
    </div>

</div>