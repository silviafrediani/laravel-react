<div class="form-group">
	<label for="">Choose category/ies</label>
	<select class="form-control" name="categories[]" id="categories" multiple size="5">
		@foreach($categories as $category)
			<option value="{{$category->id}}" {{ ( (collect(old('categories'))->contains($category->id)) || in_array($category->id, $selectedCategories) ) ? 'selected' : '' }}>{{$category->name}}</option>
		@endforeach()
	</select>
</div>
