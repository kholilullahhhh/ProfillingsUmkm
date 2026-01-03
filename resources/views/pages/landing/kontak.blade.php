@extends('layouts.landing.app')
@section('content')
    <div id="banner-area" class="banner-area"
        style="background-image:url({{ asset('landing/images/slider-main/bonto1.jpeg')}})">
        <div class="banner-text">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner-heading">
                            <h1 class="banner-title">Kontak</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Hubungi Kami</li>
                                </ol>
                            </nav>
                        </div>
                    </div><!-- Col end -->
                </div><!-- Row end -->
            </div><!-- Container end -->
        </div><!-- Banner text end -->
    </div><!-- Banner area end -->

    <section id="main-container" class="main-container">
        <div class="container">

            <div class="row text-center">
                <div class="col-12">
                    <h2 class="section-title">Kunjungi Kami</h2>
                    <h3 class="section-sub-title">Temukan Lokasi</h3>
                </div>
            </div>
            <!--/ Title row end -->

            <div class="row">
                <div class="col-md-4">
                    <div class="ts-service-box-bg text-center h-100">
                        <span class="ts-service-icon icon-round">
                            <i class="fas fa-map-marker-alt mr-0"></i>
                        </span>
                        <div class="ts-service-box-content">
                            <h4>Kunjungi Sekolah Kami</h4>
                            <p> RC3Q+2M7, Taeng, Pallangga, Gowa Regency, South Sulawesi 90221
                            </p>
                        </div>
                    </div>
                </div><!-- Col 1 end -->

                <div class="col-md-4">
                    <div class="ts-service-box-bg text-center h-100">
                        <span class="ts-service-icon icon-round">
                            <i class="fa fa-envelope mr-0"></i>
                        </span>
                        <div class="ts-service-box-content">
                            <h4>Email Kami</h4>
                            <p>smktridharmamaros@gmail.com </p>
                        </div>
                    </div>
                </div><!-- Col 2 end -->

                <div class="col-md-4">
                    <div class="ts-service-box-bg text-center h-100">
                        <span class="ts-service-icon icon-round">
                            <i class="fa fa-phone-square mr-0"></i>
                        </span>
                        <div class="ts-service-box-content">
                            <h4>Hubungi Kami</h4>
                            <p>(0411) 000000, 080808 </p>
                        </div>
                    </div>
                </div><!-- Col 3 end -->

            </div>1st row end

            <div class="gap-60"></div>

            <div class="google-map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.4138013351717!2d119.43660337315202!3d-5.197466952405548!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee21448458805%3A0xd120be2abbbb1c44!2sSd%20Inpres%20Bontoala%20I!5e0!3m2!1sen!2sid!4v1755832598831!5m2!1sen!2sid"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="gap-40"></div>

        </div><!-- Conatiner end -->
    </section><!-- Main container end -->
@endsection