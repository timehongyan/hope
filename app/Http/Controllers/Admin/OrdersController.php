<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Orders;
use App\Model\Admin\Detail;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->oid;

        //获取数据
        $rs = Orders::where('oid','like','%'.$search.'%')->paginate($request->input('num',10));

        //显示一个列表页
        return view('admin.orders.list',[
            'title'=>'订单的列表页面',
            'rs'=>$rs,
            'request'=>$request,
            // 'DB'=>$DB

        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($oid)
    {
        //获取数据
        $rs = Detail::with('ord')->where('oid',$oid)->paginate(10);
        //显示一个列表页
        return view('admin.detail.list',[
            'title'=>'订单详情的列表页面',
            'rs'=>$rs,
        ]);
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
        $rs = Orders::find($id);

        //显示页面
        return view('admin.orders.edit',[
            'title'=>'订单的修改页面',
            'rs'=>$rs
        ]);
        
    }

    /**
     * ajax修改
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxorders(Request $request)
    {
        //获取ajax传过来的数据
        $rs = $request->only('status');

        $oid = $request->oid;

        $res = Orders::where('id',$oid)->update($rs);

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
            'oname' => 'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{3,6}$/u',
            'address' => 'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{2,20}$/u',
            'phone' => 'required|regex:/^1[2-9][0-9]{9}/',
        ],[
            'oname.required' => '收货人不能为空',
            'oname.regex' => '收货人格式不正确',

            'address.required'=>'收货人地址不能为空',
            'address.regex'=>'收货人地址格式不正确',

            'phone.required'=>'收货人电话不能为空',
            'phone.regex'=>'收货人电话格式不正确',

        ]);
        //获取数据
        $rs = $request->except('_token','_method');

        //修改数据
        $data = Orders::where('id',$id)->update($rs);

        if($data){

            return redirect('/admins/orders')->with('success','修改成功');
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
        $rs = Orders::find($id);
        //删除订单时删除订单详情
        $det = Detail::where('oid', $rs->oid)->delete();

        if(!$det){
            return back()->with('error','删除失败');
        }
        //根据id删除数据
        $data = Orders::destroy($id);

        if($data){

            return redirect('/admins/orders')->with('success','删除成功');
        } else {

            return back()->with('error','删除失败');

        }
    }
}
