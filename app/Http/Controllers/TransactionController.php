<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Mail\TransactionCreated;
use App\Resident;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class TransactionController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Resident $resident
     * @return \Illuminate\Http\Response
     */
    public function create(Resident $resident)
    {
        $resident = $resident->with('transactions')->find($resident->id);

        return view('transactions.create', compact('resident'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TransactionRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        setlocale(LC_MONETARY, 'en_US.UTF-8');
        $debit  = Transaction::parseCurrency($request->debit);
        $credit = Transaction::parseCurrency($request->credit);
        $user = auth()->user();


        $transaction = Transaction::create([
            'resident_id' => $request->resident_id,
            'date'        => $request->date,
            'reason'      => $request->reason,
            'debit'       => $debit,
            'credit'      => $credit,
        ]);

        $residentCredits = Transaction::where('resident_id', $transaction->resident_id)
            ->pluck('credit')->sum();
        $residentDebits  = Transaction::where('resident_id', $transaction->resident_id)
            ->pluck('debit')->sum();

        if ((($residentCredits / 100) - ($residentDebits / 100)) >= 0) {
            $class = 'credit';
        } else {
            $class = 'debit';
        }

        $currentBalance = money_format('%.2n', (($residentCredits - $residentDebits) / 100));

        $data = array(
            'id'              => $transaction->id,
            'date'            => Carbon::parse($transaction->date)->format('F d, Y'),
            'reason'          => $transaction->reason,
            'debit'           => money_format('%.2n', ($debit / 100)),
            'credit'          => money_format('%.2n', ($credit / 100)),
            'current_balance' => $currentBalance,
            'class'           => $class
        );


        $resident = Resident::findOrFail($transaction->resident_id);

        Mail::to([$resident->email, $user])->send(new TransactionCreated($transaction));

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        $resident = Resident::find($transaction->resident_id);

        return view('transactions.edit', compact('transaction', 'resident'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TransactionRequest|Request $request
     * @param  \App\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $debit  = Transaction::parseCurrency($request->debit);
        $credit = Transaction::parseCurrency($request->credit);
        $updated = $transaction->update([
            'resident_id' => $request->resident_id,
            'date'        => $request->date,
            'reason'      => $request->reason,
            'debit'       => $debit,
            'credit'      => $credit
        ]);

        if($updated){
            $request->session()->flash('updated', 'Transaction ' . $transaction->id . ' was successfully updated!');
        }

        return redirect()->route('resident.show', $transaction->resident_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

}
