@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">CMS HOME Master</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#"> CMS</a></li>
                <li class="breadcrumb-item"><span> Home Master</span></li>
             </ul>
          </div>
       </div>
    </div>
    <div class="page-content">
       <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            @if(Session::has('message'))
            <div class="alert {{ Session::get('alert-class') }} text-center">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>{{ Session::get('message') }}</strong>
            </div>
        @endif
             <div class="card">
             @include('message.error_validation')
                <?php 
                $content_id = isset($content->id) ? $content->id : 0;
                $status = isset($content->page_status) ? $content->page_status : 0;
                if($content_id!=0){
                    $req = '';
                    $url = route('cms.about.update');
                }else{
                    $req = 'required';
                    $url = route('cms.about.store');
                }
                ?>
               <form action="{{route('cms.home.update')}}" method="post" name="user_frm" id="user_frm" enctype="multipart/form-data">
                @csrf
                   <div class="card-body">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>Home Top Section:</h3>
                                 </div>
                               </div>
                                                                
                                <div class="form-group col-md-6 col-12">
                                   <input type="hidden" value="{{$page_content->id}}" name="id" id="id">
                                     <label>Title*</label>
                                     <input class="form-control" value="{{(isset($page_content->page_title) ? $page_content->page_title : null)}}" type="text" name="page_title" id="name" required >
                                </div>                  
                                
                               
                                <div class="form-group col-md-6 col-12">
                                     <label>Video Link*</label>
                                     <input class="form-control" value="{{(isset($page_content->page_image) ? $page_content->page_image : null)}}" type="text" name="page_image" id="name" required >
                                </div>
                                
                                <div class="form-group col-md-12 col-12">
                                     <label>Text*</label>
                                     <textarea class="form-control ckeditor"  name="page_content" id="page_content">{{(isset($page_content->page_content) ? $page_content->page_content : null)}}</textarea>
                                </div>

                               
                           </div>
                         </div>
                         <hr>
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="page-btns">
                              <div class="form-group text-center custom-mt-form-group">
                                 <button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Save</button>
                                 
                                 <a class="btn btn-secondary orng-btn" style="font-size:inherit;" href="{{url('admin/cms/about')}}"><i class="fa fa-dot-circle"></i> Reset</a>
                              </div>
                            </div>
                        </div>

        

                        
                     </div>
                   </form>


                   <form action="{{route('cms.home.update1')}}" method="post" name="user_frm" id="user_frm" enctype="multipart/form-data">
                @csrf
                   <div class="card-body">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>How it work Section:</h3>
                                 </div>
                               </div>
                                                                
                                <div class="form-group col-md-4 col-12">
                                   <input type="hidden" value="{{$page_content1[0]->id}}" name="id1" id="id">
                                     <label>Title*</label>
                                     <input class="form-control" value="{{(isset($page_content1[0]->page_title) ? $page_content1[0]->page_title : null)}}" type="text" name="page_title1" id="name" required >
                                </div>                  
                                
                               
                                <div class="form-group col-md-4 col-12">
                                     <label>icon*</label>
                                     <input class="form-control" type="file" name="page_image1" id="page_image1"  >
                                </div>
                                
                                <div class="form-group col-md-4 col-12">
                                     <label>Text*</label>
                                     <textarea class="form-control"  name="page_content1" id="page_content">{{(isset($page_content1[0]->page_content) ? $page_content1[0]->page_content : null)}}</textarea>
                                </div>


                                <div class="form-group col-md-4 col-12">
                                   <input type="hidden" value="{{$page_content1[1]->id}}" name="id2" id="id">
                                     <label>Title*</label>
                                     <input class="form-control" value="{{(isset($page_content1[1]->page_title) ? $page_content1[1]->page_title : null)}}" type="text" name="page_title2" id="name" required >
                                </div>                  
                                
                               
                                <div class="form-group col-md-4 col-12">
                                     <label>icon*</label>
                                     <input class="form-control" type="file" name="page_image2" id="page_image3"  >
                                </div>
                                
                                <div class="form-group col-md-4 col-12">
                                     <label>Text*</label>
                                     <textarea class="form-control"  name="page_content2" id="page_content2">{{(isset($page_content1[1]->page_content) ? $page_content1[1]->page_content : null)}}</textarea>
                                </div>


                                <div class="form-group col-md-4 col-12">
                                   <input type="hidden" value="{{$page_content1[2]->id}}" name="id3" id="id">
                                     <label>Title*</label>
                                     <input class="form-control" value="{{(isset($page_content1[2]->page_title) ? $page_content1[2]->page_title : null)}}" type="text" name="page_title3" id="name" required >
                                </div>                  
                                
                               
                                <div class="form-group col-md-4 col-12">
                                     <label>icon*</label>
                                     <input class="form-control" type="file" name="page_image3" id="page_image3"  >
                                </div>
                                
                                <div class="form-group col-md-4 col-12">
                                     <label>Text*</label>
                                     <textarea class="form-control"  name="page_content3" id="page_content">{{(isset($page_content1[2]->page_content) ? $page_content1[2]->page_content : null)}}</textarea>
                                </div>


                                <div class="form-group col-md-4 col-12">
                                   <input type="hidden" value="{{$page_content1[3]->id}}" name="id4" id="id">
                                     <label>Title*</label>
                                     <input class="form-control" value="{{(isset($page_content1[3]->page_title) ? $page_content1[3]->page_title : null)}}" type="text" name="page_title4" id="name" required >
                                </div>                  
                                
                               
                                <div class="form-group col-md-4 col-12">
                                     <label>icon*</label>
                                     <input class="form-control" type="file" name="page_image4" id="page_image4"  >
                                </div>
                                
                                <div class="form-group col-md-4 col-12">
                                     <label>Text*</label>
                                     <textarea class="form-control"  name="page_content4" id="page_content">{{(isset($page_content1[3]->page_content) ? $page_content1[3]->page_content : null)}}</textarea>
                                </div>

                               
                           </div>
                         </div>
                         <hr>
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="page-btns">
                              <div class="form-group text-center custom-mt-form-group">
                                 <button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Save</button>
                                 
                                 <a class="btn btn-secondary orng-btn" style="font-size:inherit;" href="{{url('admin/cms/about')}}"><i class="fa fa-dot-circle"></i> Reset</a>
                              </div>
                            </div>
                        </div>

        

                        
                     </div>
                   </form>


                <form action="{{route('cms.home.update2')}}" method="post" name="user_frm" id="user_frm" enctype="multipart/form-data">
                @csrf
                   <div class="card-body">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>Home Bottom Section:</h3>
                                 </div>
                               </div>
                                                                
                                <div class="form-group col-md-6 col-12">
                                   <input type="hidden" value="{{$page_content2->id}}" name="id" id="id">
                                     <label>Title*</label>
                                     <input class="form-control" value="{{(isset($page_content2->page_title) ? $page_content2->page_title : null)}}" type="text" name="page_title" id="name" required >
                                </div>                  
                                
                               
                                <div class="form-group col-md-6 col-12">
                                     <label>Image*</label>
                                     <input class="form-control"  type="file" name="page_image" id="name" required >
                                </div>
                                
                                <div class="form-group col-md-12 col-12">
                                     <label>Text*</label>
                                     <textarea class="form-control ckeditor"  name="page_content" id="page_content">{{(isset($page_content2->page_content) ? $page_content2->page_content : null)}}</textarea>
                                </div>

                               
                           </div>
                         </div>
                         <hr>

                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="page-btns">
                              <div class="form-group text-center custom-mt-form-group">
                                 <button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Save</button>
                                 
                                 <a class="btn btn-secondary orng-btn" style="font-size:inherit;" href="{{url('admin/cms/about')}}"><i class="fa fa-dot-circle"></i> Reset</a>
                              </div>
                            </div>
                        </div>

        

                        
                     </div>
                   </form>
                </div>
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