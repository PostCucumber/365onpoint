<div id="form-error-box" class="column is-full notification is-danger" style="display:none">
    <ul id="form-error-list">
    </ul>
</div>
<div class="columns">
    <form action="{{ route('transaction.store') }}" method="POST" id="transactionCreate">
        <div class="column">
            <div class="columns is-desktop is-multiline">
                {{ csrf_field() }}
                <input type="hidden" name="resident_id" value="{{ $residentInfo->id }}">
                <div class="column">
                    <label class="label">Date of transaction</label>
                    <p class="control has-icon">
                        <span class="icon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <input class="input" type="text" name="date" id="transaction_date_calendar">
                    </p>
                </div>
                <div class="column">
                    <label class="label">Transaction</label>
                    <p class="control">
                        <span class="select">
                            <select name="reason" id="reason">
                                <option value="">Select type</option>
                                <option value="Urinalysis">Urinalysis</option>
                                <option value="Rides">Rides</option>
                                <option value="Physical">Physical</option>
                                <option value="Payment">Payment</option>
                                <option value="Sustenance">Sustenance</option>
                            </select>
                        </span>
                    </p>
                </div>
                <div class="column">
                    <label class="label">Debit</label>
                    <p class="control">
                        <input class="input" type="text" name="debit" id="debit">
                    </p>
                </div>
                <div class="column">
                    <label class="label">Credit</label>
                    <p class="control">
                        <input class="input" type="text" name="credit" id="credit">
                    </p>
                </div>
            </div>
            <div class="column">
                <button class="button is-info" type="submit">Submit</button>
            </div>
        </div>
    </form>
</div>
