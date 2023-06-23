

@if(session()->has('success'))
<div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show"
  class="position-absolute top-0 start-50 translate-middle-x mt-5" style="z-index: 100000000">
  
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"></span>
        </button>
    </div>
</div>



@elseif ($errors->any())
<div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show"
  class="position-absolute top-0 start-50 translate-middle-x mt-5" style="z-index: 100000000">
  
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Please check the following errors:<br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"></span>
        </button>
    </div>
</div>
@endif