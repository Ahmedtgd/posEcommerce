<x-app-layout>
        @vite('resources/js/app.js')

<link href="node_modules/filepond/dist/filepond.css" rel="stylesheet">
<script src="node_modules/filepond/dist/filepond.js"></script>
<div class="container">
<div class="text-center mt-5">
<h1>Edit Products</h1>
    </div>
</br>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
       <label for="category_id">category</label>
      <select name="category_id" class="form-control">
      <option value="">Category</option>
      @foreach($categories as $category)
      <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{  $category->category_name  }}</option>
      @endforeach
      </select>
      </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" rows="5" required>{{ $product->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" class="form-control" value="{{ $product->price }}" required>
        </div>
        <div class="form-group">
            <label for="name">quantity</label>
            <input type="text" name="quantity" class="form-control" value="{{ $product->quantity }}" required>
        </div>
</br>
        <div class="form-group">
            <label for="file">Upload Image</label>
           <img id="myImg" src="{{ asset('storage/img/' . $product->file) }}" width="240" height="120" style="border-radius: 10px;">
            </br>
            <input type="file" name="file" class="form-control-file"   accept=" .jpg, .jpeg, .png">
            </br>
            <small class="form-text text-muted">Upload a new file only if you want to replace the existing one.</small>
        </div>
</br>
        <div class="form-group">
            <label for="fil">Upload Video</label>
            <video id="previewImage" width="240" height="120" controls>
            <source src="{{ asset('storage/video/' . $product->fil) }}" type="video/mp4">
            </video>
            </br>
            <input type="file" name="fil" class="form-control-file"  accept=".mp4,.webm,.ogg">
            </br>
            <small class="form-text text-muted">Upload a new image only if you want to replace the existing one.</small>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<script>
FilePond.create(document.querySelector('#imageUploader'));
</script>

</x-app-layout>
