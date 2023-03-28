@extends('frontend.layouts.master')
@section('page_content')
    <section id="support-page-start">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="support-heading text-center">
                                <h3>Let’s Connect</h3>
                                <p>Join us as we virtually alter the course of manual operations.<br> Drop in your details below!</p>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="left-info mt-1">
                                <h3>Contact Information</h3>
                                <ul class="row">
                                    <li class="col-lg-12 col-md-6">
                                        <div class="info-img">
                                            <img src="assets/images/support-page-icon/whatsapp.png" alt="" class="img-responsive">
                                        </div>
                                        <div class="info-detail">
                                            <p><a href="#" target="_blank">+1(91) 123-456-7890</a></p>
                                        </div>
                                    </li>
                                    <li class="col-lg-12 col-md-6">
                                        <div class="info-img">
                                            <img src="assets/images/support-page-icon/messages.svg" alt="" class="img-responsive">
                                        </div>
                                        <div class="info-detail">
                                            <p>connect@saitalogistics.com</p>
                                        </div>
                                    </li>
                                    <li class="col-lg-12 col-md-12">
                                        <div class="info-img">
                                            <img src="assets/images/support-page-icon/map.svg" alt="" class="img-responsive">
                                        </div>
                                        <div class="info-detail">
                                            <p>ABCD-123, Lorem Ipsum is the dummy texting... 201301</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="contact-us-form">
                                <form action="">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" placeholder="Enter name here">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="phoneno">Phone No.</label>
                                                <input type="text" class="form-control" placeholder="Enter phone no. here">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control" placeholder="Organization Email Address">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="Company">Company</label>
                                                <input type="text" class="form-control" placeholder="Organization name">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="message">Message</label>
                                                <textarea type="text" class="form-control" placeholder="Explain your project here"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="contact-btn">
                                                <button type="submit" class="btn btn-default">Submit
                                                    Details</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
