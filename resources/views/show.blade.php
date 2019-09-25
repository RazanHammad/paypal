
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
	

	<div class="container">
  <h2>Cards with Contextual Classes</h2>
 
  <div class="card">
    <div class="card-body">
    	<p>{{$items->price}}</p>
    	<p>{{$items->description}}</p>
    	<form method=" post" action="{{route('pay')}}">
        @csrf
    		<input type="hidden" name="name" value="{{$items->name}}">
    		<input type="hidden" name="price" value="{{$items->price}}">
			<button  type="submit">Buy</button>
    	</form>
    </div>
  </div>


</div>
</body>

</html>