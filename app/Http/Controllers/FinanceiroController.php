<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use Illuminate\Http\Request;

class FinanceiroController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $gastos = Gasto::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $totalGastos = $gastos->sum('valor');

        $salario = $user->salario ?? 0;

        $sobra = $salario - $totalGastos;

        return view('financeiro.index', compact(
            'gastos',
            'totalGastos',
            'salario',
            'sobra'
        ));
    }

    public function salvarSalario(Request $request)
    {
        $request->validate([
            'salario' => ['required', 'numeric', 'min:0'],
        ]);

        $user = auth()->user();

        $user->salario = $request->salario;
        $user->save();

        return redirect()
            ->route('financeiro.index')
            ->with('success', 'Salário salvo com sucesso!');
    }

    public function adicionarGasto(Request $request)
    {
        $request->validate([
            'descricao' => ['required', 'string', 'max:255'],
            'valor' => ['required', 'numeric', 'min:0.01'],
        ]);

        Gasto::create([
            'user_id' => auth()->id(),
            'descricao' => $request->descricao,
            'valor' => $request->valor,
        ]);

        return redirect()
            ->route('financeiro.index')
            ->with('success', 'Gasto adicionado com sucesso!');
    }

    public function excluirGasto(Gasto $gasto)
    {
        if ($gasto->user_id !== auth()->id()) {
            abort(403);
        }

        $gasto->delete();

        return redirect()
            ->route('financeiro.index')
            ->with('success', 'Gasto excluído com sucesso!');
    }
}