@extends('common/admins')


@section('title',$title)

@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>
            <i class="icon-table">
            </i>
            {{$title}}
        </span>
    </div>

    @if(session('success'))
    <div class="mws-form-message info">
        {{session('success')}}
    </div>
    @endif

    @if(session('error'))
        <div class="mws-form-message error">
            {{session('error')}}
        </div>
    @endif

    <div class="mws-panel-body no-padding">
        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
			
			<form action="/admins/orders" method='get'>
	            <div id="DataTables_Table_1_length" class="dataTables_length">
	                <label>
	                    显示
	                    <select size="1" name="num" aria-controls="DataTables_Table_1">
	                        <option value="10" @if($request->num == '10') selected="selected" @endif >
	                            10
	                        </option>
	                        <option value="20" @if($request->num == '20') selected="selected" @endif>
	                            20
	                        </option>
	                        <option value="30" @if($request->num == '30') selected="selected" @endif>
	                            30
	                        </option>
	                        
	                    </select>
	                    条数据
	                </label>
	            </div>
	            <div class="dataTables_filter" id="DataTables_Table_1_filter">
	                <label>
	                    商品订单:
	                    <input type="text" name='oid' aria-controls="DataTables_Table_1" value="{{$request->oid}}">
	                </label>

	                <button class='btn btn-info'>搜索</button>
	            </div>
            </form>



            <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1"
            aria-describedby="DataTables_Table_1_info">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                        style="width: 40px;">
                            ID
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"
                        style="width: 90px;">
                            商品订单
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"
                        style="width: 40px;">
                            会员昵称
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending"
                        style="width: 40px;">
                            收货人
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 60px;">
                           收货人地址
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 60px;">
                           收货人电话
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 40px;">
                           购买数量
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 70px;">
                           购买时间
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 40px;">
                           总金额
                        </th>>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 40px;">
                           状态
                        </th>
                        
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 40px;">
                           商品详情
                        </th>
                        
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 70px;">
                           操作
                        </th>
                    </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($rs as $k => $v)
                	@if($k % 2 == 0)
 						<tr class="odd">
                	@else
 						<tr class="even">
						
                	@endif
                  
                        <td class="">
                            {{$v->id}}
                        </td>
                        <td class=" ">
                            {{$v->oid}}
                        </td>

                        <td class=" ">
                            {{DB::table('message')->where('id',$v->uid)->value('mname')}}
                        </td>
        
                        <td class=" ">
                            {{$v->oname}}
                            
                        </td>
                        <td class=" ">
                            {{$v->address}}
                            
                        </td>
                        <td class=" ">
                            {{$v->phone}}
                            
                        </td>
                        <td class=" ">
                            {{$v->num}}
                            
                        </td>
                       <td class=" ">
                            
                            {{date('Y-m-d H:i:s',$v->addtime)}}
                        </td>
                        <td class=" ">
                            {{$v->total}}
                            
                        </td>
                        <td class=" ">
                            
                            <div class="btn-group">
                                <select class="btn btn-primary dropdown-toggle one">                                   
                                    <option value="0" @if($v->status == 0) selected="selected" @endif>新订单</option>
                                    <option value="1" @if($v->status == 1) selected="selected" @endif>已发货</option>
                                    <option value="2" @if($v->status == 2) selected="selected" @endif>已收货</option>
                                    <option value="3" @if($v->status == 3) selected="selected" @endif>无效订单</option>
                                </select>
                            </div>
                        </td>
                        <td class=" ">
                             <a class='btn btn-info' href="/admins/detail/{{$v->oid}}">商品详情</a>
                        </td>
                        
                        <td class=" ">
                            <a class='btn btn-warning' href="/admins/orders/{{$v->id}}/edit">修改</a>


                            <form action="/admins/orders/{{$v->id}}" method='post' style='display: inline'>
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button class='btn btn-danger'>删除</button>
                            </form>
                        </td>	
                    </tr>
                    @endforeach

                </tbody>
            </table>
			
			<style>
				.pagination{

					margin:0px;
				}

				.pagination li{
					    float: left;
					    height: 20px;
					    padding: 0 10px;
					    display: block;
					    font-size: 12px;
					    line-height: 20px;
					    text-align: center;
					    cursor: pointer;
					    outline: none;
					    background-color: #444444;
					   
					    text-decoration: none;
					    border-right: 1px solid rgba(0, 0, 0, 0.5);
					    border-left: 1px solid rgba(255, 255, 255, 0.15);
					    box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.5), inset 0px 1px 0px rgba(255, 255, 255, 0.15);
				}

				.pagination a{
					 color: #fff;
				}

				.pagination .active{
					
					color: #323232;
				    border: none;
				    background-image: none;
				    box-shadow: inset 0px 0px 4px rgba(0, 0, 0, 0.25);
				    background-color: #f08dcc;
				}


			</style>


            <div class="dataTables_info" id="DataTables_Table_1_info">
                显示 {{$rs->firstItem()}} to {{$rs->lastItem()}} of {{$rs->count()}} 条数据  总共是{{$rs->total()}}条数据
            </div>
            <div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate">

				{{$rs->appends($request->all())->links()}}

                
            </div>
        </div>
    </div>
</div>

@stop

@section('js')
    <script>
        setTimeout(function(){
            $('.mws-form-message').hide(1200)
        },2000) 

        $(".one").change(function(){
            var $pogr = $(this).children('option:selected').val();
            //获取用户的id
            var $oid = $(this).parents('tr').find('td').eq(0).text().trim();
            //发送ajax
            $.get('/admins/ajaxorders',{status:$pogr,oid:$oid},function(data){

                if(data == '1'){
                    alert('订单状态修改成功');
                } else {
                    alert('订单状态修改失败');
                }
            })
        })
    </script>
@stop

