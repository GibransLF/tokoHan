<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="/docs/images/blog/image-4.jpg" alt="">
                        <div class="flex flex-col justify-between p-4 leading-normal">
                            <header>
                                <h5 class="text-base font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
                                <hr class="h-px bg-gray-400 border-0 dark:bg-gray-700 mb-2">
                            </header>
                            <p class="text-gray-900 dark:text-gray-900 font-bold">Nama Barang</p>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">4 Barang</p>
                            <footer class="mt-4">
                            <hr class="h-px bg-gray-400 border-0 dark:bg-gray-700">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Total harga </span>
                                    <span class="text-sm text-gray-600 dark:text-gray-400 font-bold">Rp.100.000,00</span>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Denda </span>
                                    <span class="text-sm text-red-600 dark:text-red-400">Rp.1.000,00</span>
                                </div>
                            </div>
                            </footer>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

