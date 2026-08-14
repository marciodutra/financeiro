<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Painel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-semibold mb-2">
                        Bem-vindo ao Sistema de Controle Financeiro!
                    </h3>

                    <p class="text-gray-600">
                        Olá, {{ Auth::user()->name }}.
                        Você está conectado ao sistema.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm text-gray-500">
                            Receitas
                        </p>

                        <p class="text-2xl font-bold text-gray-800 mt-2">
                            R$ 0,00
                        </p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm text-gray-500">
                            Despesas
                        </p>

                        <p class="text-2xl font-bold text-gray-800 mt-2">
                            R$ 0,00
                        </p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm text-gray-500">
                            Saldo
                        </p>

                        <p class="text-2xl font-bold text-gray-800 mt-2">
                            R$ 0,00
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>