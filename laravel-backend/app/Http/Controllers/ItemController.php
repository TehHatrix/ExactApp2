<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('item')->get();
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
            $validator = Validator::make($request->all(), [
            'code' => 'numeric|required',
            'category' => 'string|required',
            'description' => 'string|required',
            'price' => 'numeric|required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
        $data = $validator->validated();
        $createItem = DB::table('item')->insert([
            'code' =>  $data['code'],
            'category' => $data['category'],
            'description' =>  $data['description'],
            'price' => $data['price'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return $createItem;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    // public function update(Request $request, $projectid)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'html' => 'string|nullable',
    //         'css' => 'string|nullable',
    //         'landingName' => 'string|required',
    //         'landingRevGoal' => 'numeric|required'
    //     ]);
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'errors' => $validator->errors()
    //         ]);
    //     }

    //     $data = $validator->validated();
    //     $updateDetails = [
    //         'landingHTML' => $data['html'],
    //         'landingCSS' => $data['css'],
    //     ];
    //     DB::table('landing_pages')->where('projectID',$projectid)->update($updateDetails);
    // }
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($code){
        DB::table('item')->where('code',$code)->delete();
        return response()->json(['success' => true, 'message' => 'successfully deleted']);
    }
}
