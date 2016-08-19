<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use DB;
use Redirect;
session_start();
class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct() {
        $admin_id=Session::get('admin_id');
        if($admin_id == NULL)
        {
            return Redirect::to('/adda')->send();
        }
        
    }
    
    
    public function index()
    {
       $admin_dashboard=view('admin.pages.admin_dashboard');
        return view('admin.admin_master')
                ->with('admin_main_content',$admin_dashboard);
    }

     public function add_category()
     {
        $category_page=view('admin.pages.add_category');
        return view('admin.admin_master')
                ->with('admin_main_content',$category_page);
     }

     public function save_category(Request $request)
     {
        $data=array();
        $data['category_name']=$request->category_name;
         $data['category_description']=$request->category_description;
          $data['publication_status']=$request->publication_status;
          // echo '<pre>';
          // print_r($data);
          DB::table('tbl_category')->insert($data);
          Session::put('message',"Save Category Information successfully");
          return Redirect::to('/add-category');

      }
      public function manage_category()

      {
              $category_info = DB::table('tbl_category')
                            ->where('deletion_status',0)
                             ->get();
             $manage_category=view('admin.pages.manage_category')
                              ->with('all_category',$category_info);
                  return view('admin.admin_master')
                ->with('admin_main_content',$manage_category);
      }
      public function published_category($id)
    {
        DB::table('tbl_category')
            ->where('id', $id)
            ->update(['publication_status' => 1]);
         return Redirect::to('/manage-category');
    }
     public function unpublished_category($id)
    {
        DB::table('tbl_category')
            ->where('id', $id)
            ->update(['publication_status' => 0]);
         return Redirect::to('/manage-category');
    }

    public function delete_category($id)
    {
         // DB::table('tbl_category')
         //    ->where('id', $id)
         //    ->update(['deletion_status' => 1]);
        DB::table('tbl_category')
        ->where('id',$id)
        ->delete();
         return Redirect::to('/manage-category');
    }

    public function edit_category($id)
    {
      $category_info_by_id = DB::table('tbl_category')
                        ->where('id',$id)
                        ->first();
      $edit_category=view('admin.pages.edit_category')
                    ->with('category_info',$category_info_by_id);
      return view('admin.admin_master')
                ->with('admin_main_content',$edit_category);
    }

    public function update_category(Request $request)
    {
        $data=array(); 
        $id=$request->id;
        $data['category_name']=$request->category_name;
        $data['category_description']=$request->category_description;
        $data['publication_status']=$request->publication_status;
       DB::table('tbl_category')
            ->where('id', $id)
            ->update($data);
         return Redirect::to('/manage-category');
    }
    public function add_news()
    {
          $all_published_category = DB::table('tbl_category')
                                   ->where('publication_status',1)
                                   ->where('deletion_status',0)
                                   ->get(); 
        $add_news=view('admin.pages.add_news')
                           ->with('published_category',$all_published_category);
        return view('admin.admin_master')
                  ->with('admin_main_content',$add_news);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }
    public function logout()
    {
        Session::put('admin_id','');
        Session::put('admin_name','');
        Session::put('message','You are successfully logout !');
        return Redirect::to('/adda');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
