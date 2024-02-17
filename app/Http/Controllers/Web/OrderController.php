<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ValueService;
use App\Models\Selectedservice;
use Illuminate\Support\Facades\DB; 
use File;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\Web\Point\StorePointRequest;
use App\Http\Requests\Web\Point\UpdatePointRequest;
use App\Models\Pointtransfer;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Api\StorageController;
class OrderController extends Controller
{ 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $list =Selectedservice::with('expert','client','service')->orderByDesc('form_state')->get();
      
       return view('admin.order.show', ['selectedservices' => $list]);     
    }
  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('admin.order.create');
    }
  
    /**
     * Store a newly created resource in storage.
     */
    
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePointRequest $request)
    {
      $formdata = $request->all();
      // return redirect()->back()->with('success_message', $formdata);
      $validator = Validator::make(
        $formdata,
        $request->rules(),
        $request->messages()
      );
  
      if ($validator->fails()) {
        /*
                          return  redirect()->back()->withErrors($validator)
                          ->withInput();
                          */
        // return response()->withErrors($validator)->json();
        return response()->json($validator);  
      } else {
        $newObj = new Selectedservice;
        $newObj->count = $formdata['count'];
        $newObj->countbefor = isset($formdata["countbefor"]) ? $formdata["countbefor"] : 0;
        $newObj->price = $formdata['price'];
       // $newObj->pricebefor =  $formdata['price'];
        
        $newObj->is_active = isset($formdata["is_active"]) ? 1 : 0;
        //$newObj->token = $formdata['token'];
        $newObj->save();
  /*
        if ($request->hasFile('image')) {
          $file = $request->file('image');
          // $filename= $file->getClientOriginalName();               
          $this->storeImage($file, $newObj->id);
          //  $this->storeImage( $file,2);
        }
  */
        return response()->json("ok");
      }
    }
  
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      //
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    //  $url =url(Storage::url($this->path)).'/';
      $object = Selectedservice::find($id);
       /*
      if( $object->image !="" ){
        $object->fullpathimg= $url.$object->image;
      }
      */
      
      return view('admin.order.edit', ['order' => $object]);
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePointRequest $request, $id)
    {
      $formdata = $request->all();
      //validate
      $validator = Validator::make(
        $formdata,
        $request->rules(),
        $request->messages()
      );
      if ($validator->fails()) {
        /*
          return redirect('/cpanel/users/add')
          ->withErrors($validator)
                      ->withInput();
                      */
                      return response()->json($validator);
  
      } else {
       // $imagemodel = Expert::find($id);
       /*
        if ($request->hasFile('image')) {
          $file= $request->file('image');
                 // $filename= $file->getClientOriginalName();                
       $this->storeImage( $file,$id);
         }
         */ 
        Selectedservice::find($id)->update([
          'count'=>  $formdata['count'],
          'price'=>  $formdata['price'],
          'pricebefor' => $formdata['price'],    
          'countbefor' => isset($formdata["countbefor"]) ? $formdata["countbefor"] : 0,            
        'is_active' => isset($formdata['is_active']) ? 1 : 0         
        ]);
      
        //save image
        return response()->json("ok");
        
      }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
      $object = Selectedservice::find($id); 
      if (!($object === null)) {
  
       
      
  Selectedservice::find($id)->delete();
  
        
      }
      return redirect()->route('order.index');
      // return  $this->index();
      //   return redirect()->route('users.index');
  
    }

}
