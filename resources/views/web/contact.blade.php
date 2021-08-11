@extends('web.layouts.app')
@section('content')

<div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="page-banner ovbl-dark" style="background-image:url({{ asset('web/assets/images/banner/banner2.jpg') }});">
        <div class="container">
            <div class="page-banner-entry">
                <h1 class="text-white">Contact Us</h1>
             </div>
        </div>
    </div>
    <!-- Breadcrumb row -->
    <div class="breadcrumb-row">
        <div class="container">
            <ul class="list-inline">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>Contact Us</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb row END -->

    <!-- inner page banner -->
    <div class="page-banner contact-page">
        <div class="container-fuild">
            <div class="row m-lr0">
                <div class="col-lg-6 col-md-6 p-lr0 d-flex">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3448.1298878182047!2d-81.38369578541523!3d30.204840081824198!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88e437ac927a996b%3A0x799695b1a2b970ab!2sNona+Blue+Modern+Tavern!5e0!3m2!1sen!2sin!4v1548177305546" class="align-self-stretch d-flex" style="width:100%; width:100%; min-height: 300px;" allowfullscreen></iframe>
                </div>
                <div class="col-lg-6 col-md-6 section-sp2 p-lr30">
                    <form class="contact-bx ajax-form" action="http://educhamp.themetrades.com/demo/assets/script/contact.php">
                    <div class="ajax-message"></div>
                        <div class="heading-bx left p-r15">
                            <h2 class="title-head">Get In <span>Touch</span></h2>
                            <p>It is a long established fact that a reader will be distracted by the readable content of a page</p>
                        </div>
                        <div class="row placeani">
                            <div class="col-lg-6 ">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label>Your Name</label>
                                        <input name="name" type="text" required class="form-control valid-character">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group"> 
                                        <label>Your Email Address</label>
                                        <input name="email" type="email" class="form-control" required >
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label>Your Phone</label>
                                        <input name="phone" type="text" required class="form-control int-value">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label>Subject</label>
                                        <input name="subject" type="text" required class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label>Type Message</label>
                                        <textarea name="message" rows="4" class="form-control" required ></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="g-recaptcha" data-sitekey="6Lf2gYwUAAAAAJLxwnZTvpJqbYFWqVyzE-8BWhVe" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
                                        <input class="form-control d-none" style="display:none;" data-recaptcha="true" required data-error="Please complete the Captcha">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button name="submit" type="submit" value="Submit" class="btn button-md"> Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- inner page banner END -->
</div>
@endsection