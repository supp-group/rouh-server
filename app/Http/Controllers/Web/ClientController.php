<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use File;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\Web\Client\StoreClientRequest;
use App\Http\Requests\Web\Client\UpdateClientRequest;
use App\Models\Pointtransfer;
use App\Models\Cashtransfer;
use App\Models\Expertfavorite;
use App\Models\Servicefavorite;
use App\Models\Selectedservice;
use App\Http\Controllers\Api\StorageController;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  //  public $path = 'media/clients';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $list = DB::table('clients')->get();
      return view('admin.client.show', ['clients' => $list]);
      //return response()->json($users);
  
    }
  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('admin.client.add');
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
       
        $newObj = new Client;
 
  $newObj->user_name = $formdata['user_name'];
  $newObj->password = $formdata['password'];
  $newObj->mobile = $formdata['mobile'];
  $newObj->email = $formdata['email'];
  $newObj->nationality = $formdata['nationality'];
  $newObj->birthdate = $formdata['birthdate'];
  $newObj->gender = $formdata['gender'];
  $newObj->marital_status = $formdata['marital_status'];
  $newObj->image = $formdata['image'];
  $newObj->points_balance = $formdata['points_balance'];
  $newObj->cash_balance =0;
  $newObj->cash_balance_todate = 0;
  $newObj->rates = 0;
  $newObj->record = $formdata['record'];
  $newObj->desc = $formdata['desc'];
  $newObj->call_cost = $formdata['call_cost'];
  //$newObj->token = $formdata['token'];
  
  
        $newObj->save();
        //save image
      //  $this->path = 'media/clients';
        $separator = '/';
        if ($request->hasFile('image')) {
          // $imagemodel->save();
          $image_tmp = $request->file('image');
          if ($image_tmp->isValid()) {
            $folderpath = $this->path . $separator;
            //Get image Extension
            $extension = $image_tmp->getClientOriginalExtension();
            //Generate new Image Name
  
            $now = Carbon::now();
            $imageName = rand(10000, 99999) . $newObj->id . '.' . $extension;
  
            if (!File::isDirectory($folderpath)) {
              File::makeDirectory($folderpath, 0777, true, true);
            }
            $imagePath = $folderpath . $imageName;
            //Upload the Image
            $manager = new ImageManager(new Driver());
  
            // read image from filesystem
            $image = $manager->read($image_tmp);
            //$image= $image->toWebp(75);
            $image->save($imagePath);
            //$fullpath= url($imagePath);
  
            Client::find($newObj->id)->update([
              "image" => $imageName
            ]);
  
            // if(File::exists($oldimagepath )){
            //   File::delete($oldimagepath );
            // }
          }
        }
  
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
      $object = DB::table('clients')->find($id);
  
      //
      return view('admin.client.edit', ['client' => $object]);
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
        $imagemodel = Client::find($id);
        $oldimage = $imagemodel->image;
        Client::find($id)->update([
          'user_name' => $formdata['user_name'],
          'password' => $formdata['password'],
          'mobile' => $formdata['mobile'],
          'email' => $formdata['email'],
          'nationality' => $formdata['nationality'],
          'birthdate' => $formdata['birthdate'],
          'gender' => $formdata['gender'],
          'marital_status' => $formdata['marital_status'],
       //   'image' => $formdata['image'],
      //    'points_balance' => $formdata['points_balance'],
       //   'cash_balance' => $formdata['cash_balance'],
        //  'cash_balance_todate' => $formdata['cash_balance_todate'],
        //  'rates' => $formdata['rates'],
          'record' => $formdata['record'],
          'desc' => $formdata['desc'],
          'call_cost' => $formdata['call_cost'],
       //   'token' => $formdata['token'],
          
        ]);
        //save image
 /*
        $separator = '/';
        if ($request->hasFile('image')) {
          // $imagemodel->save();
          $image_tmp = $request->file('image');
          if ($image_tmp->isValid()) {
            $folderpath = $this->path . $separator;
            //Get image Extension
            $extension = $image_tmp->getClientOriginalExtension();
            //Generate new Image Name
            $now = Carbon::now();
            $imageName = rand(10000, 99999) . $id . '.' . $extension;
            if (!File::isDirectory($folderpath)) {
              File::makeDirectory($folderpath, 0777, true, true);
            }
            $imagePath = $folderpath . $imageName;
            //Upload the Image
            $manager = new ImageManager(new Driver());
            // read image from filesystem
            $image = $manager->read($image_tmp);
            //$image= $image->toWebp(75);
            $image->save($imagePath);
            Client::find($id)->update([
              "image" => $imageName
            ]);
  
            //  delete old image
            $oldimagepath = $this->path . $separator . $oldimage;
            if (File::exists($oldimagepath)) {
              File::delete($oldimagepath);
            }
             
            return redirect()->back()->with('success_message', 'user has been Updated!');
          }
        }
*/
return redirect()->back()->with('success_message', 'user has been Updated!');
      }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
      $object = Client::find($id);
      if (!($object === null)) {
  
        //delete check related tables
        //   $item1= ExpertService::where('client_id',$id)->first();
        //   $item1= Expertfavorite::where('client_id',$id)->first();
        $item1 = Pointtransfer::where('client_id', $id)->first();
        $item2 = Cashtransfer::where('client_id', $id)->first();
        $item3 = Selectedservice::where('client_id', $id)->first();
        if (!($item1 === null) || !($item2 === null) || !($item3 === null)) {
         // disable client account
         Client::find($id)->update([
          "is_active" => 0
        ]);
  
        } else {
         
    //delete image
    if (!empty($object->image)) {
      $strgCtrlr=new StorageController();
      $path=$strgCtrlr->path['clients'];
      $imgpath =  $path . '/' . $object->image;
      if (File::exists($imgpath)) {
        File::delete($imgpath);
      }
    }
//delete related rows
    
    Expertfavorite::where('client_id', $id)->delete();
  // Servicefavorite::where('client_id', $id)->delete();
    //delete object
    Client::find($id)->delete();
        }
      }
      return redirect()->route('client.index');
      // return  $this->index();
      //   return redirect()->route('users.index');
  
    }
}
