@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">User Profile</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">CMS Management</a></li>
                <li class="breadcrumb-item"><span> {{$page_content->page_title}}</span></li>
             </ul>
          </div>
       </div>
    </div>
    <div class="page-content">
       <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
             <div class="card">
                @if(Session::has('message'))
            <div class="alert {{ Session::get('alert-class') }} text-center">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>{{ Session::get('message') }}</strong>
            </div>
        @endif
               <form action="{{route('cms.page.update')}}" method="post" name="user_profile" id="user_profile" enctype="multipart/form-data" >
                   <div class="card-body">
                    @csrf
                         <input type="hidden" name="page_name" value="{{$page_content->page_name}}">
                         <input type="hidden" name="id" value="{{$page_content->id}}">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                             <div class="row">
                                <div class="form-group col-md-2 col-4">
                                     <div class="user-detail">
                                         <p>Content:</p>
                                     </div>
                                </div>
                                <div class="form-group col-md-7 col-8">
                                     <div class="user-detail">
                                         <textarea type="text" name="content" class="form-control ckeditor" placeholder="">{{$page_content->page_content}}</textarea>
                                     </div>
                                </div>
                             </div>
                         </div>

                         <hr>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="page-btns">
                              <div class="form-group text-center custom-mt-form-group">
                                <button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Save</button>
                                 <button class="btn btn-secondary orng-btn" type="reset"><i class="fa fa-dot-circle"></i> Reset</button>
                              </div>
                            </div>
                        </div>
                     </div>
                   </form></div>
               
             </div>
          </div>
       </div>
    </div>

    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
@endsection