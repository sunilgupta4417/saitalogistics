@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">CMS About Master</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#"> CMS</a></li>
                <li class="breadcrumb-item"><span> About us Master</span></li>
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
               <form action="{{$url}}" method="post" name="user_frm" id="user_frm" enctype="multipart/form-data">
                @csrf
                   <div class="card-body">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>About Section:</h3>
                                 </div>
                               </div>
                                                                
                                <div class="form-group col-md-4 col-12">
                                   <input type="hidden" value="{{$content_id}}" name="id" id="id">
                                     <label>Title*</label>
                                     <input class="form-control" value="{{(isset($content->page_title) ? $content->page_title : null)}}" type="text" name="page_title" id="name" required >
                                </div>                  
                                
                               
                                <div class="form-group col-md-4 col-12">
                                     <label>Image*</label>
                                     <input class="form-control" type="file" {{$req}} name="page_image" id="page_image">
                                </div>
                                
                                <div class="form-group col-md-4 col-12">
                                     <label>Status*</label>
                                     <select class="form-control select" name="status" id="status">
                                        <option value="1" <?php echo ($status==1 ? 'selected' : '')?>>Active</option>
                                        <option value="0" <?php echo ($status== 0 ? 'selected' : '')?>>InActive</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12 col-12">
                                     <label>Text*</label>
                                     <textarea class="form-control ckeditor"  name="page_content" id="page_content">{{(isset($content->page_content) ? $content->page_content : null)}}</textarea>
                                </div>

                               
                           </div>
                         </div>
                         <hr>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="page-btns">
                              <div class="form-group text-center custom-mt-form-group">
                                 @if(checkAccess('manage-users','add_permission'))<button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Save</button>@endif
                                 
                                 <a class="btn btn-secondary orng-btn" style="font-size:inherit;" href="{{url('admin/cms/about')}}"><i class="fa fa-dot-circle"></i> Reset</a>
                              </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                             
                             <div class="col-md-12">    
                                <div class="x_content">
                                    <div class="table-responsive">
                                        <table class="responsive">
                                            <thead>
                                                <tr>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                    <th>Title</th>
                                                    <th>Content</th>
                                                    <th>Image</th>
                                                    <th>Active</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($page_content as $rowu)
                                            <tr>
                                                <td><a class="btn btn-primary" href="{{url('admin/cms/about')}}?id={{$rowu->id}}"> <i class="fa fa-pencil-alt"></i></a></td>
                                                <td><a class="btn btn-primary" href="{{url('admin/cms/about/delete',$rowu->id)}}" onclick="return confirm('Are you sure you want to delete this record?')"> <i class="fa fa-trash-alt"></i></a></td>
                                                <td>{{ $rowu->page_title }}</td>
                                                <td>{{substr($rowu->page_content, 0, 100)}}</td>
                                                <td><img src="{{asset('/assets/images/cms/'.$rowu->page_image)}}" style="width:100px"></td>
                                                <td>{{ ($rowu->page_status==1?'Yes':'No') }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        </table>
                                    </div>
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