<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news=News::all();
        if($news->first())
        {
            foreach($news as $ANews)
            {
                $data[]=array("id"=> $ANews->id,"text"=>$ANews->text, "admin"=>$ANews->admin_id,
                "date"=>$ANews->created_at->format('d/m/Y'));
            }
        return response()->json(collect($data)->sortByDesc('id')->values());
        }    }

    public function getActive()
    {
        $news=News::where('is_active', '=', 1)->get();
        if($news->first())
        {
            foreach($news as $ANews)
            {
                $data[]=array("id"=> $ANews->id,"text"=>$ANews->text, "admin"=>$ANews->admin_id,
                "date"=>$ANews->created_at->format('d/m/Y'));
            }
        return response()->json(collect($data)->sortByDesc('id')->values());
        }

    }

    public function show($id)
    {
        $news=News::find($id);
        $data=array("id"=> $news->id,"text"=>$news->text, "admin"=>$news->admin_id,
                "date"=>$news->created_at->format('d/m/Y'), "active_flag"=>$news->is_active);
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation= \Validator::make($request->all(),[
            'admin_id'=>'required',
            'text'=>'required',

        ]);

        if ($validation->fails())
            return response()->json("Invalid_Data");

        $news= new News();
        $news->admin_id=$request->admin_id;
        $news->text=$request->text;

        $news->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation= \Validator::make($request->all(),[
            'admin_id'=>'required',
            'text'=>'required',
            'is_active'=>'required'

        ]);

        if ($validation->fails())
            return response()->json("Invalid_Data");
        $news=News::find($id);
        $news->admin_id=$request->admin_id;
        $news->text=$request->text;
        $news->is_active=$request->is_active;

        $news->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news=News::find($id);
        $news->delete();
    }
}
