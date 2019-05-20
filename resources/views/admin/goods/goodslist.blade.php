@extends('common.admins')

@section('title', '商品浏览')

@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>
            <i class="icon-table">
            </i>
           {{$title}}
        </span>
    </div>
    <div class="mws-panel-body no-padding">
        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
        <form action="/admin/goods" method="get">
                <div id="DataTables_Table_1_length" class="dataTables_length">
                    <label>
                        Show
                        <select size="1" name="num" aria-controls="DataTables_Table_1">
                            <option value="10" @if($request->num == 10)selected="selected" @endif>
                                10
                            </option>
                            <option value="20" @if($request->num == 20)selected="selected" @endif>
                                20
                            </option>
                            <option value="30" @if($request->num == 30)selected="selected" @endif>
                                30
                            </option>
                        </select>
                        entries
                    </label>
                </div>
                <div class="dataTables_filter" id="DataTables_Table_1_filter">
                    <label>
                        Search:
                        <input type="text" name="search" aria-controls="DataTables_Table_1" value="{{$request->search}}">
                        <button class="btn">搜索</button>
                    </label>
                </div>
            </form>
            <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1"
            aria-describedby="DataTables_Table_1_info">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                        style="width: 20px;">
                            ID
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"
                        style="width: 50px;">
                            类别
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"
                        style="width: 100px;">
                            商品名称
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"
                        style="width: 100px;">
                            单价
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 87px;">
                            状态
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 50px;">
                            库存量
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 87px;">
                            被购买数量
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 100px;">
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
					@foreach($rs as $k=>$v)
					@if($k % 2 == 0)
                    <tr class="odd" align="center">
                    @else
					<tr class="even" align="center">	
                    @endif
                        <td class="  sorting_1">
                           {{$v->id}}
                        </td>
                        <td class=" ">
                            {{$v->tid}}
                        </td>
                        <td class=" ">
                            {{$v->gname}}
                        </td>
                         <td class=" ">
                            {{$v->price}}元
                        </td>
                        <td class=" ">
                            <div class="mws-form-row">
                                <div class="mws-form-item">
                                    <select class="large">
                                    @switch($v->status)
                                    	@case(1)
                                        	<option>新添加</option>
                                        	@break
                                        @case(2)
                                        	<option>在售</option>
                                        	@break
                                        @case(3)
                                        	<option>已下架</option>
                                        	@break
                                    @endswitch
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td class=" ">
                            {{$v->stock}}
                        </td>
                        <td class=" ">
                           {{$v->num}}
                        </td>
                        <td class=" ">
                        	<!-- <a href="" class="btn">查看商品详情</a>
                            <a href="" class="btn">修改</a>
                            <a href="" class="btn">删除</a> -->

                            <span class="btn-group">
                                <a href="/admin/goods/{{$v->id}}" class="btn btn-small"><i class="icon-search"></i></a>
                                <a href="/admin/goods/{{$v->id}}/edit" class="btn btn-small"><i class="icon-pencil"></i></a>
                                <form class="btn btn-small" action="/admin/goods/{{$v->id}}" method="post">
									{{ method_field('DELETE') }}
									{{csrf_field()}}
									<button class="icon-trash"></button>
                                </form>
                                <!-- <a href="#" class="btn btn-small"><i class="icon-trash"></i></a> -->
                            </span>

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