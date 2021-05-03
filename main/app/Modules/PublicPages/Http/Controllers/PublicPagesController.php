<?php

namespace App\Modules\PublicPages\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PublicPagesController extends Controller
{
  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function index()
  {
    return view('publicpages::app');
  }
}
