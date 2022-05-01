@if(Auth::user()->photo)
<div >
  <img src="{{ route('user.avatar',['filename'=>Auth::user()->photo]) }}" class="avatar" />
</div>
@else  
<div >
  <img src="{{ asset('img/brand/settings3.png') }}"/>
</div>                              
@endif