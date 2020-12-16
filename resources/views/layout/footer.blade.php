    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3><a href="{{url('/')}}">{{config('app.name')}}</a></h3>
                        <p>
                            <br><br>
                            <strong><i class="fas fa-address-card"></i></strong>{{$version['officeAddresss']}}<br>
                            <strong><i class="fas fa-envelope"></i></strong>{{$version['email']}}<br>
                            <strong><i class="fas fa-mobile-alt"></i></strong>{{$version['tollfree']}}<br>
                            <strong><i class="fab fa-whatsapp"></i></strong>{{$version['whatsapp']}}<br>
                        </p>
                    </div>
                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4></h4>
                        <ul>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Social Networks</h4>
                        <p>Please find us at</p>
                        <div class="social-links mt-3">
                            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container py-4">
            <div class="copyright">&copy; &reg;<strong><span><a href="{{url('/')}}">{{config('app.name')}}</a></span></strong>.All right reserved <span>{{$version['version_name'] .'-'.$version['val']}}</span>
            </div>
            <div class="credits">
            </div>
        </div>
    </footer><!-- End Footer -->