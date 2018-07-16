@foreach($residentInfo->transactions() as $transaction)
    <div class="level">
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Date</p>
                <p class="title">{{ $transaction->date }}</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Reason</p>
                <p class="title">{{ $transaction->reason }}</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Debit</p>
                <p class="title"> - ${{ ($transaction->debit)/100 }}</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Credit</p>
                <p class="title">${{ ($transaction->credit)/100 }}</p>
            </div>
        </div>
    </div>
@endforeach