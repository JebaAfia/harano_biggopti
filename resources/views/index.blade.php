@extends('main_design')
@section('index')
    <div class="main-banner">
        <div class="owl-carousel owl-banner">
            <div class="item item-1">
                <div class="overlay"></div> <!-- BLACK OVERLAY -->
                <div class="header-text">
                    <span class="category">Lost Something? <em>Or Found Something?</em></span>
                    <h2>Every lost thing has a story waiting to be found.</h2>
                </div>
            </div>
            <div class="item item-2">
                <div class="overlay"></div>
                <div class="header-text">
                    <h2>Lost it? Let’s bring it home.</h2>
                </div>
            </div>
            <div class="item item-3">
                <div class="overlay"></div>
                <div class="header-text">
                    <h2>Because every item deserves a way back.</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="featured section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="left-image">
                        <img src="assets/images/featured.jpg" alt="">
                        <a href="property-details.html"><img src="assets/images/featured-icon.png" alt=""
                                style="max-width: 60px; padding: 0px;"></a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="section-heading">
                        <h6>| Featured</h6>
                        <h2>Best lost &amp; Found service</h2>
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    What if I found something?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    If you found something, simply report or post it on our website with a short
                                    description. We’ll help connect you with the rightful owner safely and easily.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    What if I lost something?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    If you lost something, don’t worry — just post the details on our website. We’ll help
                                    you reach the person who might have found it and get it back to you.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    How does this work ?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    It’s simple! If you lose or find something, post it on our website with details and
                                    photos. Our system helps match lost and found items so you can reconnect with your
                                    belongings or their rightful owners.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    How can Harano Biggopti help you?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Harano Biggopti helps you easily report lost or found items and connects you with the
                                    right people. Whether it’s a document, gadget, pet, or personal item — we make it simple
                                    to recover what’s lost or return what you’ve found.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="video section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4">
                    <div class="section-heading text-center">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="video-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="video-frame position-relative" id="videoFrame">
                        <video id="myVideo" width="100%" poster="assets/images/video-frame.jpg">
                            <source src="frontend/assets/videos/index-video.mp4" type="video/mp4">
                            Your browser does not support HTML5 video.
                        </video>
                        <div class="video-overlay" id="playOverlay">
                            <i class="fa fa-play"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="fun-facts py-5 bg-light">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-4 mb-4">
                    <div class="counter">
                        <h2 class="count-number">{{ $foundCount }}</h2>
                        <p class="count-text">Found<br>Items</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="counter">
                        <h2 class="count-number">{{ $lostCount }}</h2>
                        <p class="count-text">Lost<br>Items</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="counter">
                        <h2 class="count-number">{{ $resolvedCount }}</h2>
                        <p class="count-text">Resolved<br>Items</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="properties section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4">
                    <div class="section-heading text-center">
                        <h2>Recent Posts</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                @forelse($posts->take(6) as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="item">
                            @php
                                $images = json_decode($post->images, true);
                                $firstImage = $images[0] ?? 'default.jpg';
                            @endphp
                            <a href="{{ route('post.view_post_details', $post->id) }}">
                                <img src="{{ asset($firstImage) }}" alt="{{ $post->title }}"
                                    style="width:100%; height:200px;">
                            </a>
                            <span class="category">{{ $post->category->category_name ?? 'Uncategorized' }}</span>
                            <h6>{{ ucfirst($post->type) }}</h6>
                            <h4>
                                <a href="{{ route('post.view_post_details', $post->id) }}">
                                    {{ $post->title }}
                                </a>
                            </h4>
                            <ul>
                                <li>Occurrence Date: <span>{{ $post->occurrence_date }}</span></li>
                                <li>Location: <span>{{ $post->location }}</span></li>
                            </ul>
                            <div class="main-button">
                                <a href="{{ route('post.view_post_details', $post->id) }}">View Details</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No posts found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="contact section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4">
                    <div class="section-heading text-center">
                        <h6>| Contact Us</h6>
                        <h2>Get In Touch Us</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div id="map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d364823.50613121825!2d88.00998736777588!3d23.6850227193615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8a0b8d77dcb%3A0x48c8c1b15835f029!2sBangladesh!5e0!3m2!1sen!2sbd!4v1709804640000!5m2!1sen!2sbd"
                            width="100%" height="500px" frameborder="0"
                            style="border:0; border-radius: 10px; box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.15);"
                            allowfullscreen=""></iframe>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="item phone">
                                <img src="assets/images/phone-icon.png" alt="" style="max-width: 52px;">
                                <h6>01400767129<br><span>Phone Number</span></h6>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="item email">
                                <img src="assets/images/email-icon.png" alt="" style="max-width: 52px;">
                                <h6>afiakhatun.npi@gmail.com<br><span>Business Email</span></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <form id="contact-form" action="{{ route('send.email') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <fieldset>
                                    <label for="name">Full Name</label>
                                    <input type="text" name="name" id="name" placeholder="Your Name..."
                                        required>
                                </fieldset>
                            </div>

                            <div class="col-lg-12">
                                <fieldset>
                                    <label for="email">Email Address</label>
                                    <input type="email" name="email" id="email" placeholder="Your E-mail..."
                                        required>
                                </fieldset>
                            </div>

                            <div class="col-lg-12">
                                <fieldset>
                                    <label for="subject">Subject</label>
                                    <input type="text" name="subject" id="subject" placeholder="Subject...">
                                </fieldset>
                            </div>

                            <div class="col-lg-12">
                                <fieldset>
                                    <label for="message">Message</label>
                                    <textarea name="message" id="message" placeholder="Your Message" required></textarea>
                                </fieldset>
                            </div>

                            <div class="col-lg-12">
                                <fieldset>
                                    <button type="submit" id="form-submit" class="orange-button">Send Message</button>
                                </fieldset>
                            </div>

                            @if (session('success'))
                                <div class="alert alert-success mt-3">{{ session('success') }}</div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
