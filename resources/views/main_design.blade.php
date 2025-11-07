<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Harano Biggopti</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/templatemo-villa-agency.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.css') }}">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBN3fjKJKkzl-JcrLX_eSBpmFWFUuXh6A&libraries=places&callback=initAutocomplete"
        async
        defer
    ></script>
<!--

TemplateMo 591 villa agency

https://templatemo.com/tm-591-villa-agency

-->
  </head>



<body>

<!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{ route('index') }}" class="logo">
                        <h2>Harano Biggopti</h2>
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                      <li><a href="{{ route('index') }}">Home</a></li>
                      <li><a href="{{ route('post.new_post') }}" >New Post</a></li>
                      <li><a href="{{ route('post.all_posts') }}">All Posts</a></li>

                      @if (Auth::check())
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                      @else
                        <li><a href="{{ route('login') }}">Log In</a></li>
                        <li><a href="{{ route('register') }}">Sign Up</a></li>
                      @endif
                  </ul>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->










  <section>
    @yield('index')
    @yield('post.all_posts')
    @yield('post.view_post_details')
    @yield('post.new_post')
  </section>

    <footer>
        <div class="container">
        <div class="col-lg-8">
            <p>Copyright © 2048 Villa Agency Co., Ltd. All rights reserved.

            Design: <a rel="nofollow" href="https://templatemo.com" target="_blank">TemplateMo</a></p>
        </div>
        </div>
    </footer>
  <!-- Footer -->
  <<!-- Scripts -->
  <script>
    // ✅ This name MUST match the callback in the Google Maps script URL
    function initAutocomplete() {
      var input = document.getElementById('autocomplete');
      var autocomplete = new google.maps.places.Autocomplete(input, { types: ['geocode'] });

      autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();

        if (!place.geometry) {
          alert("No details available for the selected address!");
          return;
        }

        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();

        $('#latitude').val(lat);
        $('#longitude').val(lng);
      });
    }
  </script>
    <script>
    function playVideo(e) {
        e.preventDefault();
        var video = document.getElementById('myVideo');
        video.play();
        e.target.style.display = 'none'; // Hide play icon after click
    }
    </script>
    <script>
const video = document.getElementById('myVideo');
const playOverlay = document.getElementById('playOverlay');

function toggleVideo() {
  if (video.paused) {
    video.play();
    playOverlay.style.display = 'none';
  } else {
    video.pause();
    playOverlay.style.display = 'flex';
  }
}

// Click anywhere on the video frame
document.getElementById('videoFrame').addEventListener('click', toggleVideo);

// When video ends, show overlay again
video.addEventListener('ended', () => {
  playOverlay.style.display = 'flex';
});
</script>
<!-- Counter animation script -->
<script>
$('.count-number').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).data('to')
    }, {
        duration: $(this).data('speed'),
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
</script>


  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('frontend/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/isotope.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/owl-carousel.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/counter.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/custom.js') }}"></script>
</body>
</html>
