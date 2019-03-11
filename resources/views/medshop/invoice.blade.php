@extends('medshop')

@section('head')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/PrintArea/2.4.1/jquery.PrintArea.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
  <link href="/css/print.css" rel="stylesheet" media="print" type="text/css">
  

  <!-- $('.print-window').click(function() {
    window.print(); -->
<!-- }); -->

    <style type="text/css">
    
      input {display: block !important; padding: 0 !important; margin: 1 !important; border: 1 !important; width: 100% ; border-radius: 1 !important; line-height: 40 !important;}
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

var total = 0;
var j;
for(j=0; j<i ; j++)
{
    quat = document.getElementsByName("row[j][quantity]").value;
    price = document.getElementsByName("row[j][price]").value;
    
    total = (quat*price)+total;
    console.log(total);
}
document.getElementsById("total_cost").innerHTML = total;
</script>

@endsection


@section('content')
<div style="height:80px"></div>
<div class="container" id="printarea">    
<form method="POST" action='{{ url("/medshop/invoice") }}' onkeypress="return event.keyCode != 13;">
	@csrf
    <h5>Client Name:</h5>
    <input style="width:500px;" type="text" name = "client_name" class="form-control">
    <br>
    <h5>Client mobile no.:</h5>
    <input style="width:500px;" name = "mob_no" type="integer" class="form-control"><br>
    <br>
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
        <td><input type="text" id="remove" name="rows[0][name]" class="form-control" onkeypress=""><div style="text-decoration:none; position:absolute" id="firstdata"></div></td>
        <td><input type="number" min="1" step="1" name="rows[0][quantity]"  class="form-control" onkeypress=""></td>
        <td><input type="number" min="1" step="1" name="rows[0][price]" class="form-control" onkeypress="return urFunction(event)"></td>
      </tr>
      <tr id="new"></tr>
    </tbody>
  </table>
  <div align="right"><button class="btn btn-success" type="button" onclick="myFunction()">Add Row</button><div style=" width:108px;height:auto;display:inline-block;"></div> </div>
  <h4>Total:</h4>
  <h4 id = "total_cost"><h4>
  <div align="center"><button type="submit" class="btn btn-primary">{{ __('Generate Bill') }}</button></div>
</form>
</div>
<a href="javascript:void(0);" id="printButton">Print</a>  

@endsection


<script>
$(document).ready(function(){

$('#remove').keyup(function(){ 
       var query = $(this).val();
       if(query != '')
       {
        var _token = $('input[name="_token"]').val();
        $.ajax({
         url:"{{ route('autocomplete.fetch') }}",
         method:"POST",
         data:{query:query, _token:_token},
         success:function(data){
          $('#remove').fadeIn();  
                   $('#firstdata').html(data);
         }
        });
       }
   });

   $(document).on('click', 'li', function(){  
        $('#remove').val($(this).text());  
        $('#firstdata').fadeOut();  
    });  

});

</script>

<!-- <script>
$(document).ready(function(){
    $("#printButton").click(function(){
        var mode = 'iframe'; //popup
        var close = mode == "popup"; 
        var options = { mode : mode, popClose : close};
        $("div#printarea").printArea( options );
    });
});
$('#printButton').click(function() {
    window.print();
});
}
</script> -->