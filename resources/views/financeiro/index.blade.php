<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Controle Financeiro</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            color: #222;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
        }

        .titulo {
            text-align: center;
            margin-bottom: 20px;
        }

        .titulo h1 {
            margin-bottom: 5px;
        }

        .titulo p {
            color: #666;
        }

        .navegacao {
            margin-bottom: 20px;
        }

        .btn-painel {
            display: inline-block;
            padding: 10px 16px;
            background: #374151;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            transition: background 0.2s;
        }

        .btn-painel:hover {
            background: #1f2937;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .campo {
            margin-bottom: 20px;
        }

        .campo label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .campo input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        .gasto {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .gasto:last-child {
            border-bottom: none;
        }

        .gasto-info strong {
            display: block;
            margin-bottom: 4px;
        }

        .gasto-info span {
            color: #666;
        }

        .btn {
            border: none;
            border-radius: 6px;
            padding: 10px 16px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-adicionar {
            background: #2563eb;
            color: white;
            width: 100%;
            margin-top: 15px;
        }

        .btn-excluir {
            background: #dc2626;
            color: white;
        }

        .resumo {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .resumo-item {
            padding: 20px;
            border-radius: 8px;
            background: #f8fafc;
            text-align: center;
        }

        .resumo-item span {
            display: block;
            color: #666;
            margin-bottom: 8px;
        }

        .resumo-item strong {
            font-size: 22px;
        }

        .vazio {
            text-align: center;
            color: #777;
            padding: 20px 0;
        }

        @media (max-width: 700px) {
            .resumo {
                grid-template-columns: 1fr;
            }

            .gasto {
                gap: 15px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="titulo">
        <h1>Controle Financeiro</h1>
        <p>Controle seu salário e seus gastos</p>
    </div>

    <div class="navegacao">
        <a
            href="{{ route('dashboard') }}"
            class="btn-painel"
        >
            ← Voltar ao Painel
        </a>
    </div>

    <div class="card">

        <form action="{{ route('financeiro.salario') }}" method="POST">

            @csrf

            <div class="campo">
                <label for="salario">Meu salário</label>

                <input
                    type="number"
                    id="salario"
                    name="salario"
                    value="{{ $salario }}"
                    placeholder="Digite seu salário"
                    step="0.01"
                    min="0"
                    required
                >
            </div>

            <button type="submit" class="btn btn-adicionar">
                Salvar salário
            </button>

        </form>

    </div>

    <div class="card">

        <h2>Meus gastos</h2>

        @forelse($gastos as $gasto)

            <div class="gasto">

                <div class="gasto-info">
                    <strong>{{ $gasto->descricao }}</strong>

                    <span>
                        R$ {{ number_format($gasto->valor, 2, ',', '.') }}
                    </span>
                </div>

                <form
                    action="{{ route('financeiro.gasto.excluir', $gasto) }}"
                    method="POST"
                    onsubmit="return confirm('Deseja realmente excluir este gasto?')"
                >
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-excluir">
                        Excluir
                    </button>
                </form>

            </div>

        @empty

            <div class="vazio">
                Nenhum gasto cadastrado.
            </div>

        @endforelse

        <form action="{{ route('financeiro.gasto') }}" method="POST">

            @csrf

            <div class="campo">
                <label for="descricao">Descrição do gasto</label>

                <input
                    type="text"
                    id="descricao"
                    name="descricao"
                    placeholder="Ex.: Aluguel, Mercado, Luz..."
                    required
                >
            </div>

            <div class="campo">
                <label for="valor">Valor</label>

                <input
                    type="number"
                    id="valor"
                    name="valor"
                    placeholder="0,00"
                    step="0.01"
                    min="0.01"
                    required
                >
            </div>

            <button type="submit" class="btn btn-adicionar">
                + Adicionar gasto
            </button>

        </form>

    </div>

    <div class="card">

        <h2>Resumo</h2>

        <div class="resumo">

            <div class="resumo-item">
                <span>Salário</span>

                <strong id="resumo-salario">
                    R$ {{ number_format($salario, 2, ',', '.') }}
                </strong>
            </div>

            <div class="resumo-item">
                <span>Total de gastos</span>

                <strong>
                    R$ {{ number_format($totalGastos, 2, ',', '.') }}
                </strong>
            </div>

            <div class="resumo-item">
                <span>Quanto sobrou</span>

                <strong id="resumo-sobra">
                    R$ {{ number_format($sobra, 2, ',', '.') }}
                </strong>
            </div>

        </div>

    </div>

</div>

</body>
</html>