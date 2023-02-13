@extends('user.layout')
@section('content')
<div class="wrapperdiv">
    @if($campaign)
    <div class="row pb-5 " >
        <div class="col-4"></div>
        <div class="col-4">
        <div class="card" style="width: 35rem;">
            <img src="{{ asset( 'uploads/'.$campaign->img ) }}" class="card-img-top">
            <div class="card-body">
            <h5 class="card-title">{{ $campaign->title }}</h5>
            <p class="card-text" >{{!!$campaign->Description!!}}</p>
            <div>URL :  <a href= "{{ asset('campaign/'.$campaign->unique_id ) }}"> {{ asset('campaign/'.$campaign->unique_id ) }}</a></div>
            </div>
            </div> 
        </div>

    


    </div> 
    @endif
                  
</div>
@endsection 

