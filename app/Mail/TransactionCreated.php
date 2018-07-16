<?php

namespace App\Mail;

use App\Resident;
use App\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TransactionCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $transaction;

    /**
     * Create a new message instance.
     * @param Transaction $transaction
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $residentId   = $this->transaction->resident->id;
        $resident     = Resident::findOrFail($residentId);
        $facility     = $resident->facility;
        $totalBalance = Resident::totalBalance($residentId);

        return $this->markdown('emails.transactionCreated')
            ->with([
                'facility'     => $facility,
                'residentName' => $resident->first_name . ' ' . $resident->last_name,
                'totalBalance' => $totalBalance
            ]);
    }
}
