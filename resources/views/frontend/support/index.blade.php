@extends('frontend.layouts.master')
@section('page_content')
        
            <section id="support-page-start">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="row">
                        {!! $cms->page_content !!}
                        <div class="col-md-12 col-lg-6">
                            <div class="contact-us-form">
                                <form action="">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="name">Name*</label>
                                                <input type="text" class="form-control" placeholder="Enter name here" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="phoneno">Phone No.*</label>
                                                <input type="number" class="form-control" placeholder="Enter phone no. here" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="email">Email*</label>
                                                <input type="email" class="form-control" placeholder="Organization Email Address" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="Company">Company*</label>
                                                <input type="text" class="form-control" placeholder="Organization name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="message">Message</label>
                                                <textarea type="text" class="form-control" placeholder="Explain your project here" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="contact-btn">
                                                <button type="submit" class="btn btn-default">Submit
                                                    </button>
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
