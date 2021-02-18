<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Type;

class TypeController extends Controller
{
  public function index()
  {
    $types = Type::all();
    return response()->json([
      'success' => true,
      'results' => $types
    ]);
  }
}
