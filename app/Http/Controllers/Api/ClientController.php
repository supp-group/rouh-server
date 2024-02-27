<?php

namespace App\Http\Controllers\Api;

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
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Api\StorageController;
use App\Http\Requests\Api\Client\UpdateClientRequest;
/*
use App\Http\Requests\Web\Client\StoreClientRequest;
use App\Http\Requests\Web\Client\UpdateClientRequest;
use App\Models\Pointtransfer;
use App\Models\Cashtransfer;
use App\Models\Expertfavorite;
use App\Models\Servicefavorite;
use App\Models\Selectedservice;
*/
class ClientController extends Controller
{

 //   public $path = 'images/clients';
   
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    public function getbymobile()
    {


        $credentials = request(['mobile']);
    // $url = url('storage/app/public' . '/' . $this->path  ).'/';
    $strgCtrlr=new StorageController();
    $url=$strgCtrlr->ClientPath('image');
    $defaultimg=$strgCtrlr->DefaultPath('image');
   // $url =url( Storage::url($this->path)).'/';
        $user = Client::where('mobile', $credentials)->where('is_active',1)->select(
            'id',
            'user_name',
            'mobile',
            'email',
            'nationality',
            'birthdate',
            'gender',
            'marital_status',
            'points_balance',       
            'is_active',
          //  DB::raw("CONCAT('$url',image)  AS image")           
            DB::raw("(CASE 
            WHEN image is NULL THEN '$defaultimg'                  
            ELSE CONCAT('$url',image)
            END) AS image")
        )->first();

        $authuser = auth()->user();
        //  return response()->json(['form' =>  $credentials]);
        if (!is_null($user)) {
            if (!($user->mobile == $authuser->mobile)) {
                return response()->json('notexist', 401);
            }

        } else {
            return response()->json('notexist', 401);
        }

        return response()->json(
          $user
        );


    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function addUser(Client $newUClient)
    {
        $newUClient->save();
        return $newUClient;
    }
    public function storeImage($file, $id)
    {
        $imagemodel = Client::find($id);
        $oldimage = $imagemodel->image;
        $oldimagename = basename($oldimage);
        $strgCtrlr=new StorageController();
        $path=$strgCtrlr->path['clients'];
        $oldimagepath =  $path . '/' . $oldimagename;
        //save photo
        
        if ($file !== null) {
            //  $filename= rand(10000, 99999).".".$file->getClientOriginalExtension();
            $filename = rand(10000, 99999) . $id . ".webp";
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file);
            $image = $image->toWebp(75);
            if (!File::isDirectory(Storage::url('/' .  $path))) {
                Storage::makeDirectory('public/' .  $path);
            }
            $image->save(storage_path('app/public') . '/' .  $path . '/' . $filename);
        //    $url = url('storage/app/public' . '/' . $this->path . '/' . $filename);
            Client::find($id)->update([
                "image" => $filename
            ]);
            Storage::delete("public/" .  $path . '/' . $oldimagename);
         
        }
        return 1;
    }

    public function updateprofile(Request $filerequest)
    {
        
        $formdata = $filerequest->all();

   
  //  $file=  $formdata ->file('image');
      $storrequest=new UpdateClientRequest();
    //  $storrequest->request()=$formdata ;
   //   $storrequest=  $formdata ;
      $validator = Validator::make($formdata,
      $storrequest->rules(),
      $storrequest->messages()
    );
    if ($validator->fails()) {
        /*
          return redirect('/cpanel/users/add')
          ->withErrors($validator)
                      ->withInput();
                      */
                      return response()->json($validator->errors());
     //   return redirect()->back()->withErrors($validator)->withInput();
  
      } else {
             $id=   $formdata["id"];
     $authuser = auth()->user();
     if (!( $authuser->id == $id)) {
        return response()->json('notexist', 401);
    }else{
     $birthdate= Carbon::create($formdata["birthdate"])->format('Y-m-d');
     Client::find($id)->update([
            'user_name'=>  $formdata['user_name'],
            'email'=>  $formdata['email'],
            'nationality' => $formdata['nationality'],         
            'birthdate' =>  $birthdate,
            'gender' =>(int) $formdata['gender'],        
            'marital_status' =>$formdata['marital_status'],   
          ]);
        if ($filerequest->hasFile('image')) {
            $file= $filerequest->file('image');
            $this->storeImage( $file, $id);
        }
       
      
         return response()->json($id);
      }
    }
  
  
  
    }
    public function deleteaccount(Request $filerequest)
    {
        $formdata = request(['id']);
        $id=   $formdata["id"];           
     $authuser = auth()->user();
     if (!( $authuser->id == $id)) {
        return response()->json('notexist', 401);
    }else{     
     Client::find($id)->update([
            'is_active'=>  0,           
          ]);
          auth('api_clients')->logout();      
         return response()->json($id);
      }
    }

}
