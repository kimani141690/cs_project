@include('_sidebar')

<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
    <tr>
        <td>{{ $product->name }}</td>
        <td>{{ $product->description }}</td>
        <td>{{ $product->quantity }}</td>
        <td>{{ $product->price }}</td>
        <td>
            <a href="#" data-toggle="modal" data-target="#editModal{{ $product->id }}">Edit</a>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
            </form>
        </td>
    </tr>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $product->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $product->id }}">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Update Product Form -->
                    <form action="{{ route('products.update', $product->id) }}" method="POST" id="updateForm{{ $product->id }}">
                        @csrf
                        @method('PUT')
                        <!-- Add form fields here for the product attributes you want to update -->
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" required>{{ $product->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $product->quantity }}" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Edit Modal -->
    @endforeach
    </tbody>
</table>

<script>
    // Close modal after successful form submission
    @foreach($products as $product)
    document.getElementById('updateForm{{ $product->id }}').addEventListener('submit', function() {
        $('#editModal{{ $product->id }}').modal('hide');
    });
    @endforeach
</script>
