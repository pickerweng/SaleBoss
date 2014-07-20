{{Form::open([
	'url'       =>  empty($update) ? 'entity_types/' . $type->id . '/fields' : 'entity_types/' . $type->id . '/fields/' . $attribute->id ,
	'method'    =>  empty($update) ? 'post' : 'put'
])}}
	<fieldset>
		<legend >اطلاعات فیلد</legend>
		<div class="form-group">
			{{Form::label('item[display_name]','نام')}}
			{{Form::text('item[display_name]',!empty($update) ? $attribute->display_name: null , ['class' => 'form-control'])}}
		</div>

		<div class="form-group">
			{{Form::label('item[machine_name]','نام ماشینی')}}
			{{Form::text('item[machine_name]',!empty($update) ? $attribute->machine_name: null , ['class' => 'form-control languageLeft'])}}
		</div>

		<div class="form-group">
			{{Form::label('item[form_type]','نوع فیلد')}}
			{{Form::select('item[form_type]',$formTypes,null, ['class' => 'form-control languageLeft'])}}
		</div>

		<div class="form-group">
			{{Form::label('item[order]','ترتیب')}}
			{{Form::text('item[order]',empty($update) ? 0 : $attribute->order,['class' => 'form-control languageLeft'])}}
		</div>
		<div class="form-group">
			<div class="checkbox">
				<label>
					نمایش در صفحه موجودیت
					{{Form::checkbox("item[exclude]", "1", empty($update) ? null : $attribute->exclude)}}
				</label>
			</div>
		</div>
	</fieldset>

	<fieldset>
		<legend>اعتبار سنجی</legend>
		<div class="forrm-group">
			@foreach($rules as $rule)
				<label class="checkbox-inline">
					{{$rule}}
					{{Form::checkbox("item[rules][]",$rule)}}
				</label>
			@endforeach
		</div>
		<br>
	</fieldset>

	<fieldset id="options">
		<legend>مقدار های پیشنهادی <a href="#options" class="btn btn-warning btn-xs pull-left add-option">+ اضافه کن</a></legend>
		<div class="options">
			<div class="form-group">
				{{Form::text('item[options][0]','',['class' => 'form-control add-option'])}}
			</div>
		</div>
	</fieldset>

	{{Form::submit('ثبت',array('class' => 'btn btn-lg btn-success'))}}
{{Form::close()}}

<script type="text/javascript">
	var count = 1;
	$("a.add-option").click(function(e){
		var input = '<div class="form-group"><input type="text" name="item[options]['+ count  + ']" class="form-control"></div>';
		$(".options").append($(input));
		count++;
	});
</script>