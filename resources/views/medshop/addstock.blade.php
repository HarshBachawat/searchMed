@extends('medshop')

@section('head')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <style type="text/css">
    
      input {display: block !important; padding: 0 !important; margin: 1 !important; border: 1 !important; width: 100% !important; border-radius: 1 !important; line-height: 40 !important;}
td {margin: 0 !important; padding: 0 !important;}
thead th {
  position: sticky;
  top:55px;
  background-color: #111;
  color: white;
}
</style>

<script>
	var i=1;
function myFunction() {
  var table = document.getElementById("new");
  table.innerHTML += '<td><input type="text" name="rows['+i+'][name]"class="form-control" id="remove" onkeypress=""></td><td><input type="number" min="1" step="1" name="rows['+i+'][quantity]" class="form-control"></td><td><input type="number" min="1" step="1" name="rows['+i+'][price]" class="form-control" onkeypress="return urFunction(event)"></td>';
  table.removeAttribute("id");
  i++;
  var tbody = document.getElementById("myTable");
  var tr = document.createElement("tr");
  tr.id ="new";
  tbody.appendChild(tr);
  foc = document.getElementById("remove");
  foc.focus();
  foc.removeAttribute("id");
}

function urFunction(e) {
  var t = e.keyCode;
  if(t == 13){
    myFunction();
    return false;
  }
}


  
  

</script>

@endsection


@section('content')
<div style="height:80px"></div>
<div class="container " >    
<form method="POST" action='{{ url("/medshop/addstock") }}' onkeypress="return event.keyCode != 13;">
	@csrf
  	<table class="table col-md-11" id="tablet" >
    <col width="60%">
    <col width="20%">
    <col width="20%">
    <thead id="myHeader">
      <tr></tr>
      <tr>
          <th>Medicine Name</th>
          <th>Quantity</th>
          <th>Price</th>
      </tr>
    </thead>
    
    <tbody id="myTable">
      <tr>
        <td><input type="text" id="first" name="rows[0][name]" class="form-control" onkeypress=""></td>
        <td><input type="number" min="1" step="1" name="rows[0][quantity]"  class="form-control" onkeypress=""></td>
        <td><input type="number" min="1" step="1" name="rows[0][price]" class="form-control" onkeypress="return urFunction(event)"></td>
      </tr>
      <tr id="new"></tr>
    </tbody>
  </table>
  <div align="right"><button class="btn btn-success" type="button" onclick="myFunction()">Add Row</button><div style=" width:108px;height:auto;display:inline-block;"></div> </div>
  <div align="center"><button type="submit" class="btn btn-primary">{{ __('Add Stock') }}</button></div>
</form>

</div>
<script>




</script>
@endsection