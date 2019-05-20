<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Poster;

class PosterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;

        //获取数据
        $rs = Poster::where('postername','like','%'.$search.'%')->paginate($request->input('num',10));


        //显示一个列表页
        return view('admin.poster.list',[
            'title'=>'广告的列表页面',
            'rs'=>$rs,
            'request'=>$request

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加页面 
        return view('admin/poster/create',[
            'title'=>'后台的广告添加页面'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //表单验证
        $this->validate($request, [
            'postername' => 'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{3,12}$/u',
            'content' => 'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{3,30}$/u',
            'url' => 'required',
        ],[
            'postername.required' => '广告商家名不能为空',
            'postername.regex' => '广告商家名格式不正确',

            'content.required'=>'广告内容不能为空',
            'content.regex'=>'广告内容格式不正确',

            'url.required'=>'广告图片不能为空'
        ]);

        //获取表单传过来的信息 返回的数据是一个数组
        $rs = $request->except('_token','url');

        //处理图片上传
        if($request->hasFile('url')){

            //获取图片上传的信息
            $file = $request->file('url');

            //名字
            $name = 'img_'.rand(1111,9999).time();

            //获取后缀
            $suffix = $file->getClientOriginalExtension();

            $file->move('./uploads',$name.'.'.$suffix);

            $rs['url'] = '/uploads/'.$name.'.'.$suffix;

        }

        //广告等级为普通广告
        $rs['pograde'] = 0;

        //加入时间
        $rs['addtime'] = time();
        
        //写入表中
        $data = Poster::create($rs);

        if($data){
            return redirect('admins/poster');
        } else {
            return back();
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
        //根据id获取数据
        $rs = Poster::find($id);

        //显示页面
        return view('admin.poster.edit',[
            'title'=>'广告的修改页面',
            'rs'=>$rs
        ]);


    }

    /**
     * ajax修改
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxposter(Request $request)
    {
        //获取ajax传过来的数据
        $rs = $request->only('pograde');

        $pid = $request->pid;

        $res = Poster::where('id',$pid)->update($rs);

        if($res){
            echo 1;
        } else {
            echo 0;
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
        //表单验证
        $this->validate($request, [
            'postername' => 'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{3,12}$/u',
            'content' => 'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{3,30}$/u',
            'url' => 'required',
            
        ],[
            'postername.required' => '广告商家名不能为空',
            'postername.regex' => '广告商家名格式不正确',

            'content.required'=>'广告内容不能为空',
            'content.regex'=>'广告内容格式不正确',

            'url.required'=>'广告图片不能为空'
        ]);

        //删除头像
        $res = Poster::find($id);
        $data = @unlink('.'.$res->url);
        if(!$data){
            return back()->with('error','修改失败');
        }
        //获取数据
        $rs = $request->except('_token','_method');

        //处理头像
        if($request->hasFile('url')){

            //获取图片上传的信息
            $file = $request->file('url');

            //名字
            $name = 'img_'.rand(1111,9999).time();

            //获取后缀
            $suffix = $file->getClientOriginalExtension();

            $file->move('./uploads',$name.'.'.$suffix);

            $rs['url'] = '/uploads/'.$name.'.'.$suffix;

        }

        //修改数据
        $data = Poster::where('id',$id)->update($rs);

        if($data){

            return redirect('/admins/poster')->with('success','修改成功');
        } else {

            return back()->with('error','修改失败');
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
        //删除头像
        $res = Poster::find($id);
        $data = @unlink('.'.$res->url);
        if(!$data){
            return back()->with('error','修改失败');
        }

        //根据id删除数据
        $data = Poster::destroy($id);

        if($data){

            return redirect('/admins/poster')->with('success','删除成功');
        } else {

            return back()->with('error','删除失败');

        }
    }
}
