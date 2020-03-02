@extends('layouts.front')
@section('content')

      <div class="container">

        <div class="card-contents">
          <h2 class="text-title">All Image</h2>
            <div class="image-list-area">
                
              @foreach ($hpImages as $hpImage)  
              <div class="image-list">
                  <img src ="{{ $hpImage->image_url }}" class="blog-image">
                 
                <div class="staff-name">
                    <a href="{{ action('HpImagesController@show', ['id' => $hpImage->id]) }}">more!</a>
                </div>
             </div>
             @endforeach
        </div>
        
        <div class="paging-area">
          <div class="d-flex justify-content-center">
              {{ $hpImages->links() }}
          </div>
        </div>  

      </div>
      
@endsection