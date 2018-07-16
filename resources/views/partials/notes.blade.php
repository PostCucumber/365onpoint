<h2 class="title">Payment Arrangements</h2>
<div class="columns">
    <div class="column is-full">
        <form action="{{ route('note.store') }}" method="POST" id="new-note">
            <div class="columns">
                {{ csrf_field() }}
                <input type="hidden" name="resident_id" value="{{ $resident->id }}">
                <input type="hidden" name="updated_by" value="{{ \Auth::user()->id }}">
                <div class="column is-2">
                    <label class="label">Date</label>
                    <p class="control has-icon">
                                <span class="icon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                        <input class="input" type="text" name="date" id="note-date">
                    </p>
                </div>
                <div class="column is-7">
                    <label class="label">Note</label>
                    <p class="control">
                        <textarea class="textarea" name="note" id="note" rows="5"></textarea>
                    </p>
                </div>
            </div>
            <div class="columns">
                <div class="column is-7">
                    <button class="button is-info is-pulled-right" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<hr>
<table class="table" style="table-layout: fixed; max-width: 90%;">
    <thead>
    <tr>
        <th>Date</th>
        <th>Note</th>
        <th style="text-align:right;">Updated By</th>
    </tr>
    </thead>
    <tbody id="transaction-table-body">
    @foreach($resident->notes as $note)
        <tr>
            <td>{{ Carbon\Carbon::parse($note->date)->format('F d, Y') }}</td>
            <td style="word-wrap: break-word;">{{ $note->note }}</td>
            <td style="text-align:right;">{{ App\User::find($note->updated_by)->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
