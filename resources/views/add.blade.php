@extends('layout.base')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">{{translate('Add ' . ucwords($type) . ' Event')}}</div>
	<div class="panel-body">
		<form action="add.php" method="post">
		<input type="hidden" name="type" value="{{$type}}" />
		<div class="row form-group">
			<div class="col-md-2"><label for="category" class="form-label">{{translate('Category')}}</label></div>
			<div class="col-md-4">
				<select name="category" class="form-control">
				@foreach ($categories as $category)
					<option value="{{$category->getId()}}">{{translate($category->getDescription())}}</option>
				@endforeach
				</select>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-2"><label for="description" class="form-label">{{translate('Description')}}</label></div>
			<div class="col-md-8"><input type="text" name="description" class="form-control" /></div>
		</div>
		<div class="row form-group">
			<div class="col-md-offset-2 col-md-4"><input type="submit" value="{{translate('Add')}}" class="form-control" /></div>
		</div>
		</form>
	</div>
</div>
@endsection