<html>
<head>
	{{ HTML::style('css/bootstrap.min.css') }}
	{{ HTML::style('css/bootstrap-theme.min.css') }}
	<title>edit product</title>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<center style="margin-top: 3cm; margin-bottom: 3cm; margin-right: 3cm; margin-left: 3cm;">
			     <div class="page-header">
		            <h1><span class="glyphicon glyphicon-pencil"></span> Edit Product!</h1>
		        </div> 
				{{Form::open(array('url' => 'product/'.$product->id , 'files' => true, 'method' => 'put'))}}
				<div class="form-group">
					{{Form::label('name','Name' , array('class' => 'col-lg-2 control-label'))}}
				    <div class="col-lg-10">
				         {{Form::Text('name' , $product->name,['class' =>  'form-control'])}}
				    </div>
				</div>
				<div class="form-group">
				    {{Form::label('name','Description' ,array('class' => 'col-lg-2 control-label'))}}
				    <div class="col-lg-10">
				        {{Form::Text('descrption' , $product->productdes ,['class' =>  'form-control'])}}
				    </div> 
				</div>    
				<div class="form-group">
				    {{ Form::label('name','images' ,array('class' => 'col-lg-2 control-label')) }}   
			         <input type="file" name='image[]' multiple>
			    </div>
			            @foreach ( json_decode($product->images) as $image )
					       <img width="100" height="100" src='http://localhost/task/public/uploads/{{ $image }}' >
					    @endforeach
					    <br>
			         {{Form::submit('Edit' ,['class' => 'btn btn-success'])}}
				{{Form::close()}}
			</center>
		</div>
	</div>
</div>			
<script type="text/javascript">
	var form= document.querySelector('form');
	var request= new xmlHttpRequest();
	form.addEventListener('submit',function(e){
         e.preventDefault();

         //muliple files will be in the form parameter
         var formdata = new FormFata(form);
         request.open('post' ,'submit'); //route laravel
         request.send(formdata); 
	},false)

</script>
</body>
</html>