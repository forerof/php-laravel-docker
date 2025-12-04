@csrf

<div class="col-md-6 form-group p_star">
    <label>Nombre</label>
    <input type="text" class="form-control form-control-lg" name="name" value="{{ old('name', $product->name ?? '') }}" placeholder="Product name" required>
    @error('name')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="col-md-6 form-group p_star">
    <label>SKU</label>
    <input type="text" class="form-control form-control-lg" name="sku" value="{{ old('sku', $product->sku ?? '') }}" placeholder="SKU" required>
    @error('sku')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="col-md-6 form-group p_star mt-3">
    <label>Descripción corta</label>
    <input type="text" class="form-control form-control-lg" name="short_description" value="{{ old('short_description', $product->short_description ?? '') }}" placeholder="Short description" required>
    @error('short_description')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="col-md-6 form-group p_star mt-3">
    <label>Categoria</label>
    <select name="category_id" class="form-control form-control-lg" required>
        <option value="">Select category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="col-md-12 form-group p_star mt-3">
    <label>Descripción</label>
    <textarea class="form-control form-control-lg" name="long_description" rows="4" placeholder="Long description" required>{{ old('long_description', $product->long_description ?? '') }}</textarea>
    @error('long_description')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="col-md-4 form-group p_star mt-3">
    <label>Precio</label>
    <input type="number" step="0.01" class="form-control form-control-lg" name="price" value="{{ old('price', $product->price ?? '') }}" placeholder="0.00" required>
    @error('price')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="col-md-4 form-group p_star mt-3">
    <label>Stock</label>
    <input type="number" class="form-control form-control-lg" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" placeholder="0" required>
    @error('stock')<div class="text-danger">{{ $message }}</div>@enderror
</div>
