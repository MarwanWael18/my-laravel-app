<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">



<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <h1 class="display-5" style="font-weight: 800">Store</h1>
                        <a class="btn btn-primary" style="font-size: 19px" href="{{ route('admin.create') }}">Add Product</a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($store)
                                    @foreach ($store as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->price }} $</td>
                                            <td style="width: 10%"> <img src="{{ asset('storage/' . $product->image) }}" width="100%" class="">
                                            </td>
                                            <td>
                                                    <form action="{{ route('admin.destroy', $product->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="submit" value="Delete" class="btn btn-danger"
                                                            onclick="return confirm('Are you sure')">
                                                    </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                @else
                                    <div class="alert alert-danger" role="alert">
                                        <strong>No products</strong> Please enter products
                                    </div>

                                @endif
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
