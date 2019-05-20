@extends('common.admins')
@section('title', '商品详情')

@section('content')
<div class="mws-panel-body no-padding">
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
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
		                生产厂家
		            </th>
		            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
		            rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"
		            style="width: 100px;">
		                简介
		            </th>
		            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
		            rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
		            style="width: 87px;">
		                添加时间
		            </th>
		            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
		            rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
		            style="width: 150px;">
		                图片
		            </th>
		        </tr>
		    </thead>
		    <tbody role="alert" aria-live="polite" aria-relevant="all">
		        <tr class="odd" align="center">
		            <td class="  sorting_1">
		               {{$rs->id}}
		            </td>
		            <td class=" ">
		                {{$rs->company}}
		            </td>
		            <td class=" ">
		                {{$rs->descr}}
		            </td>
		            <td class=" ">
		            	@php
		                	echo date('Y-m-d H:i:s',$rs->addtime);
		                @endphp
		            </td>
		            <td class=" ">
						<div class="mws-panel-body">
	                		<ul class="thumbnails mws-gallery">
	                			<li>
	                            	<span class="thumbnail">
	                            		@foreach($gpic as $v)
	                            		<img src="{{$v}}" alt="">
	                            		@endforeach
	                            	</span>
	                                <span class="mws-gallery-overlay">
	                                    <a href="{{$v}}" rel="prettyPhoto[gallery1]" class="mws-gallery-btn"><i class="icon-search"></i></a>
	                                    <!-- <a href="#" class="mws-gallery-btn"><i class="icon-pencil"></i></a>
	                                    <a href="#" class="mws-gallery-btn"><i class="icon-trash"></i></a> -->
	                                </span>
	                			</li>                   			
	                		</ul>
	                    </div>
		            </td>
		        </tr>
		    </tbody>
		</table>
	</div>
</div>
@stop