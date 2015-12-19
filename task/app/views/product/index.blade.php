<html>
<head>
	{{ HTML::style('css/bootstrap.min.css') }}
	{{ HTML::style('css/bootstrap-theme.min.css') }}
	<style>
		h1 {
		    color: maroon;
		    margin-left: 40px;
		}
		table ,tr ,td ,th{
			border: 1px solid black;
			 text-align: center;
		}
		td{
			
			padding-top:1cm; padding-bottom: 1cm;
		} 
	</style>
	<title>product</title>
</head>
<body style="margin-top: 1cm;">
    <div class="container"> 
	    <div class="row">
		    <div class="col-md-12"> 
		        <div class="content">
					<table style="width:100% ; border: 1px solid black;">
				        <tr><th>product images</th><th>product Name</th><th>product description</th><th>edit product</th><th>delete product</th></tr> 	
						@foreach ($products as $product)
						<tr > 
						    <td>
						    @foreach ( json_decode($product->images) as $image )
						       <img width="100" height="100" src='uploads/{{ $image }}' >
						    @endforeach
						    </td> 
							<td>{{$product->name}}</td>
							<td>{{$product->productdes}}</td>
							<td>
							   <a href='product/<?php echo $product->id ; ?>/edit' ><button type="button" class="btn btn-info">Edit</button></a>
							   
							</td>
							
							<td>
					            {{ Form::open(['method' => 'DELETE', 'route' => ['product.destroy', $product->id]]) }}
					                {{ Form::hidden('id', $product->id) }}
					                {{ Form::submit('Delete', ['class' => 'btn btn-danger' ,'onclick' => 'return confirm("Are you sure?")'] ) }}
					            {{ Form::close() }}
					        </td>
						</tr>
						@endforeach
					</table>
					<center>
				      {{$products->links();}}
				    </center>
				    <center>
				        <a href="product/create"><button type="button" class="btn btn-success">Add New Product </button></a>
				    </center>
				</div>
			</div>
		</div>
	</div>
</body>
</html>