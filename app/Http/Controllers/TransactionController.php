<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Stuff;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with(['customer', 'user'])->get();

        return view('transaction.list', [
            'data' => $transactions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 
        $stuffs = Stuff::all();

        return view('transaction.add', [
            'stuffs' => $stuffs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        Transaction::create($request->all());

        return redirect('/transactions')->with([
            'mess' => 'Data Berhasil Disimpan',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return view('transaction.add', [
            'data' => $transaction,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $transaction->fill($request->all());
        $transaction->save();

        return redirect('/transactions')->with([
            'mess' => 'Data Behasil Disimpan',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect('/transactions')->with([
            'mess' => 'Data Behasil Disimpan',
        ]);
    }
}
