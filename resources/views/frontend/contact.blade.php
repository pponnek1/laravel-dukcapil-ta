@extends('layouts.main')

@section('content')

<section id="contact" class="contact section">

    <!-- Section Title -->
    <div class="container section-title aos-init aos-animate" data-aos="fade-up">
        <h2>Contact</h2>
        <h3>Contact Us</h3>
    </div><!-- End Section Title -->

    <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

        <div class="mb-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
            <iframe
              style="border:0; width: 100%; height: 270px;"
              src="https://www.google.com/maps?q=Dinas%20Kependudukan%20dan%20Pencatatan%20Sipil%20Klaten&z=15&output=embed"
              frameborder="0"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>


        <div class="row gy-4">

            <div class="col-lg-4">
                <div class="info-item d-flex aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                    <i class="bi bi-geo-alt flex-shrink-0"></i>
                    <div>
                        <h3>Alamat</h3>
                        <p>Jl. Pemuda No.294, Dusun 1, Tegalyoso, Kec. Klaten Selatan, Kabupaten Klaten, Jawa Tengah 57424, Indonesia</p>
                    </div>
                </div><!-- End Info Item -->

                <div class="info-item d-flex aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
                    <i class="bi bi-telephone flex-shrink-0"></i>
                    <div>
                        <h3>Telephone</h3>
                        <p>+62272321048</p>
                    </div>
                </div><!-- End Info Item -->

                <div class="info-item d-flex aos-init aos-animate" data-aos="fade-up" data-aos-delay="500">
                    <i class="bi bi-envelope flex-shrink-0"></i>
                    <div>
                        <h3>Email</h3>
                        <p>info@example.com</p>
                    </div>
                </div><!-- End Info Item -->

            </div>

            <div class="col-lg-8">
                <form action="forms/contact.php" method="post" class="php-email-form aos-init aos-animate"
                    data-aos="fade-up" data-aos-delay="200">
                    <div class="row gy-4">

                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                        </div>

                        <div class="col-md-6 ">
                            <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                        </div>

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                        </div>

                        <div class="col-md-12">
                            <textarea class="form-control" name="message" rows="6" placeholder="Message"
                                required=""></textarea>
                        </div>

                        <div class="col-md-12 text-center">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>

                            <button type="submit">Send Message</button>
                        </div>

                    </div>
                </form>
            </div><!-- End Contact Form -->

        </div>

    </div>

</section>
< @endsection
