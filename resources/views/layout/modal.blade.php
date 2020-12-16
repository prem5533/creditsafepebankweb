<!-- Popup for Subscriber starts here --> 
    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalAria" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="error" id=""></div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <style type="text/css">
    .modal-header {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: start;
    align-items: flex-start;
    -ms-flex-pack: justify;
    justify-content: space-between;
    padding: 1rem 1rem;
    border-bottom: 1px solid #dee2e6;
    border-top-left-radius: calc(.3rem - 1px);
    border-top-right-radius: calc(.3rem - 1px);
    background-color: transparent;
    color: #000;
    text-transform: uppercase;
}
.modal-title {
    margin-bottom: 0;
    line-height: 1.5;
    font-weight: bold;
    font-size: 20px;
    margin-left: 20px;
}
.modal-title:after{
    content: '';
    width: 10px;
    height: 25px;
    position: absolute;
    left: 0px;
    background-color: #1fbafc;
    top: 18px;
}
.modal-body {
    position: relative;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1rem;
    padding: 40px;
}
.button_section{
    margin: auto;
    margin-top: 30px;
    margin-bottom: 20px;
    
}

.login .btn-login, .verificationBox .btn-register, .resetPasswordBox .btn-reset {
    background-color: #00BBFF;
    border-color: #00BBFF;
    border-width: 0;
    color: #FFFFFF;
    display: block;
    margin: 0 auto;
    text-align: center;
    padding: 15px 0;
    text-transform: uppercase;
    font-weight: 600;
    width: 200px;
    margin: auto;
    border-radius: 25px;
}
.login_verify_button{
    font-size: 15px !important;
    color: #1fbafc !important;
    padding-right: 20px;
    cursor: pointer !important;
    border-right: 1px solid #1fbafc !important;
    margin-right: 20px !important;
}

.login_reset_button {
    cursor: pointer;
}
.form-control {
    display: block;
    width: 100%;
    height: calc(1.5em + .75rem + 2px);
    padding: .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 0px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
@media (min-width: 1200px){
.navbar-expand-xl .navbar-nav .nav-link {
    padding-right: .3rem;
    padding-left: .3rem;
}
}


</style>
<!-- Popup for Subscriber starts here -->
    <div class="modal fade" id="feedPopUp" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content popUpHeader">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{__('translate.join_our_newsletter')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="error"></div>
                        <form id="newsletterForm" action="#" method="post" onsubmit="return false;">
                            @csrf
                            <div class="input-group" style="padding-bottom: 4px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-alt"></i></span>
                                </div><input type="text" class="form-control" name="name" placeholder="{{__('translate.form.name')}}">
                            </div>
                            <div class="input-group" style="padding-bottom: 4px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
                                </div><input type="Email" class="form-control" name="email" placeholder="{{__('translate.form.email')}}">
                            </div>
                            <div class="input-group" style="padding-bottom: 4px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-mobile-alt"></i></span>
                                </div><input type="text" class="form-control" name="mobile_no" placeholder="{{__('translate.form.phone')}}">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="newslettersubscribe()">{{__('translate.subscribe')}}&nbsp;&nbsp;<i id="newsletterFormSpinner" class="fa fa-spinner fa-spin fa-2x scollerIcon"></i></button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade login" id="loginModal">
        <div class="modal-dialog login animated modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="loginTitle" style="display: none;">{{__('translate.form.login_with')}}</h1>
                    <h1 class="modal-title" id="registerTitle" style="display: none;">{{__('translate.form.register_with')}}</h1>
                    <h1 class="modal-title" id="verifyTitle" style="display: none;">{{__('translate.form.verify_with')}}</h1>
                    <h1 class="modal-title" id="resetTitle" style="display: none;">{{__('translate.form.reset_password')}}</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="box">
                        <div class="content">
                            <div class="form loginBox">
                                <div class="error"></div>
                                <form id= "loginForm" method="post" action="" accept-charset="UTF-8" onsubmit="return false;">
                                    <input class="form-control" type="text" placeholder="{{__('translate.form.email')}} / {{__('translate.form.phone')}}" name="email">
                                    <input  class="form-control" type="password" placeholder="{{__('translate.form.password')}}" name="password">
                                    <div class="row pb-3" style="display:none;" id="logoutalldevice">
                                        <div class="col-md-12">
                                            <input type="checkbox" name="logoutalldevice" ><label for="logoutalldevice">{{__('translate.logout_all_device')}}</label>
                                        </div>
                                    </div>
                                    <div class="row pb-3">
                                        <div class="button_section">
                                            <button class="btn btn-default btn-login" type="submit">{{__('translate.login')}}&nbsp;&nbsp;<i class="fa fa-spinner fa-spin fa-2x scollerIcon"></i></button>
                                        </div>
                                    </div>
                                   
                                    <div class="row pb-3">                                       
                                            <a class="login_verify_button" onclick="showVerificationForm()">{{__('translate.form.email')}} / {{__('translate.form.phone')}} {{__('translate.form.verify')}}</a>
                                        
                                            <a class="login_reset_button"  onclick="showresetPasswordForm()"> {{__('translate.form.reset_password')}}</a>                                     
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="content registerBox" style="display:none;">
                            <div class="form">
                                <div class="error"></div>
                                <form id="formRegister" method="" html="{:multipart=>true}" data-remote="true" action="" accept-charset="UTF-8" onsubmit="return false;">
                                    @csrf
                                    <div class="row pb-3">
                                        <div class="col-md-12"><input  class="form-control" type="text" placeholder="{{__('translate.form.name')}}" name="name"></div>
                                        <div class="col-md-12"><input  class="form-control" type="text" placeholder="{{__('translate.form.phone')}}" name="mobile_no"></div>
                                        <div class="col-md-12"><input class="form-control" type="email" placeholder="{{__('translate.form.email')}}" name="email"></div>
                                        <div class="col-md-12"><input  class="form-control" type="password" placeholder="{{__('translate.form.password')}}" name="password"></div>
                                        <div class="col-md-12"><input  class="form-control" type="password" placeholder="{{__('translate.form.retype_password')}}" name="password_confirmation"></div>
                                        <div class="col-md-12">
                                            <select class="form-control" name="study_level" style="color: #6d6d6d; margin-bottom: 5px;">
                                                <option value="">{{__('translate.form.select_study_level')}}</option>
                                                @foreach($studyLevel as $level)
                                                    <option value="{{$level->study_level_id}}">{{$level->study_level_desc}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <select class="form-control" name="course_id" style="color: #6d6d6d; margin-bottom: 5px;">
                                                <option value="">{{__('translate.form.select_course')}}</option>
                                                 @foreach($courseLevel as $level)
                                                    <option value="{{$level->course_id}}">{{$level->course_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                             <select class="form-control" name="state_id" style="color: #6d6d6d; margin-bottom: 5px;">
                                                <option value="">{{__('translate.form.select_state')}}</option>
                                                 @foreach($stateList as $level)
                                                    <option value="{{$level->state_id}}">{{$level->state_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <select class="form-control" name="preparation_mode" style="color: #6d6d6d; margin-bottom: 5px;">
                                                <option value="">{{__('translate.form.select_preparation_mode')}}</option>
                                                 @foreach($courseMedium as $level)
                                                    <option value="{{$level->course_medium_id}}">{{$level->course_medium_desc}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row pb-3">
                                        <div class="button_section">
                                            <button class="btn btn-default btn-register" type="submit">{{__('translate.form.create_account')}}&nbsp;&nbsp;<i class="fa fa-spinner fa-spin fa-2x scollerIcon"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="content verificationBox" style="display:none;">
                            <div class="form container">
                                <div class="error"></div>
                                <div class="row pb-3">
                                    <div class="col-md-4">
                                        <form id= "emailVerificationForm" method="" action="" accept-charset="UTF-8" onsubmit="return false;">
                                            @csrf
                                            <label class="text-center">{{__('translate.form.email')}} {{__('translate.form.verify')}}</label>
                                            <input class="form-control" type="text" placeholder="{{__('translate.form.email')}}" name="email" required="">
                                            <input class="form-control" type="text" placeholder="{{__('translate.form.security_code_received')}}" name="otp">
                                            <button id="verifySecurity"  class="btn btn-default btn-login my-1" type="button">{{__('translate.form.verify')}}&nbsp;&nbsp;<i class="fa fa-spinner fa-spin fa-2x scollerIcon"></i></button>
                                            <button id="resendSecurity" type="button" class="btn btn-default btn-register my-1">{{__('translate.form.send_security')}}&nbsp;&nbsp;<i class="fa fa-spinner scollerIcon"></i></button>
                                        </form>
                                    </div>
                                    <div class="col-md-6">
                                        <form id= "phoneVerificationForm" method="" action="" accept-charset="UTF-8" onsubmit="return false;">
                                            @csrf
                                            <label class="text-center">{{__('translate.form.phone')}} {{__('translate.form.verify')}}</label>
                                            <input class="form-control" type="text" placeholder="{{__('translate.form.phone')}}" name="mobile_no">
                                            <input class="form-control" type="text" placeholder="{{__('translate.form.otp_received')}}" name="otp">
                                            <button id="verifyOtp"  class="btn btn-default btn-login my-1" type="button">{{__('translate.form.verify')}}&nbsp;&nbsp;<i class="fa fa-spinner fa-spin scollerIcon"></i></button>
                                            <button id="resendOtp" type="button" class="btn btn-default btn-register my-1">{{__('translate.form.send_otp')}}&nbsp;&nbsp;<i class="fa fa-spinner fa-spin scollerIcon"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="content resetPasswordBox" style="display:none;">
                            <div class="form container">
                                <div class="error"></div>
                                <div class="row pb-3">
                                    <div class="col-md-12">
                                        <form id="forgatePaaswordForm" action="{{route('password.email')}}" method="POST" onsubmit="return false;">
                                            @csrf
                                            <label class="text-center">{{__('translate.form.email')}}</label>
                                            <input class="form-control" type="email" placeholder="{{__('translate.form.email')}}" name="email" required="">
                                            <button class="btn btn-default btn-reset" type="submit">{{__('translate.form.reset_password')}}&nbsp;&nbsp;<i class="fa fa-spinner scollerIcon"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--            
        <button id="modalActivate" type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalPreview">
        SEARCH
    </button>
    <div class="modal fade right" id="exampleModalPreview" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
                    <div class="modal-dialog-full-width modal-dialog momodel modal-fluid" role="document">
                        <div class="modal-content-full-width modal-content ">
                            <div class=" modal-header-full-width   modal-header text-center">
                                <h5 class="modal-title w-100 text-white" id="exampleModalPreviewLabel">TYPE HERE TO SEARCH IN THIS WEBSITE</h5>
                                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                                    <span style="font-size: 1.3em;" aria-hidden="true" class="text-white">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center pt-5">
                                <div class="input-group" style="padding-bottom: 4px; padding-bottom: 4px; width: 100%; margin: 0 auto; max-width: 1100px;">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning" id="basic-addon1"><i class="fas fa-search-plus"></i></span>
                                    </div><input type="text" name="searchText" placeholder="TYPE HERE TO SEARCH" class="p-4" style="width: 86%; margin: 0 0 auto; border: 0;">
                                    <div class="col-lg-12 pt-5">
                                        <button type="button" class="btn btn-warning btn-md btn-rounded p-3" style="width: 43%;">SEARCH</button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer-full-width  modal-footer">
                                <button type="button" class="btn btn-danger btn-md btn-rounded" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>-->
    <!-- Popup for registration form ends here -->
    <div class="feed">
        <a href="#" data-toggle="modal" data-target="#feedPopUp" onclick="triggerRestAll()">{{__('translate.newsletter')}}</a>
    </div>
    <!-- Floating newsletter ends here -->
    <!-- ======= Hero Section ======= -->
    <!--            <section id="hero">
                    <div class="hero-container" data-aos="fade-up">
                        <h1>You are at the right place and you will succeed for sure</h1>
                        <h2>A team of talanted TUTOR and Institution</h2>
                        <a href="#testimonials" class="btn-get-started scrollto">Get Started</a>
                    </div>
                </section>-->
    <!-- End Hero