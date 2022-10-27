<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use DataTables;
use Validator;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $notifications = auth()->user()->unreadNotifications;
        
        if ($request->ajax()) {
            $data = Document::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit">Edit</a>';
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-method="get"  data-url="' .route('documents.destroy', $row->id).'" data-original-title="Delete" class="btn btn-danger btn-sm delete1">Delete</a>';
                            return $btn;
                    })
                    ->addColumn('image', function ($row) {
                        $url= asset('image/'.$row->image);
                        $new= '<img src="'.$url.'"  width="50" align="center">';
                        return $new;
                    })
                    ->rawColumns(['action', 'image'])
                    ->make(true);
        }

        return view('document.index',compact('notifications'));
    }
    public function create()
    {
        return view('documents.model');
    } 
    public function store(Request $request)
    { 
        try{
            $filename="";
            $imageId = $request->image_id;
            if($image = $request ->file('image')){
                $file= $request->file('image');
                $filename=$file->getClientOriginalName();
               Storage::disk('local')->putFile('uploads', $request->file('image'));

            }
            $details = [
            'image' => $filename,
            ];
                   $input=$request->all();
            $product= Document::updateOrCreate(['id' => $imageId], $details);
              return response()->json([$product, 'status'=>'success'],200);
         } catch (Exception $e) {
             return $this->response->message($e->getMessage())
                 ->message('Something Went wrong');
                
     }
    

    }
    

    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $image = Document::find($id);
        return response()->json($image);
    }

    
    public function destroy($id,Request $request )
    {
        try{
        // $image = Document::find($id)->delete();
        $image = Document::find($id);
        $res = $image->delete();
        return response()->json([
            'status' => 'success',
        ],200);
    }
         catch (Exception $e) {
            return $this->response->message($e->getMessage())
             ->message('Something Went wrong');
       }
    }
}