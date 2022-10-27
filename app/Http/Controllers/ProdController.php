<?php

namespace App\Http\Controllers;
use App\Models\Prod;
use App\Models\Category;
use Illuminate\Http\Request;
use DataTables;
use Validator;
use Exception;
use Illuminate\Support\Facades\Storage;

class ProdController extends Controller
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

         $categories= Category::all();

        if ($request->ajax()) {
            $data = Prod::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        if(auth()->user()->hasPermissionTo('product-edit')) {
                           $btn =  '<button class="btn btn-primary mr-1" data-act="ajax-modal" data-method="get"
                           data-action-url="'. route('products.edit', $row->id). '" data-original-title="Edit"
                           data-toggle="tooltip" data-placement="top" data-title="Edit product">
                               Edit
                           </button>';

                        }
                        if(auth()->user()->hasPermissionTo('product-delete')) {
                        //    $btn = $btn.' <a  data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
                           $btn =  $btn.'<a class="btn btn-danger mr-1 delete " data-table="#products-table" data-method="get"
                           data-url="' .route('products.destroy', $row->id). '" data-toggle="tooltip" data-placement="top" data-title="Delete Product">
                               Delete
                           </a>';
                        }
                            return $btn;
                    })
                    ->addColumn('category_id', function($row){
                      $category=$row->category->name_en .  $row->category->name_ar;
                         return $category;
                 })
                //  ->addColumn('image', function($row){

                //   //  $image='<img src='{{ url('image/' . $row->image) }} 'alt="dkj" width="50px" />';
                //    // $image="<img src={{ url('image/"'. $row->image.'") }}  width='50px' />"
                //   //$image="<img src="{{ url('image/' . $row->image) }} " width='50px' />";
                //   //$image='width="50px"'.$row->image.'' ;

                //    return $image;
                //   } )

                    ->rawColumns(['action'])
                   ->addColumn('image', 'image')
                  ->rawColumns(['action','image'])
                    ->make(true);
        }


        return view('product.index', compact('categories','notifications'));


    }
    public function create(Request $request)

    {

        // $notifications = auth()->user()->unreadNotifications;
        // $product= Prod::all();
       $categories= Category::all();

        //return view('product.model', compact('product','notifications'));
      return view('product.model',compact('categories'));

    }


    public function store(Request $request)
    {
        try{
       $productId = $request->product_id;
    if($image = $request ->file('image')){
        $file= $request->file('image');
        $filename=$file->getClientOriginalName();
        $file->move(public_path('image') , $filename);
   }

   $details = [
    'name_en' => $request->name_en,
    'name_ar' => $request->name_ar,
     'description_en' => $request->description_en,
     'description_ar' => $request->description_ar,
     'image' => $filename,
    'category_id' => $request->category_id,
 ];
     $input=$request->all();

       $product= Prod::updateOrCreate(['id' => $productId], $details);
      // return response()->json();
         return response()->json([$product, 'status'=>'success'],200);
       // return  response()->json([$product, 'success' => 'success', 200]);
    } catch (Exception $e) {
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
        $notifications = auth()->user()->unreadNotifications;
        $categories=Category::all();
        $product= Prod::find($id);
        // return response()->json($product);
        return view('product.model', compact('categories','product','notifications'));


    }
public function update(Request $request, $id)
{

    $products = Prod::find($id);


    if($image = $request ->file('image')){
        $file= $request->file('image');
        $filename=$file->getClientOriginalName();
        $stored_filename   = $filename;
        $file->move(public_path('image') , $filename);
       // $file_path         = storage_path('public/image');
        if (Storage::disk('local')
                  ->exists("public/image/{$stored_filename}.{$filename}"))
        {
            Storage::disk('local')
                  ->delete("public/image/{$recordSet->stored_filename}.{$extention}");
        }
       $products->image = $stored_filename;

   }
  // $myimg=$request->image;
 //  if($myimg!=$myimg){

   //}
     $products->name_en = $request->input('name_en');
     $products->name_ar = $request->input('name_ar');
     $products->description_en = $request->input('description_en');
     $products->description_ar = $request->input('description_en');
     $products->category_id = $request->input('category_id');
     //$products->image = $request->input('image');
     $res = $products->save();

    return response()->json([
         'error' => false,
         'status'=> 'success',
        // 'products'  => $products,
    ], 200);
}

    public function destroy($id)
    {

        try{

            $product = Prod::find($id);
            $res = $product->delete();
            if($res){
                return response()->json([
                    'message' => 'Category Successfully Deleted',
                    'status' => 'success',
                ],200);
            }else{
                return response()->json([
                    'message' => 'Category cannot be deleted as products exists against this category',
                    'status' => 'error',
                ]);
            }
        } catch (Exception $e) {
                return $this->response->message($e->getMessage())
                    // ->code(400)
                    ->status('error')
                    ->url('nothing Wrong')
                    ->message('Something Went wrong')

                    ->redirect();
        }




}
}
// catch(\Exception $exception) {
//     return response()->json([
//         'message' => 'Something Went wrong',
//         'status' => 'error',
//     ]);
// }