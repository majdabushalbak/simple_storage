<!DOCTYPE html>
<html lang="ar" dir="rtl">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title dir="rtl">@yield('title', 'الصفحة الرئيسية')</title>
    <link rel="icon"  href="Logo.svg">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@160..700&display=swap" rel="stylesheet">
    <link href="{{   asset('css/main.css') }}" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg pb-0" data-bs-theme="dark">
        <div class="container-fluid align-items-end">

            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    @auth

                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger">تسجيل الخروج</button>
                        </form>
                        </li>
                    @else

                    @endauth
                </ul>
                <ul class="navbar-nav ms-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">الصفحة الرئيسية</a>
                    </li>



                </ul>
            </div>
        </div>
    </nav>

    {{-- page content--}}
    <div class="page-container  mx-4 mx-lg-5 mt-5">
        @yield('content')
    </div>






    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>

        var availableTags = [];

        $.ajax({
    method: "GET",
    url: "/product-list",
    success: function(response) {
        $("#product-search").autocomplete({
            source: response
        });
    },
    error: function(xhr, status, error) {
        console.error("AJAX Error:", status, error);
    }
});


function startAutoComplete(availableTags) {
    $("#product-search").autocomplete({
        source: availableTags
    });
}

        </script>
</body>

</html>
