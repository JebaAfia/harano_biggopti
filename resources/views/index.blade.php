@extends('main_design')
@section('index')

  <!-- Hero Section with Banner -->
  <section class="hero">
    <div class="hero-content">
      <h2>Lost Something? Or Found Something?</h2>
      <p>A fresh, green way to reconnect people with their belongings.</p>
      <button onclick="document.getElementById('cards').scrollIntoView({behavior: 'smooth'})">Get Started</button>
    </div>
  </section>

  <!-- Cards Section -->
  <section class="cards" id="cards">
    <a  href="{{ route('post.new_post') }}" class="card">
      <h3>New Post</h3>
      <p>Lost something valuable or found an item? Share the details here so we can help return it to its rightful owner quickly and safely.</p>
    </a>
    <a href="#" class="card">
      <h3>Browse Listings</h3>
      <p>Check the latest lost & found posts in your community.</p>
    </a>
  </section>

  <!-- Call to Action -->
  <section class="cta">
    <h2>Be a Part of the Community</h2>
    <p>Together, we can make it easier to return lost items to their owners.</p>
    <button>Join Now</button>
  </section>


@endsection
