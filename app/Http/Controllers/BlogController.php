<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\DataTables\BlogDataTable;
use Yajra\DataTables\Html\Builder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder, BlogDataTable $dataTable, Request $request)
    {
        $html = $builder->columns([
            ['data' => 'blog_id', 'name' => 'blog_id','title' => 'ID'],
            ['data' => 'name', 'name' => 'name','title' => 'Blog Name'],
            ['data' => 'category_id', 'name' => 'category_id','title' => 'Category'],
            ['data' => 'status', 'name' => 'status','title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at','title' => 'Scaned At'],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'searchable' => false,'title' => 'Action'],
        ])->parameters([
            'order' => [0,'desc'],
            'scrollX' => true,
        ]);

        $blog = Blog::where('user_id',$request->user()->id)->get();

        if ($request->from_date && $request->to_date) {
            $blog = $blog->where('created_at','>=',$request->from_date)->where('created_at','<=',$request->to_date);
        }

        if(request()->ajax()) {
            return $dataTable->dataTable($blog)->toJson();
        }
        return view('blog.list',compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('status','1')->get();
        return View('blog.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'category_id' => 'required',
        );
        $messages = [
            'name.required' => 'Please enter blog name.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        // dd($validator->fails());
        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        } else {

            if($request->category_id) {
                $categories = $request->category_id;
                $categories = implode(',', $categories);
            } else {
                $categories = null;
            }

                $blog = new Blog();
                $blog->name = $request['name'];
                $blog->user_id = $request->user()->id;
                $blog->status = '1';
                $blog->category_id = $categories;

            }
            if(!empty($request->main_image) || $request->main_image != ''){
                $data = explode(';', $request->main_image);
                $part = explode("/", $data[0]);
                $image = $request->main_image;  // your base64 encoded
                $image = str_replace('data:image/'.$part[1].';base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $fileName = md5(microtime().Str::random(10)) .'.'.$part[1];
                $destinationPath = base_path().'/resources/uploads/blog_image/';
                \File::put(base_path().'/resources/uploads/blog_image/' .$fileName, base64_decode($image));
                chmod($destinationPath.$fileName,0777);
                $blog->image = $fileName;
                $image = url('/').'/resources/uploads/blog_image/'.$fileName;

            }else{
                $image='';
            }

            if ($blog->save()) {
                Session::flash('message', 'New Blog added succesfully !');
                Session::flash('alert-class', 'success');
                return redirect('blog');

            } else {
                Session::flash('message', 'Oops !! Something went wrong!');
                Session::flash('alert-class', 'error');
                return redirect('blog');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::find($id);
        if(!empty($blog)){
            $blog->category_id = explode(",",$blog->category_id) ;

            $category = Category::where('status','1')->whereIn('category_id',$blog->category_id)->get();

            return view('blog.view')->with(compact('blog','category'));
        }else{
            Session::flash('message', 'Blog not found!');
            Session::flash('alert-class', 'error');
            return redirect('blog');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);
        if(!empty($blog)){
            $category = Category::where('status','1')->get();
            $blog->category_id = explode(",",$blog->category_id) ;

            return view('blog.edit')->with(compact('blog','category'));
        }
        else{
            Session::flash('message', 'Blog not found!');
            Session::flash('alert-class', 'error');
            return redirect('blog');
        }
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
       $rules = array(
            'name' => 'required',
            'category_id' => 'required',
        );
        $messages = [
            'name.required' => 'Please enter blog name.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        } else {

            if($request->category_id) {
                $categories = $request->category_id;
                $categories = implode(',', $categories);
            } else {
                $categories = null;
            }
                $blog = Blog::find($id);
                $blog->name = $request['name'];
                $blog->user_id = $request->user()->id;
                $blog->category_id = $categories;
            }


            if(!empty($request->main_image) || $request->main_image != ''){
            $data = explode(';', $request->main_image);
            $part = explode("/", $data[0]);
            $image = $request->main_image;  // your base64 encoded
            $image = str_replace('data:image/'.$part[1].';base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $fileName = md5(microtime().Str::random(10)) .'.'.$part[1];
            $destinationPath = base_path().'/resources/uploads/blog_image/';
            \File::put(base_path().'/resources/uploads/blog_image/' .$fileName, base64_decode($image));
            chmod($destinationPath.$fileName,0777);
            $blog->image = $fileName;
            $image = url('/').'/resources/uploads/blog_image/'.$fileName;

            }else{
                $image='';
            }


            if ($blog->save()) {
                Session::flash('message', 'Blog Updated succesfully !');
                Session::flash('alert-class', 'success');
                return redirect('blog');

            } else {
                Session::flash('message', 'Oops !! Something went wrong!');
                Session::flash('alert-class', 'error');
                return redirect('blog');
            }
        
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(isset($id)){

            $user = Blog::find($id);

            if($user->delete())
            {
                 return true;
            }
             else
                return 'Something went to wrong';
        }
    }

    public function changeStatus(Request $request)
    {
        return $this->UpdateStatus($request->id,Blog::class,'status');
    }
}
