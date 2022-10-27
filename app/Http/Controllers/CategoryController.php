<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use DataTables;
use Validator;
use Response;

class CategoryController extends Controller
 {
    function __construct()
    {
         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
         $this->middleware('permission:product-create', ['only' => ['create','store']]);
         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

        public function index(Request $request)
        {
            $notifications = auth()->user()->unreadNotifications;
            if ($request->ajax()) {
                $data = Category::latest()->get();
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $btn='';
                            if(auth()->user()->hasPermissionTo('category-edit')) {
                            $btn .=  '<button class="btn btn-primary mr-1" data-act="ajax-modal" data-method="get"
                            data-action-url="'. route('categories.edit', $row->id). '" data-original-title="Edit"
                            data-toggle="tooltip" data-placement="top" data-title="Edit category">
                                Edit
                            </button>';
                           }
                             if(auth()->user()->hasPermissionTo('category-delete')) {
                             $btn .=  '<a class="btn btn-danger delete " data-table="#categories-table" data-method="get"
                             data-url="' .route('categories.destroy', $row->id). '" data-toggle="tooltip" data-placement="top" title="Delete Category">
                                 Delete
                             </a>';
                            }
                             return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }

            return view('categories.index' , compact('notifications'));
        }
        public function create(Request $request)
        {
            return view('categories.model');
        }

        public function store(Request $request)
        {
            try{
                $category = Category::create([
                    'name_en' => $request->name_en,
                    'name_ar' => $request->name_ar,
                    'description_en' => $request->description_en,
                    'description_ar' => $request->description_ar,
                ]);
                return response()->json([$category, 'status'=>'success'],200);
            }catch (Exception $e) {
                return $this->response->message($e->getMessage())
                    // ->code(400)
                    ->status('error')
                    ->url('nothing Wrong')
                    ->message('Something Went wrong')

                    ->redirect();

        }
    }

        public function edit($id)
        {
            $category = Category::find($id);
            return view('categories.model', compact('category'));
           // return response()->json([$category, 'status'=>'success'],200);
        }

        public function update(Request $request, $id)
    {
        try{
            $category = Category::find($id);
            $category->name_en = $request->name_en;
            $category->name_ar = $request->name_ar;
            $category->description_en = $request->description_en;
            $category->description_ar = $request->description_ar;
            $res = $category->save();

            return response()->json([
                'error' => false,
                'status'=> 'success',
               //'category'  => $category,
           ], 200);
        }catch(\Exception $exception) {
            return response()->json([
                'message' => 'Something Went wrong'
            ]);
        }
    }


        public function destroy($id)
        {


            try{

                $category = Category::find($id);
                $res = $category->delete();
                if($res){
                    return response()->json([
                        'message' => 'Category Successfully Deleted',
                        'status' => 'success',
                    ]);
                }else{
                    return response()->json([
                        'message' => 'Category cannot be deleted as products exists against this category',
                        'status' => 'error',
                    ]);
                }
            }catch(\Exception $exception) {
                return response()->json([
                    'message' => 'Something Went wrong',
                    'status' => 'error',
                ]);
            }
            // $exception->getMessage()

        }

    }