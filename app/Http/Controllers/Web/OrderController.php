<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Reason;
use Illuminate\Http\Request;
use App\Models\ValueService;
use App\Models\Selectedservice;
use Illuminate\Support\Facades\DB; 
use File;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Carbon;

use App\Http\Requests\Web\Order\UpdateFormStateRequest;
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
    //  return  $list;
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
    public function store(Request $request)
    {
     
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
      $object =Selectedservice::with(['expert','client',       
      'valueservices' => function ($q){
        $q->orderByDesc('ispersonal');
    }
     ] )->find($id);
      $reasons=Reason::where('type','form')->get();
     //return dd($object);
      return view('admin.order.edit', ['selectedservice' => $object,'reasons'=> $reasons]);
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFormStateRequest $request, $id)
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
        
        DB::transaction(function ()use( $formdata,$id) {
      
        $reason=Reason::find($formdata['form_reject_reason']);
        
        Selectedservice::find($id)->update([
          'form_state'=>  $formdata['form_state'],
          'form_reject_reason'=>  $reason->content,              
        ]);
if($formdata['form_state']=='agree'){

  Pointtransfer::where('selectedservice_id',$id)
  ->where('state','wait')
  ->where('side','from-client')->update([
    'state'=> 'agree',                
  ]);
  $countpoint=Pointtransfer::where('selectedservice_id',$id)
  ->where('state','wait')
  ->where('side','from-client')->first()->count ;
  //add points to company
  
}else{
  //reject

}
        });
        
        return response()->json("ok");
        
      }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    
      return redirect()->route('order.index');
      // return  $this->index();
      //   return redirect()->route('users.index');
  
    }

}
