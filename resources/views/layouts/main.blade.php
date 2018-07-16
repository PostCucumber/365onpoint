<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
    'csrfToken' => csrf_token(),
    ]) !!};
    </script>
</head>
<body>
<div id="root">
    <div class="columns">
        <section class="column is-2 is-hidden-mobile is-hidden-tablet-only aside hero is-fullheight is-dark">
            <div class="main">
                <div class="columns">
                    <div class="column has-text-centered">
                        <p class="subtitle is-4 facility-label">{{ \Auth::user()->facility }}</p>
                    </div>
                </div>
                <div class="columns">
                    <div class="column has-text-centered">
                        <div class="has-text-centered">
                            <form action="/logout" method="post">
                                {{ csrf_field() }}
                                <button type="submit" id="logout-button" class="button is-warning is-outlined" style="margin-bottom:30px;">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
                <hr class="aside-divider">
                <a href="/home" :class="{'active': onPage('/home')}" class="item side-nav"><span class="icon"><i
                                class="fa fa-tachometer column"></i></span><span
                            class="name">Dashboard</span></a>
                <a href="{{ route('resident.index') }}" class="item side-nav"><span class="icon"><i
                                class="fa fa-user"></i></span><span
                            class="name">Residents</span></a>
                <a href="{{ route('invoices.select') }}" class="item side-nav"><span class="icon"><i
                                class="fa fa-list-alt"></i></span><span
                            class="name">Invoice</span></a>
                <a href="{{ route('facility-info.index') }}" class="item side-nav"><span class="icon"><i
                                class="fa fa-cogs"></i></span><span
                            class="name">Facility Settings</span></a>
                <hr class="aside-divider">
                <a href="/resident_reports" class="item side-nav"><span class="name">Resident&nbsp;Reports</span></a>
                <a href="/transaction_reports" class="item side-nav"><span class="name">Transaction&nbsp;Reports</span></a>
                <a href="/facility_report/select" class="item side-nav"><span class="name">Facility&nbsp;Reports</span></a>
            </div>
        </section>
        <div class="column">
            <nav class="hamburger nav is-hidden-widescreen">
                <span class="nav-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>

                <div class="nav-right nav-menu is-hidden-desktop">
                    <a href="/home" :class="{'is-active': onPage('/home')}" class="nav-item"><span
                                class="icon is-hidden-tablet-only"><i
                                    class="fa fa-tachometer"></i></span><span
                                class="name padding-10-lr">Dashboard</span></a>
                    <a href="{{ route('resident.index') }}" :class="{'is-active': onPage('/resident')}"
                       class="nav-item"><span
                                class="icon is-hidden-tablet-only"><i
                                    class="fa fa-user"></i></span><span
                                class="name padding-10-lr">Residents</span></a>
                    <a href="/resident_reports" :class="{'is-active': onPage('/resident_reports')}"
                       class="nav-item"><span
                                class="icon is-hidden-tablet-only"><i
                                    class="fa fa-file-text"></i></span><span
                                class="name padding-10-lr">Resident&nbsp;Reports</span></a>
                    <a href="/transaction_reports" :class="{'is-active': onPage('/transaction_reports')}"
                       class="nav-item"><span
                                class="icon is-hidden-tablet-only"><i
                                    class="fa fa-file-text"></i></span><span
                                class="name padding-10-lr">Transaction&nbsp;Reports</span></a>
                    <a href="/facility_report/select" :class="{'is-active': onPage('/facility_reports')}"
                       class="nav-item"><span
                                class="icon is-hidden-tablet-only"><i
                                    class="fa fa-file-text"></i></span><span
                                class="name padding-10-lr">Facility&nbsp;Reports</span></a>
                    <div class="nav-item">
                        <div class="field">
                            <p class="control">
                            <form action="/logout" method="post">
                                {{ csrf_field() }}
                                <button type="submit" class="button is-warning">Logout</button>
                            </form>
                            </p>
                        </div>
                    </div>

                </div>
            </nav>
            <section class="hero is-info is-bold is-small column">
                <!-- Hero content: will be in the middle -->
                <div class="hero-body">
                    <div class="container">
                        <h1 class="title is-2">
                            @yield('title')
                        </h1>
                    </div>
                </div>
            </section>
            @yield('content')
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="has-text-centered">
                <p>
                    Tracking Solutions by <strong>OnPoint</strong>. The website content
                    is licensed <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">CC ANS 4.0</a>.
                </p>
            </div>
        </div>
    </footer>
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts.footer')
<script>
    $('.nav-toggle').on('click', function () {
        $('.nav-menu').toggleClass('is-active');
    });
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-100555024-1', 'auto');
    ga('send', 'pageview');

</script>
</body>
</html>