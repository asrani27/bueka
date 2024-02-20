@extends('frontend.app')
@section('header')
<section class="hero-section" id="hero">
  <div class="wave">
    <svg width="100%" height="355px" viewBox="0 0 1920 355" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
          <path d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,757 L1017.15166,757 L0,757 L0,439.134243 Z" id="Path"></path>
        </g>
      </g>
    </svg>
  </div>

  <div class="container">
    <div class="row align-items-center">
      <div class="col-12 hero-text-image">
        <div class="row">
          <div class="col-lg-8 text-center text-lg-start">
            <h1 data-aos="fade-right">OBE Learning System</h1>
            <p class="mb-5" data-aos="fade-right" data-aos-delay="100">Sistem Pembelajaran Online</p>
            <p data-aos="fade-right" data-aos-delay="200" data-aos-offset="-500"><a href="#" class="btn btn-outline-white">Get started</a></p>
          </div>
          <div class="col-lg-4 iphone-wrap">
            <img src="/tema/assets/img/phone_1.png" alt="Image" class="phone-1" data-aos="fade-right">
            <img src="/tema/assets/img/phone_2.png" alt="Image" class="phone-2" data-aos="fade-right" data-aos-delay="200">
          </div>
        </div>
      </div>
    </div>
  </div>

</section>
@endsection
@section('content')
    
    <!-- ======= Home Section ======= -->
    <section class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-4" data-aos="fade-up" data-aos-delay="">
            <div class="feature-1 text-center">
              <div class="wrap-icon icon-1">
                <i class="bi bi-people"></i>
              </div>
              <h3 class="mb-3">56 DOSEN</h3>
            </div>
          </div>
          <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="feature-1 text-center">
              <div class="wrap-icon icon-1">
                <i class="bi bi-brightness-high"></i>
              </div>
              <h3 class="mb-3">12 PROGRAM STUDI</h3>
            </div>
          </div>
          <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="feature-1 text-center">
              <div class="wrap-icon icon-1">
                <i class="bi bi-bar-chart"></i>
              </div>
              <h3 class="mb-3">102 MATA KULIAH</h3>
            </div>
          </div>
        </div>

      </div>
    </section>

    <section class="section">

      <div class="container">
        <div class="row justify-content-center text-center mb-5" data-aos="fade">
          <div class="col-md-6 mb-5">
            <img src="/logo/gambar3.png" alt="Image" class="img-fluid">
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="step">
              <span class="number">FITUR 01</span>
              <h3>DESAIN KURIKULUM</h3>
              <p>Kami menyediakan fitur desain kurikulum dengan yang relevan dengan ketentuan dan peraturan pengembangan Kurikulum Pendidikan Tinggi berbasis luaran</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="step">
              <span class="number">FITUR 02</span>
              <h3>
                INTEGRASI DENGAN PERANGKAT PEMBELAJARAN</h3>
              <p>Seluruh data dan informasi yang dibutuhkan dalam penyusunan kurikulum dapat saling terintegrasi dengan perangkat pembelajaran</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="step">
              <span class="number">FITUR 03</span>
              <h3>
                DESAIN PEMBELAJARAN OBE</h3>
              <p>Kami menyediakan fitur untuk mendesain pembelajaran OBE (blended learning)</p>
            </div>
          </div>
        </div>
      </div>

    </section>

    <!-- ======= Testimonials Section ======= -->
    <section class="section border-top border-bottom">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-4">
            <h2 class="section-heading">TIM KAMI</h2>
          </div>
        </div>
        <div class="row justify-content-center text-center">
          <div class="col-md-7">

            <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
              <div class="swiper-wrapper">

                <div class="swiper-slide">
                  <div class="review text-center">
                    <p class="review-user">
                      <img src="/tema/assets/img/person_1.jpg" alt="Image" class="img-fluid rounded-circle mb-3">
                      <span class="d-block">
                        <span class="text-black">Jean Doe</span>, &mdash; App User
                      </span>
                    </p>

                  </div>
                </div><!-- End testimonial item -->

                <div class="swiper-slide">
                  <div class="review text-center">

                    <p class="review-user">
                      <img src="/tema/assets/img/person_2.jpg" alt="Image" class="img-fluid rounded-circle mb-3">
                      <span class="d-block">
                        <span class="text-black">Johan Smith</span>, &mdash; App User
                      </span>
                    </p>

                  </div>
                </div><!-- End testimonial item -->

                <div class="swiper-slide">
                  <div class="review text-center">

                    <p class="review-user">
                      <img src="/tema/assets/img/person_3.jpg" alt="Image" class="img-fluid rounded-circle mb-3">
                      <span class="d-block">
                        <span class="text-black">Jean Thunberg</span>, &mdash; App User
                      </span>
                    </p>

                  </div>
                </div><!-- End testimonial item -->

              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Partner Section ======= -->
    <section class="section border-top border-bottom">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-4">
            <h2 class="section-heading">PARTNER</h2>
          </div>
        </div>
        <div class="row justify-content-center text-center">
          <div class="col-md-4">
            <div class="post-entry">
              <a href="blog-single.html" class="d-block mb-4">
                <img src="/logo/aptikom.jpg" alt="Image" class="img-fluid" style="width: 50%">
              </a>
            </div>
          </div>
          <div class="col-md-4">
            <div class="post-entry">
              <a href="blog-single.html" class="d-block mb-4">
                <img src="/logo/uniska.png" alt="Image" class="img-fluid" style="width: 50%">
              </a>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Partner Section -->

    <!-- ======= CTA Section ======= -->
    <section class="section cta-section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 me-auto text-center text-md-start mb-5 mb-md-0">
            <h2>Aplikasi kami tersedia di versi mobile</h2>
          </div>
          <div class="col-md-5 text-center text-md-end">
            <p><a href="#" class="btn d-inline-flex align-items-center"><i class="bx bxl-apple"></i><span>App store</span></a> <a href="#" class="btn d-inline-flex align-items-center"><i class="bx bxl-play-store"></i><span>Google play</span></a></p>
          </div>
        </div>
      </div>
    </section><!-- End CTA Section --> 
@endsection