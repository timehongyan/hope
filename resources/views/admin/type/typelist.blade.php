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
    

    <div class="mws-panel-body no-padding">
        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
            
            <form action="/admin/type" method='get'>
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
                        分类名:
                        <input type="text" name='tname' aria-controls="DataTables_Table_1" value="{{$request->tname}}">
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
                        style="width: 20px;">
                            ID
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"
                        style="width: 90px;">
                            分类名
                        </th>
                      
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending"
                        style="width: 90px;">
                            父级id
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 97px;">
                           路径
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 50px;">
                           状态
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 97px;">
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
                            {{$v->tname}}
                        </td>
                        <td class=" ">
                            <!-- 自定义函数 -->
                            
                            {{getCateName($v->pid)}}
                        </td>
                        <td class=" ">
                            {{$v->path}}
                            
                        </td>
                       
                        <td class=" ">
                            
                            @if($v->status == 1)
                                开启
                            @else
                                禁用
                            @endif
                            

                            {{--$v->status ? '开启' : '禁用'--}}

                            <!-- 自定义函数 -->
                            
                        </td>
                        <td class=" ">
                            
                            <a class='btn btn-warning' href="/admin/type/{{$v->id}}/edit">修改</a>


                            <form action="/admin/type/{{$v->id}}" method='post' style='display: inline'>
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
  </script>
@stop