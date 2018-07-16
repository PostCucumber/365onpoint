@component('mail::message')
# Transaction notification

A transaction has just been recorded to your account from the {{ $facility }} facility. The details are below:

- Resident: {{ $residentName }}
- Facility: {{ $facility }}
- Date: {{ $transaction->date }}
- Reason: {{ $transaction->reason }}
- Credit: ${{ number_format($transaction->credit / 100, 2) }}
- Debit: ${{ number_format($transaction->debit / 100, 2) }}
- Total Balance: ${{ number_format($totalBalance / 100, 2) }}


Thanks,<br>
    365 OnPoint Team
@endcomponent
