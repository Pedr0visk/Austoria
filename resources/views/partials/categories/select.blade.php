<select required class="form-control" id="categories" name="category_id">
    <option value="">Selecione uma categoria selected</option>
    @foreach($categories as $cat)
    @if($cat->name == $selectedCategoryName)
    <option selected value="{{ $cat['name'] }}">{{ $cat['name'] }}</option>
    @else
    <option value="{{ $cat['name'] }}">{{ $cat['name'] }}</option>
    @endif
    @endforeach
</select>
