<?php

namespace App\Http\Controllers;

use App\Models\Recruitment;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    public function show($tag){
        $searched_tag = Tag::where('tag',$tag)->with('recruitments')->first(); 
        $all_recruitments = DB::table('recruitment_tag')
                                ->select(DB::raw('*'))
                                ->join('recruitments','recruitment_tag.recruitment_id','=','recruitments.id')
                                ->where('recruitment_tag.tag_id',$searched_tag->id)
                                ->where('recruitments.delete_flag',0)
                                // ->get()
                                ;

        $active_recruitments_all_column = DB::table('recruitment_tag')
                                ->select(DB::raw('*'))
                                ->join('recruitments','recruitment_tag.recruitment_id','=','recruitments.id')
                                ->where('recruitment_tag.tag_id',$searched_tag->id)
                                ->where('recruitments.delete_flag',0)
                                ->where('status',0)
                                ->get()
                                ;

        // foreach($active_recruitments_all_column as $active_recruitment )
        // {
        //     $active_recruitments[] = Recruitment::find($active_recruitment->recruitment_id);
            
        // }
        // dd($all_recruitments->toSql());
        $recruitment_query = Recruitment::query();
        $active_recruitments = [];
        if(!empty($active_recruitments_all_column)){
        foreach($active_recruitments_all_column as $active_recruitment){ 

            $active_recruitments = $recruitment_query
                                    ->orWhere(function($query) use($active_recruitment)
                                    {   
                                        // dd($active_recruitment);
                                        $query->where('id',$active_recruitment->recruitment_id);
                                    })->get();
            };
        }
        // dd($recruitment_query->toSql());
        // $active_recruitments->get();
        // dd($all_recruitments);


        return view('tag.show')->with([
            'searched_tag' => $searched_tag,
            'all_recruitments' => $all_recruitments,
            'active_recruitments' => $active_recruitments
        ]);
    }
}
