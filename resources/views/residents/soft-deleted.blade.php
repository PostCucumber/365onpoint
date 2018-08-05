@extends('layouts.main')

@section('title')
    Soft Deleted Residents
@endsection

@section('content')
    <div class="columns main-area">
        <div class="column is-offset-1-tablet is-10-tablet is-10-widescreen">
            <div class="notification is-default intro">
                This is a view of all of your archived residents.
                Click on a resident's name to view any information about that resident. Also, you can start
                typing in the search box below to find any resident quickly.
            </div>

            <a href="/resident/create" class="button is-primary is-large"
               style="margin-top: 30px; margin-left:20px;">Add a
                new resident</a>
            <p style="margin-left:10px;"><input type="text" class="quicksearch input column is-3 is-large"
                                                placeholder="Search" autofocus="autofocus"/></p>
            <div class="grid">
                <div class="columns is-multiline"></div>
                @foreach($residents as $resident)
                    <div class="single-resident column is-4 is-full-mobile">
                        <div class="card">
                            <header class="card-header">
                                <p class="card-header-title">
                                    <a href="{{ route('resident.show', ['id' => $resident->id]) }}"
                                       class="blackish">{{ ucfirst($resident->last_name) }}
                                        , {{ ucfirst($resident->first_name) }} {{ strtoupper($resident->middle_initial) }}</a><span
                                            class="column has-text-right doc-number">{{ $resident->document_number }}</span>
                                </p>
                            </header>
                            <div class="card-content">
                                <div class="content">
                                    @if($resident->soft_deleted_at)
                                        <p class="text-xs" style="color: red; dislplay: block;">Archived on {{ Carbon\Carbon::parse($resident->soft_deleted_at)->format('F j, Y') }}</p>
                                    @endif
                                    <p><strong>Sex: </strong>{{ $resident->sex }}</p>
                                    <p><strong>Race: </strong>{{ $resident->race }}</p>
                                    <p><strong>SC #: </strong>{{ $resident->service_center_number }}
                                    </p>
                                    <p>
                                        <strong>DOB: </strong>{{ Carbon\Carbon::parse($resident->dob)->format('F d, Y') }}
                                    </p>
                                    <p><strong>Age: </strong>{{ $resident->age }}</p>
                                </div>
                            </div>
                            <footer class="card-footer">
                                <a class="card-footer-item blackish"
                                   href="{{ route('transaction.create',  $resident->id ) }}">Account</a>
                                <a class="card-footer-item blackish"
                                   href="{{ route('resident.edit', $resident->id) }}">Edit</a>
                                <a class="card-footer-item primary"
                                   href="{{ route('resident.show', $resident->id) }}">Profile</a>
                            </footer>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts.footer')
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.0/masonry.pkgd.min.js"></script>

    <script>
        // quick search regex
        var qsRegex;

        // init Isotope
        var $grid = $('.grid').isotope({
            itemSelector: '.single-resident',
            layoutMode: 'fitRows',
            filter: function () {
                return qsRegex ? $(this).text().match(qsRegex) : true;
            }
        });

        // use value of search field to filter
        var $quicksearch = $('.quicksearch').keyup(debounce(function () {
            qsRegex = new RegExp($quicksearch.val(), 'gi');
            $grid.isotope();
        }, 200));

        // debounce so filtering doesn't happen every millisecond
        function debounce(fn, threshold) {
            var timeout;
            return function debounced() {
                if (timeout) {
                    clearTimeout(timeout);
                }
                function delayed() {
                    fn();
                    timeout = null;
                }

                timeout = setTimeout(delayed, threshold || 100);
            }
        }

    </script>
@endsection



