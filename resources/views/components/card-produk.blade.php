<div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <a href="#">
        <img class="mx-auto rounded-t-lg h-32 w-auto object-center" src="{{ asset('storage/' . $gambar) }}" alt="product image" />
    </a>
    <div class="p-5"> 
            <h3 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $nama . " - " . $kode }}</h3>
        <div class="flex items-center mt-2.5 mb-5">
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 md:h-[5rem]">
                Deskrpsi: {{ $deskripsi }} <br>
                Ukuran: {{ $ukuran }}
            </p>
        </div>
        <div class="flex items-center justify-between">
            <span class="text-2xl font-bold text-gray-900 dark:text-white">
                Rp.{{$hargaMin}}
            </span>
            {{ $slot }}
        </div>
    </div>
</div>