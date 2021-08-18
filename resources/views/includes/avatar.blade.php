@if(Auth::user()->photo)
<div >
  <img src="{{ route('user.avatar',['filename'=>Auth::user()->photo]) }}" class="avatar" />
</div>                              
@endif