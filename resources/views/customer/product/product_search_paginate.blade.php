@foreach ($products as $product)
    <tr>
        <td>
            <img src="{{ asset($product->image === null ? 'images/user.png' : $product->image) }}"
                style="height:50px;width:50px">
        </td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->quantity }}</td>
        <td>{{ $product->price }}</td>
        <td>
            <a onclick="add_to_cart({{ $product->id }})" class="btn btn-success btn-sm">Add to Cart</a>
        </td>
    </tr>
@endforeach
<td>
    {{ $products->links() }}
</td>