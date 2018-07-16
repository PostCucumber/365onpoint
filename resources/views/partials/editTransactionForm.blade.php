<div id="form-error-box" class="column is-full notification is-danger" style="display:none">
    <ul id="form-error-list">
    </ul>
</div>
<div class="columns">
    <form action="{{ route('transaction.update', $transaction->id) }}" method="POST" id="transactionEdit">
        <div class="column">
            <div class="columns is-desktop is-multiline">
                {{ csrf_field() }}
                {{ method_field("PATCH") }}
                <input type="hidden" name="resident_id" value="{{ $transaction->resident_id }}">
                <div class="column">
                    <label class="label">Date of transaction</label>
                    <p class="control has-icon">
                        <span class="icon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <input class="input" type="text" name="date" id="edit_transaction_date_calendar">
                    </p>
                </div>
                <div class="column">
                    <label class="label">Transaction</label>
                    <p class="control">
                        <span class="select">
                            <select name="reason" id="reason">
                                <option value="{{ $transaction->reason }}">{{ $transaction->reason }}</option>
                                @if($transaction->reason != 'Urinalysis')
                                    <option value="Urinalysis">Urinalysis</option>
                                @endif
                                @if($transaction->reason != 'Rides')
                                    <option value="Rides">Rides</option>
                                @endif
                                @if($transaction->reason != 'Physical')
                                    <option value="Physical">Physical</option>
                                @endif
                                @if($transaction->reason != 'Payment')
                                    <option value="Payment">Payment</option>
                                @endif
                                @if($transaction->reason != 'Sustenance')
                                    <option value="Sustenance">Sustenance</option>
                                @endif
                            </select>
                        </span>
                    </p>
                </div>
                <div class="column">
                    <label class="label">Debit</label>
                    <p class="control">
                        <input class="input" type="text" name="debit" id="debit" value="{{ $transaction->debit }}">
                    </p>
                </div>
                <div class="column">
                    <label class="label">Credit</label>
                    <p class="control">
                        <input class="input" type="text" name="credit" id="credit" value="{{ $transaction->credit }}">
                    </p>
                </div>
            </div>
            <div class="column">
                <button class="button is-info" type="submit">Submit</button>
            </div>
        </div>
    </form>
</div>
