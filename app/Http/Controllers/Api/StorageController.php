<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
use Illuminate\Support\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use PhpParser\Node\Expr\Cast\Object_;

class StorageController extends Controller
{


  public $path = [];
  public $iconpath = [];
  public $recordpath = [];
  private $defaultimage = "default.png";
  private $defaultsvg = "default.svg";
  public function __construct()
  {
    //inputs
    $this->path['inputs'] = 'images/inputs';
    $this->iconpath['inputs'] = 'images/inputs/icons';
    //experts
    $this->path['experts'] = 'images/experts';

    // $recordpath['experts'] = 'images/experts/records';
    $this->path['experts'] = 'images/experts';
    $this->recordpath['experts'] = 'images/experts/records';

    //clients
    $this->path['clients'] = 'images/clients';
    //services
    $this->path['services'] = 'images/services';
    $this->iconpath['services'] = 'images/services/icons';
    //empty
    $this->path['default'] = 'images/default';
    $this->iconpath['default'] = 'images/default/icons';
    //value
    $this->path['values_services'] = 'images/values';
    $this->recordpath['values_services'] = 'images/values/records';
  }
  /**
   * Display a listing of the resource.
   */
  public function ExpertPath($type)
  { //image record
    $url = "";

    if ($type == "image") {
      $url = url(Storage::url($this->path['experts'])) . '/';
    } else {
      $url = url(Storage::url($this->recordpath['experts'])) . '/';
    }

    return $url;

  }
  public function InputPath($type)
  { //image icon
    $url = "";

    if ($type == "image") {
      $url = url(Storage::url($this->path['inputs'])) . '/';
    } else {
      $url = url(Storage::url($this->iconpath['inputs'])) . '/';
    }

    return $url;


  }
  public function ClientPath($type)
  { //image record
    $url = "";

    if ($type == "image") {
      $url = url(Storage::url($this->path['clients'])) . '/';
    }
    return $url;

  }

  public function ServicePath($type)
  { //image icon
    $url = "";

    if ($type == "image") {
      $url = url(Storage::url($this->path['services'])) . '/';
    } else {
      $url = url(Storage::url($this->iconpath['services'])) . '/';
    }

    return $url;


  }

  public function DefaultPath($type)
  { //image icon
    $url = "";
    if ($type == "image") {
      $url = url(Storage::url($this->path['default'])) . '/' . $this->defaultimage;
    } else {
      $url = url(Storage::url($this->iconpath['default'])) . '/' . $this->defaultsvg;
    }
    return $url;


  }
  public function ValuePath($type)
  { //image record
    $url = "";
    if ($type == "image") {
      $url = url(Storage::url($this->path['values_services'])) . '/';
    } else {
      $url = url(Storage::url($this->recordpath['values_services'])) . '/';
    }
    return $url;
  }
  //
}
