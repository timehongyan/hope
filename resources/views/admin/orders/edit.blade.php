@extends('common/admins')

@section('title',$title)

@section('content')
	<div class="mws-panel grid_8">
    	<div class="mws-panel-header">
        	<span>{{$title}}</span>
        </div>

        @if (count($errors) > 0)
		    <div class="mws-form-message error">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif

		<div class="mws-panel-body no-padding">
        	<form class="mws-form" action="/admins/orders/{{$rs->id}}" method='post'>
        		<div class="mws-form-inline">
        			<div class="mws-form-row">
                        <label class="mws-form-label">收货人</label>
                        <div class="mws-form-item" style="width:50%">
                            <input type="text" name='oname' class="small" value="{{$rs->oname}}">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">收货人地址</label>
                        <div class="mws-form-item">
                            <input type="text" name='address' class="small" value="{{$rs->address}}">
                        </div>
                    </div>
                    <div class="mws-form-row">
        				<label class="mws-form-label">收货人电话</label>
        				<div class="mws-form-item">
        					<input type="text" name='phone' class="small" value="{{$rs->phone}}">
        				</div>
        			</div>

                    <div class="mws-form-row">
        				<label class="mws-form-label">状态</label>
	        				<div class="mws-form-item clearfix">
	        					<ul class="mws-form-list inline">
	        						<li><label><input type="radio" name='status' value='0' @if($rs->status==0)checked @endif> 新订单</label></li>
	        						<li><label><input type="radio" name='status' value='1' @if($rs->status==1)checked @endif> 已发货</label></li>
	        						<li><label><input type="radio" name='status' value='2' @if($rs->status==2)checked @endif> 已收货</label></li>
                                    <li><label><input type="radio" name='status' value='3' @if($rs->status==3)checked @endif> 无效订单</label></li>
	        					</ul>
	        				</div>
	        			</div>
	        		</div>
					
        		<div class="mws-button-row">
        			{{csrf_field()}}

                    {{method_field('PUT')}}
        			<input type="submit" value="修改" class="btn btn-primary">
        		</div>
        	</form>
        </div>    	
    </div>
@stop

@section('js')

<script>
    setTimeout(function(){
        $('.mws-form-message').fadeOut(2000);

    },3000)
</script>

@stop