<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Goods;
use App\Http\Requests\GoodsRequest;
use App\Model\Admin\Type;

use DB;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $num = $request->num;
        $search = $request->search;
        // dd($search);
        $rs = Goods::where('gname', 'like', '%'.$search.'%')->orderBy('id', 'asc')->paginate($request->input('num', 10));
        return view('admin.goods.goodslist', ['title'=>'浏览商品', 'rs'=>$rs, 'request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $rss = DB::select('select * from type order by CONCAT(path,id) asc');
        return view('admin.goods.goodscreate', ['title'=>'添加商品','rs'=>$rss]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GoodsRequest $request)
    {
        $rs = $request->except('_token','gpic');
        $rs['addtime'] = time();
        $rs['num'] = 0;
        // 多文件上传
        if($request->hasFile('gpic')){
            $file = $request->file('gpic');
            $arr = [];
            foreach($file as $k=>$v){
                // 图片的新名字
                $name = md5('img_'.rand(1111,9999).time());
                // 获取文件后缀
                $suffix = $v->getClientOriginalExtension();
                // 文件上传
                $v->move('./uploads',$name.'.'.$suffix);
                $arr[] = '/uploads/'.$name.'.'.$suffix;
            }
            $rs['gpic'] = implode(',', $arr);
        }
        $res = Goods::create($rs);
        if($res){
            return redirect('/admin/goods');
        } else {
            unlink($rs['gpic']);
            return back();
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
        $rs = Goods::find($id);
        $gpic = explode(',', $rs['gpic']);
        return view('admin.goods.goodsone', ['title'=>'商品详情','rs'=>$rs, 'gpic'=>$gpic]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rs = DB::select('select * from type order by CONCAT(path,id) asc');
        $val = Goods::find($id);
        return view('admin.goods.goodsupdate', ['title'=>'修改商品信息','rs'=>$rs,'val'=>$val]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GoodsRequest $request, $id)
    {
        $rs = $request->except('_token', 'gpic', '_method');
        if($request->hasFile('gpic')){
            $file = $request->file('gpic');
            $arr = [];
            foreach($file as $k=>$v){
                // 图片的新名字
                $name = md5('img_'.rand(1111,9999).time());
                // 获取文件后缀
                $suffix = $v->getClientOriginalExtension();
                // 文件上传
                $v->move('./uploads',$name.'.'.$suffix);
                $arr[] = '/uploads/'.$name.'.'.$suffix;
            }
            $rs['gpic'] = implode(',', $arr);
        }
        $res = Goods::where('id',$id)->update($rs);
        if($res){
            return redirect('/admin/goods');
        } else {
            unlink($rs['gpic']);
            return back();
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
        $rs = Goods::find($id);
        $rss = explode(',',$rs['gpic']);
        $data = Goods::where('id',$id)->delete();
        if($data){
            foreach($rss as $k => $v){
                unlink('.'.$v);
            }
            return redirect('/admin/goods');
        }else{
            return back();
        }
    }
}
