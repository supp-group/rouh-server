<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pointtransfer;
use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\Web\Pointtransfer\StorePointtransferRequest;
use App\Http\Requests\Web\Pointtransfer\UpdatePointtransferRequest;
use App\Http\Requests\Web\Pointtransfer\SavePullRequest;
use App\Models\Cashtransfer;
use App\Models\Client;
use App\Models\Expert;


class PointTransferController extends Controller
{
  public $path = 'media/pointstransfers';
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $list = DB::table('pointstransfers')->get();
    return view('admin.pointtransfer.show', ['pointstransfers' => $list]);
    //return response()->json($users);
  }
  public function pulls()
  {
    $list = Pointtransfer::with('cashtransfers', 'selectedservices')
      ->where('side', 'to-expert')->get();

    return view('admin.operation.pulls', ['transfers' => $list]);


  }
  public function createpull()
  {
    /*
    $list = Pointtransfer::with( 'cashtransfers', 'selectedservices')
     ->where('side','to-expert')->get();      
    */
    return view('admin.operation.create');


  }

  public function savepull(SavePullRequest $request)
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
      $newObj = new Pointtransfer;
      $newObj->count = $formdata['count'];
      $newObj->countbefor = isset ($formdata["countbefor"]) ? $formdata["countbefor"] : 0;
      $newObj->price = $formdata['price'];
      // $newObj->pricebefor =  $formdata['price'];

      $newObj->is_active = isset ($formdata["is_active"]) ? 1 : 0;
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
  public function getbyside(Request $request)
  {
    if (isset ($request->sel_side)) {
      $side = $request->sel_side;
      if ($side == 'expert') {
        return response()->json($this->getexperts());
      } else if ($side == 'client') {
        return response()->json($this->getclients());
      } else {
        return response()->json("error",422);
      }
    } else {
      return response()->json("error_notexist",422);
    }

  }

  public function getexperts()
  {
    $DBList = Expert::select(
      'id',
      'first_name',
      'last_name',
      'cash_balance'
    )->get();
    // map
    $List = $DBList->map(function ($item) {

      return [
        'id' => $item->id,
        'name' => $item->full_name,
        'balance' => $item->cash_balance,
      ];
    });
    //end map


    return $List;
  }
  public function getclients()
  {
    $DBList = Client::select(
      'id',
      'user_name',
      'points_balance'
    )->get();
    // map
    $List = $DBList->map(function ($item) {

      return [
        'id' => $item->id,
        'name' => $item->user_name,
        'balance' => $item->points_balance,
      ];
    });
    //end map
    return $List;
  }
  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('admin.pointtransfer.add');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $formdata = $request->all();
    $validator = Validator::make(
      $formdata,
      $request->rules(),
      $request->messages()
    );

    if ($validator->fails()) {

      return redirect()->back()->withErrors($validator)
        ->withInput();

    } else {

      $newObj = new Pointtransfer;
      $newObj->point_id = $formdata['point_id'];
      $newObj->client_id = $formdata['client_id'];
      $newObj->expert_id = $formdata['expert_id'];
      $newObj->service_id = $formdata['service_id'];
      $newObj->count = $formdata['count'];
      $newObj->status = $formdata['status'];
      $newObj->selectedservice_id = $formdata['selectedservice_id'];



      $newObj->save();


      return redirect()->back()->with('success_message', 'user has been Added!');
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
    $object = DB::table('pointstransfers')->find($id);

    //
    return view('admin.pointtransfer.edit', ['pointtransfer' => $object]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $id)
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
      return redirect()->back()->withErrors($validator)
        ->withInput();

    } else {
      // $imagemodel = Pointtransfer::find($id);
      // $oldimage = $imagemodel->image;
      Pointtransfer::find($id)->update([
        'point_id' => $formdata['point_id'],
        'client_id' => $formdata['client_id'],
        'expert_id' => $formdata['expert_id'],
        'service_id' => $formdata['service_id'],
        'count' => $formdata['count'],
        'status' => $formdata['status'],
        'selectedservice_id' => $formdata['selectedservice_id'],

      ]);

    }
    return redirect()->back()->with('success_message', 'user has been Updated!');
  }
  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    $object = Pointtransfer::find($id);
    if (!($object === null)) {

      $item1 = Cashtransfer::where('pointtransfer_id', $id)->first();

      if (!($item1 === null)) {
        // disable expert account
        /*
        Pointtransfer::find($id)->update([
         "is_active" => 0
       ]);
       */
      } else {
        //delete object
        Pointtransfer::find($id)->delete();

      }
    }
    return redirect()->route('admin.point.show');
    // return  $this->index();
    //   return redirect()->route('users.index');

  }

}
