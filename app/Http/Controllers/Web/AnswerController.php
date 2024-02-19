<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


 
use App\Models\Reason;
  
use App\Models\User;
use App\Models\ValueService;
use App\Models\Selectedservice;
use Illuminate\Support\Facades\DB; 
use File;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Carbon;
 
 
use App\Models\Pointtransfer;

//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Api\StorageController;
class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list =User::latest()->first();
      
        $list =Selectedservice::with(['expert','client','service','answers'
        /*
        'answers' => function ($q){
            $q->latest()->first();
        }
        */
         ])->where('form_state','agree')->get();
       
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
    public function edit(  $id)
    {
         //  $url =url(Storage::url($this->path)).'/';
      $object =Selectedservice::with(['expert','client',       
      'valueservices' => function ($q){
        $q->orderByDesc('ispersonal');
    },      
    'answers' => function ($q){
      $q->orderByDesc('created_at');
  }
     ])->find($id);
      $reasons=Reason::where('type','answer')->get();
     //return dd($object);
      return view('admin.answer.edit', ['selectedservice' => $object,'reasons'=> $reasons]); 
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
}