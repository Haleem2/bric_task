@if(Session::has('error'))
<h2 class="alert alert-danger text-center">{{session('error')}}</h2>
@elseif(Session::has('success'))
<h2 class="alert alert-success text-center">{{session('success')}}</h2>
@endif