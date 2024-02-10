<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expert;
use App\Models\Expertfavorite;
use Illuminate\Support\Facades\DB;

use File;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use App\Http\Controllers\Api\ServiceController;
use App\Models\Service;
use App\Http\Controllers\Api\StorageController;
use App\Http\Requests\Api\Expertfavorite\StoreRequest;

class ExpertController extends Controller
{

  //  public $path = 'images/experts';
   // public $recordpath = 'images/experts/records';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DB::table('experts')->get();
        // return view('admin.user.showusers',['users' => $users]); 
        return response()->json($users);
    }
    public function getexpert()
    {
        //  $credentials = request(['user_name','password']);
     //   $url = url(Storage::url($this->path)) . '/';
        // $url = url('storage/app/public' . '/' . $this->path  ).'/';
        //  $pass=request(['password']);
        //   $passval=$pass['password'];
        // $passhash=bcrypt($passval);
        $strgCtrlr=new StorageController();
        $url=$strgCtrlr->ExpertPath('image');
        $recurl=$strgCtrlr->ExpertPath('record');
        $defaultimg=$strgCtrlr->DefaultPath('image');
        $user = Expert::where('user_name', request(['user_name']))->
            //where('password',  $passhash)->
            select(
                'id',
                'user_name',
                'password',
                'mobile',
                'email',
              //  'nationality',
                'birthdate',
                'gender',
              //  'marital_status',
                'is_active',
                'points_balance',
                'cash_balance',
                'cash_balance_todate',
                'rates',               
            DB::raw("(CASE 
            WHEN record is NULL THEN ''                  
            ELSE CONCAT('$recurl',record)
            END) AS record"),
              //  'desc',                   
          DB::raw("(CASE 
          WHEN desc is NULL THEN ''                  
         ELSE desc END) AS 'desc'"),
                'call_cost',
                'answer_speed',
                DB::raw("(CASE 
            WHEN image is NULL THEN '$defaultimg'                    
            ELSE CONCAT('$url',image)
            END) AS image")
            )->first();

        $authuser = auth()->user();
        //  return response()->json(['form' =>  $credentials]);
        if (!is_null($user)) {
            if (
                !(($user->user_name == $authuser->user_name)
                    // && (Hash::check( $passval, $user->password))
                )
            ) {
                return response()->json('notexist', 401);
            }

        } else {
            return response()->json('notexist', 401);
        }

        return response()->json($user);
    }
    public function getexpertsbyserviceid()
    {
        $data = request(['id']);
        $id = $data['id'];
        //  $url = url('storage/app/public' . '/' . $this->path  ).'/';
       // $url = url(Storage::url($this->path)) . '/';
      //  $recurl = url(Storage::url($this->recordpath)) . '/';
   $strgCtrlr=new StorageController();
   $url=$strgCtrlr->ExpertPath('image');
   $recurl=$strgCtrlr->ExpertPath('record');
   $defaultimg=$strgCtrlr->DefaultPath('image');
//         $List = Expert::wherehas('expertsServices', function ($query) use ($id) {
//             $query->where('service_id', $id);
//             /*
//             $query->select(
//                 'id'
//                 'service_id',
//                 'expert_id',
//                 'points',
//                 'expert_cost',
//                 'cost_type',
//                 'expert_cost_value',
//             );
// */
//         })->with('expertsServices:id,service_id,expert_id,points,expert_cost,cost_type,expert_cost_value')
//             ->select(
//                 'id',
//                 'user_name',
//                 'mobile',
//                 'email',
//                 'nationality',
//                 'birthdate',
//                 'gender',
//                 'marital_status',
//                 'is_active',
//                 'points_balance',
//                 'cash_balance',
//                 'cash_balance_todate',
//                 'rates',

//                 DB::raw("(CASE 
//                 WHEN record = '' THEN ''                     
//                 ELSE CONCAT('$recurl',record)
//                 END) AS record"),
//                 'desc',
//                 'call_cost',
//                 'answer_speed',
//                 DB::raw("(CASE 
//                 WHEN image = '' THEN ''                     
//                 ELSE CONCAT('$url',image)
//                 END) AS image")
//             )->get();


        $List = Expert::with(['expertsServices'=>function($q)use($id){
            $q->where('service_id',$id)
            ->select('id','service_id','expert_id','points','expert_cost','cost_type','expert_cost_value');
                    }])
        ->select(
            'id',
            'user_name',
            'mobile',
            'email',
           // 'nationality',
            'birthdate',
            'gender',
           // 'marital_status',
            'is_active',
            'points_balance',
            'cash_balance',
            'cash_balance_todate',
            'rates',
            DB::raw("(CASE 
            WHEN record  is NULL THEN ''                  
            ELSE CONCAT('$recurl',record)
            END) AS record"),
           // 'desc',
            DB::raw("(CASE 
            WHEN experts.desc is NULL THEN ''                  
           ELSE experts.desc END) AS 'desc'"),
            'call_cost',
            'answer_speed',
            DB::raw("(CASE 
            WHEN image  is NULL THEN '$defaultimg'                  
            ELSE CONCAT('$url',image)
            END) AS image")
        )->wherehas('expertsServices', function ($query) use ($id) {
            $query->where('service_id', $id);            
        })->get();


        //  return response()->json(['form' =>  $credentials]);


        return response()->json($List);
    }
    public function addUser(Expert $newExpert)
    {
        $newExpert->save();
        return $newExpert;
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
    public function getwithfav()
    {
        $authuser = auth()->user();
            
        $data = request(['client_id']);
        $id = $data['client_id'];
        if ($authuser->id == $id) {
          
            $strgCtrlr=new StorageController();
            $url=$strgCtrlr->ExpertPath('image');
            $recurl=$strgCtrlr->ExpertPath('record');  
            $service_url=$strgCtrlr->ServicePath('image');
            $service_icon_url =$strgCtrlr->ServicePath('icon');
            $defaultimg=$strgCtrlr->DefaultPath('image');
            $defaultsvg=$strgCtrlr->DefaultPath('icon');
       //     $url = url(Storage::url($this->path)) . '/';
         //   $recurl = url(Storage::url($this->recordpath)) . '/';
      

            // $servicectrlr = new ServiceController();
            // $servicepath = $servicectrlr->path;
            // $serviceiconpath = $servicectrlr->iconpath;
          //  $service_url = url(Storage::url($servicepath)) . '/';
           // $service_icon_url = url(Storage::url($serviceiconpath)) . '/';

            $DBList = Expert::
                with([
                   //'expertsServices.service',
                 //  'expertsServices',
                    'expertsFavorites' => function ($q) use ($id) {
                        $q->where('client_id', $id)->select('id', 'client_id', 'expert_id');
                    },
                    'expertsServices.service' => function ($q)   {
                        $q->select( 'id' ,
                        'name',
                        'desc',
                        'image' ,
                        'icon' ,
                        'is_active',
                        'is_callservice');
                    }
                ])->get();
            $collList=collect($DBList);
 
            $List = $DBList ->map(function ($expert) use ($url, $recurl, $service_url, $service_icon_url,$defaultimg, $defaultsvg) {
               //expertsServicesMap
                $expertsServicesMap = $expert->expertsServices
                ->map(function ($expertsServices) use ( $service_url, $service_icon_url,$defaultimg, $defaultsvg) {
               
               //ServiceMap 
              // $ServiceMap1 = $expertsServices ->service->find($expertsServices->service_id)->first()->get();
                    
                    //end   ServiceMap 
                   
                    /*[
                        'id' => $expertsServices->id,
                        'expert_id' => $expertsServices->expert_id,
                        'service_id' => $expertsServices->service_id,
                        'points'=> $expertsServices->points,
                        'expert_cost'=>$expertsServices->expert_cost,
                        'cost_type'=> $expertsServices->cost_type,
                        'expert_cost_value'=>$expertsServices->expert_cost_value,
                     //   'service' => $expertsServices->service,
                     */
                   //  'service' =>
                   return    $this->servicetoArray( $expertsServices->service,$service_url, $service_icon_url,$defaultimg, $defaultsvg);
                   // ];

                });
// end expertsServicesMap
                return [
                    'id' => $expert->id,
                    'user_name' => $expert->user_name,
                    'mobile'=> $expert->mobile,
                    'email'=> $expert->email,
                    'birthdate'=> $expert->birthdate,
                    'gender'=> $expert->gender,
                  
                    'is_active'=> $expert->is_active,
                    'points_balance'=> $expert->points_balance,
                    'cash_balance'=> $expert->cash_balance,
                    'cash_balance_todate'=> $expert->cash_balance_todate,
                    'rates'=> $expert->rates,
                    'desc'=> $expert->desc==null?" ":$expert->desc,
                    'call_cost'=> $expert->call_cost,
                    'answer_speed'=> $expert->answer_speed,
                    'record'=>$expert->record==null?" ":$recurl.$expert->record,
                    'image'=>$expert->image==null?$defaultimg:$url.$expert->image,
                    'is_favorite' => $expert->expertsFavorites->isEmpty() ? 0 : 1,


                  //  'expertsFavorites' => $expert->expertsFavorites,
                    //  'expertsServices'=>$item->expertsServices,
                    'services' => $expertsServicesMap,

                ];
            });

            
            return response()->json( $List );



        } else {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
    }

  
    public function servicetoArray($service,$service_url, $service_icon_url,$defaultimg, $defaultsvg)
    {

        return [
            "id" => $service->id,
            "name"=> $service->name,
            'desc'=> $service->desc==null?" ": $service->desc,
            'image' =>$service->image==null?$defaultimg:$service_url.$service->image,
            'icon' => $service->icon==null?$defaultsvg:$service_icon_url.$service->icon,
            'is_active'=> $service->is_active,
            'is_callservice'=> $service->is_callservice,            
        ];
    }
    public function getwithfavandExpServ()
    {
        $authuser = auth()->user();
          
        $data = request(['client_id']);
        $id = $data['client_id'];
        if ($authuser->id == $id) {
           
          //  $url = url(Storage::url($this->path)) . '/';
        //    $recurl = url(Storage::url($this->recordpath)) . '/';
          //  $servicectrlr = new ServiceController();
          //  $servicepath = $servicectrlr->path;
           // $serviceiconpath = $servicectrlr->iconpath;
        //    $service_url = url(Storage::url($servicepath)) . '/';
         //   $service_icon_url = url(Storage::url($serviceiconpath)) . '/';

            $strgCtrlr=new StorageController();
            $url=$strgCtrlr->ExpertPath('image');
            $recurl=$strgCtrlr->ExpertPath('record');  
            $service_url=$strgCtrlr->ServicePath('image');
            $service_icon_url =$strgCtrlr->ServicePath('icon');
            $defaultimg=$strgCtrlr->DefaultPath('image');
            $defaultsvg=$strgCtrlr->DefaultPath('icon');
            $DBList = Expert::
                with([
                   'expertsServices.service',
                 //  'expertsServices',
                    'expertsFavorites' => function ($q) use ($id) {
                        $q->where('client_id', $id)->select('id', 'client_id', 'expert_id');
                    }
                ])->get();
            $collList=collect($DBList);
 
            $List = $DBList ->map(function ($expert) use ($url, $recurl, $service_url, $service_icon_url, $defaultimg,$defaultsvg) {
               //expertsServicesMap
                $expertsServicesMap = $expert->expertsServices
                ->map(function ($expertsServices) use ( $service_url, $service_icon_url, $defaultimg,$defaultsvg) {
               
               //ServiceMap 
                    $ServiceMap = $expertsServices->service->get()->map(function ($service) use ($service_url, $service_icon_url,$defaultimg,$defaultsvg) {
                        return [
                            'id' => $service->id,
                            'name' => $service->name,
                            'desc' => $service->desc == null ?" ":$service->desc,
                            'image' =>$service->image== null?$defaultimg:$service_url.$service->image,
                            'icon' => $service->icon== null ?$defaultsvg:$service_icon_url.$service->icon,
                            'is_active' => $service->is_active,
                            'is_callservice' => $service->is_callservice,
                        ];
                    });
                    //end   ServiceMap 
                    return [
                        'id' => $expertsServices->id,
                        'expert_id' => $expertsServices->expert_id,
                        'service_id' => $expertsServices->service_id,
                        'points'=> $expertsServices->points,
                        'expert_cost'=>$expertsServices->expert_cost,
                        'cost_type'=> $expertsServices->cost_type,
                        'expert_cost_value'=>$expertsServices->expert_cost_value,
                        'service' => $ServiceMap,
 
                    ];

                });
// end expertsServicesMap
                return [
                    'id' => $expert->id,
                    'user_name' => $expert->user_name,
                    'mobile'=> $expert->mobile,
                    'email'=> $expert->email,
                    'birthdate'=> $expert->birthdate,
                    'gender'=> $expert->gender,
                  
                    'is_active'=> $expert->is_active,
                    'points_balance'=> $expert->points_balance,
                    'cash_balance'=> $expert->cash_balance,
                    'cash_balance_todate'=> $expert->cash_balance_todate,
                    'rates'=> $expert->rates,
                    'desc'=> $expert->desc==null?" ":$expert->desc,
                    'call_cost'=> $expert->call_cost,
                    'answer_speed'=> $expert->answer_speed,
                    'record'=>$expert->record==null?"":$recurl.$expert->record,
                    'image'=>$expert->image==null ?$defaultimg:$url.$expert->image,
                    'is_favorite' => $expert->expertsFavorites->isEmpty() ? 0 : 1,
 
                    'expertsServices' => $expertsServicesMap,

                ];
            });

            
            /*
            $collList=collect($List)->map
            ->only(['id', 'user_name', 'mobile','expertsFavorites','expertsServices','expertsServices[service][id]']); 
             */
            /*
                   $List = DB::table('experts')
                       ->leftJoin('expertsfavorites', function ($join) use ($id) {
                           $join->on('experts.id', '=', 'expertsfavorites.expert_id')
                               ->where('expertsfavorites.client_id', '=', $id);
                       })
                  //    ->leftJoin('experts_services', 'experts.id', '=', 'experts_services.expert_id')
                      ->with('expertsServices')
                       ->select(
                           'experts.id',
                           'user_name',
                           'mobile',
                           'email',
                           'birthdate',
                           'gender',
                        //   'marital_status',
                           'is_active',
                           'points_balance',
                           'cash_balance',
                           'cash_balance_todate',
                           'rates',
                           'desc',
                           'call_cost',
                           'answer_speed',
                           DB::raw("(CASE 
                           WHEN experts.record = '' THEN ''                     
                           ELSE CONCAT('$recurl',experts.record)
                           END) AS record"),
                           DB::raw("(CASE 
                           WHEN experts.image = '' THEN ''                     
                           ELSE CONCAT('$url',experts.image)
                           END) AS image"),
                           DB::raw('IF(expertsfavorites.client_id IS NULL, 0, 1) AS is_favorite')
              
                      )
                     //  ->with('expertsServices.service')
                       ->get();
                        */
            //  $List=$List->with('expertsServices.service')->get();
            return response()->json($DBList );



        } else {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
    }

    public function savefav()
    {
        $authuser = auth()->user();
        $request = request();
     
        $formdata = $request->all();
     
        $storrequest = new StoreRequest();//php artisan make:request Api/Expertfavorite/StoreRequest
       
        $validator = Validator::make(
            $formdata,
            $storrequest->rules(),
            $storrequest->messages()
        );
        if ($validator->fails()) {
            
            return response()->json($validator->errors());
            //   return redirect()->back()->withErrors($validator)->withInput();

        } else {
             
         //   $data = json_decode($request->getContent(), true);            
          //   return response()->json([$client_id,$authuser->id]);
            if ($authuser->id == $formdata['client_id']) {      

       if($formdata['is_favorite']==true){   
        //updateOrCreate
        $expertfavorit = Expertfavorite::updateOrCreate(
          ['client_id' =>$formdata['client_id'], 'expert_id' =>$formdata['expert_id']] 
      );
       }else{
       //delete
        $deleted = Expertfavorite::where('client_id',$formdata['client_id'])->where('expert_id', $formdata['expert_id'])->delete();
    
    }
    return response()->json("ok");
             //   return response()->json( $client_id );
                 } else {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
    }
    }
}
