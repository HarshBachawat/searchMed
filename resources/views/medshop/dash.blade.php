@extends('medshop')

@section('navitem')
<div align="right">
	<div align="center">
	   <a href="{{ url('/medshop/addstock' ) }}" ><button align="right" type="button" class="btn btn-default" >Add Stock</button></a>
	    
		<a href="{{ url('/newInvoice' ) }}" ><button align="right" type="button" class="btn btn-default" id="newInvoice">New Invoice</button></a>
 </div>
</div>

</script>
@endsection

@section('head')
   <script src="{{ asset('js/app.js') }}" defer></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@endsection