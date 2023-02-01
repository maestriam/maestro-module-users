<div>    
    
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    
    @include('users::partials.account-inputs')
    
    @include('users::partials.user-inputs')    

</div>