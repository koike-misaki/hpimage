<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Weidner\Goutte\GoutteFacade as GoutteFacade;
use App\HpImage;

class HpImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hpImages = HpImage::orderBy('update_time', 'desc')->simplePaginate(21);
        // $hpImages = HpImage::paginate(20);
        return view('hp_images.index', compact('hpImages'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $favoriteId = ($request->id);
        $checkItems = HpImage::find($favoriteId);
        
        if ($request->check == "true") {
            \DB::table('hp_images')
            ->where('id', $favoriteId)
            ->update([
                'is_favorite' => true
            ]);
        }else{
            \DB::table('hp_images')
            ->where('id', $favoriteId)
            ->update([
                'is_favorite' => false
                ]);
        }
        
        return redirect('hp_images/message?id='.$favoriteId);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
    public function show(Request $request)
    {
        $id = $request->input('id');
        $items = HpImage::find($id);
        return view('hp_images.more', compact('items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function favorite()
    {
        
        $favoriteItems = HpImage::where('is_favorite', true)->orderBy('update_time', 'desc')->simplePaginate(21);
        
        // $items = HpImage::orderBy('update_time', 'desc')->get();
        // foreach ($items as $item) {
        //     if ($item->is_favorite == true ) {
        //         dd($item->is_favorite);
        //         $favoriteItems[] = $item;
        //     }
        // }
        
        if (empty($favoriteItems)) {
            abort(404);    
        }
        
        return view('hp_images/favorite', compact('favoriteItems'));
    }
}
