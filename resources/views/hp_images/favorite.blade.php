@extends('layouts.front')
@section('content')

      <div class="container">

        <div class="card-contents">
          <h2 class="text-title">Favorite member page</h2>
            <div class="image-list-area">
                
              @foreach ($favoriteItems as $favoriteItem) 
              <div class="image-list">
                  <img src ="{{ $favoriteItem->image_url }}" class="blog-image">
                 
                <div class="staff-name">
                    <a href="{{ action('HpImagesController@show', ['id' => $favoriteItem->id]) }}">more!</a>
                </div>
             </div>
             @endforeach
        </div>
        
        <div class="paging-area">
          <div class="d-flex justify-content-center">
              {{ $favoriteItems->links() }}
          </div>
        </div> 
        
      </div>
@endsection