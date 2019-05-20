@extends('common.admins')
@section('title', '修改信息')

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
        	<form class="mws-form" action="/admin/goods/{{$val->id}}" method="post" enctype="multipart/form-data">
        		{{csrf_field()}}
                {{ method_field('PUT') }}
        		<div class="mws-form-inline">
        			<div class="mws-form-row">
	    				<label class="mws-form-label">商品类别</label>
	    				<div class="mws-form-item">
	    					<select class="large" name="tid">
	    					@php
	    					foreach($rs as $k=>$v):
	    						$num = substr_count($v->path, ',');
	    						$nbsp = str_repeat('&nbsp', ($num-1)*3);
	    						if($v->pid == 0){
									$select = 'disabled';
								} else {
									$select = '';
								}
                                if($v->id == $val->tid){
                                    $selected = 'selected';
                                }else{
                                    $selected = '';
                                }
								echo '<option value="'.$v->id.'" '.$select.' '.$selected.'>'.$nbsp.$v->tname.'</option>';
	    					endforeach
	    					@endphp
	    					</select>
	    				</div>
	    			</div>
        			<div class="mws-form-row">
        				<label class="mws-form-label">商品名称</label>
        				<div class="mws-form-item">
        					<input type="text" class="small" name="gname" value="{{$val->gname}}">
        				</div>
        			</div>
        			<div class="mws-form-row">
        				<label class="mws-form-label">生产厂家</label>
        				<div class="mws-form-item">
        					<input type="text" class="small" name="company" value="{{$val->company}}">
        				</div>
        			</div>
        			<div class="mws-form-row">
        				<label class="mws-form-label">单价</label>
        				<div class="mws-form-item">
        					<input type="text" class="small" name="price" value="{{$val->price}}">
        				</div>
        			</div>
        			<div class="mws-form-row">
        				<label class="mws-form-label">库存量</label>
        				<div class="mws-form-item">
        					<input type="text" class="small" name="stock" value="{{$val->stock}}">
        				</div>
        			</div>
        			<div class="mws-form-row">
        				<label class="mws-form-label">简介</label>
        				<div class="mws-form-item">
        					<textarea rows="" cols="" class="large" name="descr" >{{$val->descr}}</textarea>
        				</div>
        			</div>
        			<div class="mws-form-row">
        				<label class="mws-form-label">状态</label>
        				<div class="mws-form-item">
        					<select class="large" name="status">
        						  <option value="1" @php echo ($val->status == 1)?'selected':'';  @endphp>新添加</option>
        						  <option value="2" @php echo ($val->status == 2)?'selected':'';  @endphp>在售</option>
        						  <option value="3" @php echo ($val->status == 3)?'selected':'';  @endphp>已下架</option>
        					</select>
        				</div>
        			</div>
        			<div class="mws-form-row">
                    	<label class="mws-form-label">商品图片</label>
                    	<div class="mws-form-item">
                        	<div class="fileinput-holder" style="position: relative;"><input type="file" name="gpic" multipart class="required" style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;"></div>
                            <label for="picture" class="error" generated="true" style="display:none"></label>
                        </div>
                    </div>
        		</div>
        		<div class="mws-button-row">
        			<input type="submit" value="修改" class="btn btn-danger">
        			<!-- <input type="reset" value="Reset" class="btn "> -->
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