<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Type;
use DB;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*if(empty($_GET['pid'])){
            $map['pid'] = 0;
        } else {
            $map['pid'] = $_GET['pid'];
        }
        $rs = Type::where('pid',$map['pid'])->orderBy('id', 'desc')->get();
        // echo 1;
        // var_dump($rs);
        // dump($rs);
        return view('admin.typelist', [
            'title'=>'浏览分类',
            'rs'=>$rs
            ]);*/
        $rs = Type::select(DB::raw('*,concat(path,id) as paths'))->where('tname', 'like', '%'.$request->tname.'%')->orderBy('paths', 'asc')->paginate($request->input('num', 10));
        // dump($rs);
        foreach($rs as $k => $v){
            // 重复次数
            $num = substr_count($v->path, ',')-1;

            // 新名字
            $v->tname = str_repeat('|--', $num).$v->tname;
        }

        return view('admin.type.typelist',[
            'title'=>'分类的列表页面',
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
        // 第一种方法
        /*if($_GET['pid'] == 0){
            $pid = 0;
            $path = '0,';
        } else {
            $pid= $_GET['pid'];
            $path = $_GET['path'].$pid.',';
        }
        return view('admin.typecreate', ['title'=>'分类添加','pid'=>$pid,'path'=>$path]);*/
        $rs = Type::select(DB::raw('*,concat(path,id) as paths'))->orderBy('paths', 'asc')->get();
        // dd($rs);
        foreach($rs as $k => $v){
            // 字符出现的次数
            $num = substr_count($v->path, ',')-1;
            // 改变样式
            $v->tname = str_repeat('|--', $num).$v->tname;
        }
        // dd($rs);
        return view('admin.type.typecreate', [
                'title' => '添加分类',
                'rs' => $rs
            ]);
    }

    /**
     * ajax
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxup()
    {
        // echo 1;
        // var_dump($request);die;
        // 获取ajax发送的数据
        // echo $_GET['name'];
       dump($_GET);
       /* $rs = $request->only('tname');

        $id = $request->id;
        $res = Type::where('id', $id)->update($rs);
        // echo $res;
        if($res){
            echo 1;
        } else {
            echo 0;
        }*/

        // dump($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // var_dump($_POST);
        $this->validate($request, [
                'tname' => 'required'
            ], [
                'tname.required' => '分类名称不能为空'
            ]);
        // $rs = $request->method();
        // dd($_POST);
        $rs = $request->except(['_token']);
        // dd($rs);
        if($request->pid == '0'){

            $rs['path'] = '0,';
        } else {
            //根据pid进行查询数据
            $res = Type::where('id',$request->pid)->first();

            //拼接path路径
            $rs['path'] = $res->path.$res->id.',';
        }
        // dd($rs);
        try{
           
            $data = Type::create($rs);

            if($data){

                return redirect('/admin/type')->with('success','添加成功');
            }
        }catch(\Exception $e){

            return back()->with('error','添加失败');

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
        $rs = Type::find($id);
        $res = Type::select(DB::raw('*,concat(path,id) as paths'))->orderBy('paths', 'asc')->get();
        // dd($rs);
        foreach($res as $k => $v){
            // 字符出现的次数
            $num = substr_count($v->path, ',')-1;
            // 改变样式
            $v->tname = str_repeat('|--', $num).$v->tname;
        }
        return view('admin.type.typeupdate', [
                'title'=>'分类的修改页面',
                'rs' => $rs,
                'res'=>$res
            ]);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //根据id查询  你底下是否有其他的子分类
        $res = Type::where('id', $id)->first();

        //如果有的话的就删除
        $rs = Type::where('path','like','%'.$res->path.$res->id.',%')->delete();

        if(!$rs){

            echo '删除子类失败';
        }

        //删除完子分类的信息  就删除自己
        //如果查不到底下有其他的子分类  那么就直接删除自己
        $data = Type::destroy($id);

        //判断
        if($data){

            return redirect('/admin/type')->with('success','删除成功');
        } else {

            return back()->with('error','删除失败');
        }
    }
}
