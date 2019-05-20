@extends('common.admins')

@section('title', '修改分类页面')

@section('content')
<div class="mws-panel grid_8">
	<div class="mws-panel-header">
    	<span><i class="icon-pencil"></i>{{$title}}</span>
    </div>
    <div class="mws-panel-body no-padding">
    @if (count($errors) > 0)
	    <div class="mws-form-message error">
	        <ul>
	            @foreach ($errors->all() as $error)

	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif
    	<form class="mws-form" action="/admin/type" method="post">
        	<div class="mws-form-inline">
            	<div class="mws-form-row">
                    <label class="mws-form-label">
                        分类名
                    </label>
                    <div class="mws-form-item">
                        <input type="text" class="small" value="{{$rs->tname}}" name='tname'>
                    </div>
                </div>
            	<div class="mws-form-row">
                    <label class="mws-form-label">
                        分类列表
                    </label>
                    <div class="mws-form-item">
                        <select class="small" name='pid' disabled>
                            <option value='0' selected>
                                请选择
                            </option>
                            @foreach($res as $k=>$v)
                                @if($rs->pid == $v->id)
                                <option value='{{$v->id}}' selected="selected">
                                    {{$v->tname}}
                                </option>
                                @else
                                <option value='{{$v->id}}'>
                                    {{$v->tname}}
                                </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            	<div class="mws-form-row">
                    <label class="mws-form-label">
                        状态
                    </label>
                    <div class="mws-form-item clearfix">
                        <ul class="mws-form-list inline">
                            <li>
                                <label><input type="radio" name='status' value='1' checked>
                                
                                    启用
                                </label>
                            </li>
                            <li>
                                <label><input type="radio" name='status' value='0'>
                                
                                    禁用
                                </label>
                            </li>
                           
                        </ul>
                    </div>
                </div>
                {{csrf_field()}}
				<button class="btn pagin">添加</button>
            </div>
        </form>
    </div>    	
</div>
@stop

@section('js')
<script>
	setTimeout(function(){
		$('.mws-form-message').slideUp(2000);
	},3000);
	
</script>
@stop