@extends('layouts.front')
@section('content')    

      <div class="container">
        <div class="left-contents">
          <div class="card-contents">
              <h2 class="text-title">画像データ詳細</h2>
              <div class="staff-list-area">
                  <img src={{ $items->image_url }} class="more-image">
              </div>
            </div>
        </div>
        
        <div class="right-contents">
          <div class="card-contents">
            <h2 class="text-title">More data</h2>
            <p class = "blog-url-area"><a href = {{ $items->blog_url }} >Blog URL はこちら</a></p>
            
            <form action= "{{ action('HpImagesController@store') }}" method="post" enctype="multipart/form-data">
              <div class="form-group row">
                    <h3><label class="col-md-2" for="id">推しメンですか？</label></h3>
                <div class="col-md-10">
                  <input type="hidden" value="{{ $items->id }}" name="id">
                    <label><input type="checkbox" class="savedata" name="check" value="true" 
                    {{ $items->is_favorite == true ? 'checked' :  '' }}> 
                    はい、推しメンです！</label>
                </div>

              </div>
              @csrf
              <input type="submit" class="save-button" value="保存">
            
            </form>
            
          </div>
        </div>
      </div>
@endsection 