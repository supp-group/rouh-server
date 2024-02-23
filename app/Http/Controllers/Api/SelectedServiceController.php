<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InputService;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use App\Models\Selectedservice;
use App\Models\Client;
use App\Models\Expert;
use App\Models\Service;
use App\Models\ExpertService;
use App\Models\ValueService;
use App\Models\Pointtransfer;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Api\ValueService\StoreImageRequest;

use App\Http\Controllers\Api\StorageController;
//use Illuminate\Support\Str;
class SelectedServiceController extends Controller
{
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
    public $id = 0;
    public function store(Request $request)
    {
        //
    }
    public function savewithvalues()
    {
        //


        DB::transaction(function () {
            $request = request();

            $data = json_decode($request->getContent(), true);
            //check client balance
            $client = Client::find($data['client_id']);
            $expertService = ExpertService::where('expert_id', $data['expert_id'])->where('service_id', $data['service_id'])->first();
$service=Service::find( $expertService->service_id);
            if ($client->points_balance < $expertService->points) {
                return response()->json([
                    "error" => "nopoints",
                    "message" => 0
                    // 'user'=> $user,   
                ]);
            } else {

                //save selected service
                $newObj = new Selectedservice;
                $newObj->client_id = $client->id;
                $newObj->expert_id = $expertService->expert_id;
                $newObj->service_id = $expertService->service_id;
                $newObj->points = $expertService->points;
                $newObj->rate = 0;
                $newObj->form_state='wait';
             //   $newObj->answer = "";
             //   $newObj->answer2 = "";
                $newObj->comment = "";
               // $newObj->iscommentconfirmd = 0;
             //   $newObj->issendconfirmd = 0;
            //    $newObj->isanswerconfirmd = 0;
                $newObj->comment_rate = 0;
                $newObj->status = "created";
                $newObj->expert_cost =$service->expert_percent ;//percent
                $newObj->cost_type = $expertService->cost_type;
             //   $newObj->expert_cost_value = $expertService->expert_cost_value;
                $newObj->expert_cost_value =StorageController::CalcPercentVal($service->expert_percent,$expertService->points);
                $newObj->save();
                $this->id = $newObj->id;

                //save values in values_services table
                foreach ($data["valueServices"] as $row) {
                    $valueService = new valueService();
                    $input = InputService::find($row['inputservice_id'])->input()->first();

                    $valueService->value = $row['value'];
                    $valueService->inputservice_id = $row['inputservice_id'];
                    $valueService->selectedservice_id = $newObj->id;

                    $valueService->name = $input->name;
                    $valueService->type = $input->type;
                    $valueService->tooltipe = $input->tooltipe;
                    $valueService->icon = $input->icon;
                    $valueService->ispersonal = $input->ispersonal;
                    $valueService->image_count = $input->image_count;
                    $valueService->save();
                }
                // decrease client balance
                $client->points_balance = $client->points_balance - $expertService->points;
                $client->save();
                //create point transfer row
                $pointtransfer = new Pointtransfer();
                //$pointtransfer->point_id = $formdata['point_id'];
                $pointtransfer->client_id = $client->id;
                $pointtransfer->expert_id = $expertService->expert_id;
                $pointtransfer->service_id = $expertService->service_id;
                $pointtransfer->count = $expertService->points;
                $pointtransfer->status = 1;
                $pointtransfer->selectedservice_id = $newObj->id;
                $pointtransfer->side = 'from-client';
                $pointtransfer->state = 'wait';
                $pointtransfer->type = 'd';
                $pointtransfer->save();
                //  }
            }

        });
        return response()->json([
            "message" => $this->id
        ]);
    }
  
    public function uploadfilesvalue(Request $request)
    {
        //
        $formdata = $request->all();
     
            $storrequest = new StoreImageRequest();
           
            $validator = Validator::make(
                $formdata,
                $storrequest->rules(),
                $storrequest->messages()
            );
            if ($validator->fails()) {
                
                return response()->json($validator->errors());
                //   return redirect()->back()->withErrors($validator)->withInput();

            } else {
                DB::transaction(function () use ($request, $formdata) {
                //isset($formdata["is_active"]) 
                $valserCntrlr = new ValueServiceController();
                //save images if exist
                if(isset($formdata["inputservice_id"]) ){
                    if($formdata["inputservice_id"]>0){
                    $input = InputService::findOrFail($formdata['inputservice_id'])->input()->first();
               
                for ($i = 1; $i <= 4; $i++) {
                    if ($request->hasFile('image_' . $i)) {
                        $valueService = new valueService();
                        $valueService->value = "";
                        $valueService->inputservice_id = $formdata['inputservice_id'];
                        $valueService->selectedservice_id = $formdata['selectedservice_id'];

                        $valueService->name = $input->name;
                        $valueService->type = $input->type;
                        $valueService->tooltipe = $input->tooltipe;
                        $valueService->icon = $input->icon;
                        $valueService->ispersonal = $input->ispersonal;
                        $valueService->image_count = $input->image_count;
                        $valueService->save();

                        $file = $request->file('image_' . $i);
                        $valserCntrlr->storeImage($file, $valueService->id);
                        $this->id = $valueService->id;
                    }
                }
            }
        }
            //save record if exist
if(isset($formdata["record_inputservice_id"]) ){
    if($formdata["record_inputservice_id"]>0){    
    $record_input = InputService::findOrFail($formdata['record_inputservice_id'])->input()->first();
    if ($request->hasFile('record')) {
        $valueService = new valueService();
        $valueService->value = "";
        $valueService->inputservice_id = $formdata['record_inputservice_id'];
        $valueService->selectedservice_id = $formdata['selectedservice_id'];

        $valueService->name = $record_input->name;
        $valueService->type =  $record_input->type;
        $valueService->tooltipe =  $record_input->tooltipe;
        $valueService->icon =  $record_input->icon;
        $valueService->ispersonal =  $record_input->ispersonal;
        $valueService->image_count =  $record_input->image_count;
        $valueService->save();

        $file = $request->file('record');
        $valserCntrlr->storerecord($file, $valueService->id);
        $this->id = $valueService->id;
    }
}     
                }        
            });
            }
         
        return response()->json([
            "message" => $this->id

        ]);
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
    public function additem(Selectedservice $newObject)
    {
        $newObject->save();
        return $newObject;
    }
}
