<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{config('app.name')}} - {{$title}}</title>
    <meta name="author" content="Piller">
    <meta name="description" content="Piller-html - Real Estate Home HTML Template">
    <meta name="keywords" content="Piller-html - Real Estate Home HTML Template">
    <meta name="robots" content="INDEX,FOLLOW">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('assets/img/favicons/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&amp;family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/app.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <style>
.custom-pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.custom-pagination .pagination-wrapper {
    display: flex;
    gap: 6px;
    align-items: center;
}

/* buttons */
.custom-pagination .page {
    width: 38px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 6px;
    border: 1px solid #0f3d2e;
    background: #145a32;
    color: white;

    text-decoration: none;
}

/* hover */
.custom-pagination .page:hover {
    background: #1e7a42;
}

/* active */
.custom-pagination .active {
    background: #0b2e1c;
}

/* disabled */
.custom-pagination .disabled {
    opacity: 0.4;
    pointer-events: none;
}

.amenity-item {
    display: inline-flex !important;
    align-items: center !important;

    margin-right: 20px !important; /* space between amenities */
    margin-bottom: 10px !important;
}

.amenity-item i {
    color: #000;
    font-size: 14px;

    margin-right: 4px !important; /* close to text */
}

.amenity-item span {
    line-height: 1;
}
    </style>
</head>

@yield('content')


 <script src="{{asset('assets/js/vendor/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('assets/js/app.min.js')}}"></script>
    <script src="{{asset('assets/js/wow.min.js')}}"></script>
    <script src="{{asset('assets/js/nice-select.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>