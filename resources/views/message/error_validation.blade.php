@if (count($errors) > 0)
   <div class = "alert alert-danger" style="padding: 10px;margin-bottom: 0px;">
      <ul style="margin: 0;list-style-type: none;padding: 0px;">
         @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
         @endforeach
      </ul>
   </div>
@endif