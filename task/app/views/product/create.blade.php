<html>
<head>
	{{ HTML::style('css/bootstrap.min.css') }}
	{{ HTML::style('css/bootstrap-theme.min.css') }}
	<title>create new product</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<center style="margin-top: 3cm; margin-bottom: 3cm; margin-right: 3cm; margin-left: 3cm;">
				    <div class="page-header">
			            <h1><span class="glyphicon glyphicon-flash"></span> Create New Product!</h1>
			        </div> 
					@if ($errors->has())
				        <div class="alert alert-danger">
				            @foreach ($errors->all() as $error)
				                {{ $error }}<br>        
				            @endforeach
				        </div>
				     @endif
					{{ Form::open(array('route' => 'product.store' , 'files' => true, 'method' => 'post')) }}
					<div class="form-group">
						{{ Form::label('name','Name' , array('class' => 'col-lg-2 control-label')) }}
					    <div class="col-lg-10">
					        {{ Form::Text('name',Null,['class' =>  'form-control' , 'placeholder' => 'name']) }}
					    </div>
					</div>
					<div class="form-group">
					    {{ Form::label('name','Description' ,array('class' => 'col-lg-2 control-label')) }}
					    <div class="col-lg-10">
					        {{ Form::Text('descrption' ,Null,['class' =>  'form-control' , 'placeholder' => 'description']) }}
					    </div>
					</div>
					<div class="form-group"> 
					{{ Form::label('name','images' ,array('class' => 'col-lg-2 control-label')) }} 
				          <input type="file" name='image[]' multiple>
				    </div>

				         {{ Form::submit('Save' , ['class' => 'btn btn-success']) }}
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