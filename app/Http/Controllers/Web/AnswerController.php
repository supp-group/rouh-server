<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Api\StorageController;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Cashtransfer;
use App\Models\Expert;
use Illuminate\Http\Request;
use App\Models\Reason;

use App\Models\Selectedservice;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\Http\Requests\Web\Order\UpdateAnswerStateRequest;

use App\Models\Pointtransfer;
use App\Models\Company;

//use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Api\CashTransferController;
use App\Http\Controllers\Api\PointTransferController;
use Illuminate\Support\Str;
class AnswerController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    // $list = User::latest()->first();

    $list = Selectedservice::with([
      'expert',
      'client',
      'service',
      'answers'
      /*
      'answers' => function ($q){
          $q->latest()->first();
      }
      */
    ])->where('form_state', 'agree')->get();

    //   return  $list;
    return view('admin.answer.show', ['selectedservices' => $list]);
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
  public function edit($id)
  {
    //  $url =url(Storage::url($this->path)).'/';
    $object = Selectedservice::with([
      'expert',
      'client',
      'valueservices' => function ($q) {
        $q->orderByDesc('ispersonal');
      },
      'answers' => function ($q) {
        $q->orderByDesc('created_at');
      }
    ])->find($id);
    $reasons = Reason::where('type', 'LIKE', '%'.'answer'.'%')->get();
    //return dd($object);
    return view('admin.answer.edit', ['selectedservice' => $object, 'reasons' => $reasons]);
  }
  public function getbyselectedid($id)
  {
    //  $url =url(Storage::url($this->path)).'/';
    $list = Selectedservice::find($id)->answers->sortByDesc('created_at');
    //return dd($object);
    return view('admin.answer.showanswers', ['answers' => $list]);
  }
  /**
   * Update the specified resource in storage.
   */
  /*
      public function update(UpdateAnswerStateRequest $request, $id)
      {
        $formdata = $request->all();
        //validate
        $validator = Validator::make(
          $formdata,
          $request->rules(),
          $request->messages()
        );
        if ($validator->fails()) {
      
                        return response()->json($validator);
    
        } else {
         // $imagemodel = Expert::find($id);
          
          DB::transaction(function ()use( $formdata,$id) {
            $pointobj=Pointtransfer::where('selectedservice_id',$id)
            ->where('state','wait')
            ->where('side','from-client')->first();

            $selectedObj= Selectedservice::find($id);
            $answerObj=Answer::where('selectedservice_id',$id)->where('answer_state','wait')->first();

            if($formdata['answer_state']=='agree'){

    Answer::find($answerObj->id)->update([
      'answer_state'=>  $formdata['form_state'],
                    
    ]);
    $comprofitperc= 100-$selectedObj->expert_cost;
    $comprofitval=   $selectedObj->points -$selectedObj->expert_cost_value;
      Selectedservice::find($id)->update([
        'status'=> 'agree',  
        'company_profit_percent'=>  $comprofitperc ,
        'company_profit'=> $comprofitval,
                
      ]);
  //add cach transfer to company
  $companyCach = new Cashtransfer();
  $companyCach->cash = $selectedObj->points;
  $companyCach->cashtype =  'd';
  $companyCach->fromtype = '';
  $companyCach->totype = 'company'; 
  $companyCach->status = 'agree';
  $companyCach->selectedservice_id = $id;
   
  $companyCach->save();
  //add cash to company balance
  $comObj=Company::find(1);
    
  Company::find(1)->update([
    'cash_balance'=> $comObj->cash_balance +$comprofitval,
    'cash_profit'=> $comObj->cash_profit +$comprofitval,
    ]              
  );
  // add expert cash 
  $expertCach = new Cashtransfer();
  $expertCach->cash = $selectedObj->expert_cost_value;
  $expertCach->cashtype =  'p';
  $expertCach->fromtype = 'company';
  $expertCach->totype = 'expert'; 
  $expertCach->status = 'agree';
  $expertCach->selectedservice_id = $id;
   
  $expertCach->save();
  ////add cost to expert balance
  $expertObj=Expert::find($selectedObj->expert_id);
  Expert::find($selectedObj->expert_id)->update([
    'cash_balance'=> $expertObj->cash_balance+$selectedObj->expert_cost_value,
    'cash_balance_todate'=> $expertObj->cash_balance_todate + $selectedObj->expert_cost_value
    ]              
  );

  }else{
    //reject
    $reason=Reason::find($formdata['answer_reject_reason']);
     
    Answer::find($answerObj->id)->update([
      'answer_state'=>  $formdata['form_state'],
      'answer_reject_reason'=>  $reason->content,          
    ]); 
  }
          });        
          return response()->json("ok");
          
        }
      }
      */
  public function agreemethod(Request $request, $id)
  {

    DB::transaction(function () use ($id) {
      $pointobj = Pointtransfer::where('selectedservice_id', $id)
        ->where('state', 'wait')
        ->where('side', 'from-client')->first();
      $selectedObj = Selectedservice::find($id);
      $answerObj = Answer::where('selectedservice_id', $id)->where('answer_state', 'wait')->first();
      $now = Carbon::now();
      Answer::find($answerObj->id)->update(
        [
          'answer_state' => 'agree',
          'updateuser_id' => auth()->user()->id,
          'answer_admin_date' => $now,
        ],
      );
      $comprofitperc = 100 - $selectedObj->expert_cost;
      $comprofitval = $selectedObj->points - $selectedObj->expert_cost_value;
      // calc answer speed for this order
      $startdate= $selectedObj->order_date;
      $enddate= $now ;
      $answespeed=StorageController::diffTimeinMinutes( $startdate,$enddate);
      // end
      Selectedservice::find($id)->update([
        'status' => 'agree',
        'company_profit_percent' => $comprofitperc,
        'company_profit' => $comprofitval,
        'comment_state' => 'no-comment',
        'answer_speed'=>  $answespeed,
      ]);
      $cashtrctrlr = new CashTransferController();
      /*
      //add cach transfer to company
      $cashtype1 = 'd';
      $cashtrctrlr = new CashTransferController();
      $firstLetters = $cashtype1 . 'com-';
      $comCode = $cashtrctrlr->GenerateCode($firstLetters);
      $companyCach = new Cashtransfer();

      $companyCach->cash = $selectedObj->points;
      $companyCach->cashtype = $cashtype1;
      $companyCach->fromtype = '';
      $companyCach->totype = 'company';
      $companyCach->status = 'agree';
      $companyCach->selectedservice_id = $id;
      $companyCach->cash_num = $comCode;
      $companyCach->save();
*/
      // add point transfer for expert percent
      $pointtransfer = new Pointtransfer();
      $pntctrlr = new PointTransferController();
      $type = 'p';
      $firstLetters = $type . 'ex-';
      $newpnum = $pntctrlr->GenerateCode($firstLetters);
      //$pointtransfer->point_id = $formdata['point_id'];
       $pointtransfer->client_id =  $selectedObj->client_id;
      $pointtransfer->expert_id = $selectedObj->expert_id;
      $pointtransfer->service_id =$selectedObj->service_id;
      $pointtransfer->count =$selectedObj->expert_cost_value;
      $pointtransfer->status = 1;
      $pointtransfer->selectedservice_id = $selectedObj->id;
      $pointtransfer->side = 'to-expert';
      $pointtransfer->state = 'agree';
      $pointtransfer->type =  $type;
      $pointtransfer->num = $newpnum;
      $pointtransfer->save();
      //
      /*
      //add cash to company balance
      $comObj = Company::find(1);
      Company::find(1)->update(
        [
          'cash_balance' => $comObj->cash_balance + $comprofitval,
          'cash_profit' => $comObj->cash_profit + $comprofitval,
        ]
      );
      */
      // add expert cash 
/*
      $expertCach = new Cashtransfer();
      $cashtype2 = 'p';

      $firstLetters = $cashtype2 . 'exp-';
      $expCode = $cashtrctrlr->GenerateCode($firstLetters);
      $expertCach->cash = $selectedObj->expert_cost_value;
      $expertCach->cashtype = 'p';
      $expertCach->fromtype = 'company';
      $expertCach->totype = 'expert';
      $expertCach->status = 'agree';

      $expertCach->selectedservice_id = $id;
      $expertCach->cash_num = $expCode;
      $expertCach->save();
      */
      ////add cost to expert balance and update answer speed

      $expertObj = Expert::find($selectedObj->expert_id);
     $answespeedavg=StorageController::calcAnswerspeedAvg( $selectedObj->expert_id);
      Expert::find($selectedObj->expert_id)->update(
        [
          'cash_balance' => $expertObj->cash_balance + $selectedObj->expert_cost_value,
       //   'cash_balance_todate' => $expertObj->cash_balance_todate + $selectedObj->expert_cost_value,
          'answer_speed'=>$answespeedavg ,
          ]
      );
    });


    return response()->json("ok");

  }
  public function rejectmethod(UpdateAnswerStateRequest $request, $id)
  {

    $formdata = $request->all();
    //validate
    $validator = Validator::make(
      $formdata,
      $request->rules(),
      $request->messages()
    );
    if ($validator->fails()) {

      return response()->json($validator);

    } else {

      DB::transaction(function () use ($formdata, $id) {
        /*
        $pointobj = Pointtransfer::where('selectedservice_id', $id)
          ->where('state', 'wait')
          ->where('side', 'from-client')->first();

        $selectedObj = Selectedservice::find($id);
        */
        $answerObj = Answer::where('selectedservice_id', $id)->where('answer_state', 'wait')->first();


        //reject
        $reason = Reason::find($formdata['answer_reject_reason']);
        $now = Carbon::now();
        Answer::find($answerObj->id)->update([
          'answer_state' => 'reject',
          'answer_reject_reason' => $reason->content,
          'updateuser_id' => auth()->user()->id,
          'answer_admin_date' => $now,
        ]);
      });

      return response()->json("ok");
    }
  }
  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
