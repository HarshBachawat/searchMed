<?php
$i=1
?>

@extends('medshop')

@section('content')
<div style="height:80px"></div>
<div class="contain">
    <table class="table table-hover" style="font-size: 18px" id="tablet">
        <thead style="20px">
            <tr>
              <th>Sr No</th>
              <th>Medicine Name</th>
              <th>Quantity</th>
              <th>Price</th>
              <th colspan="2">Action</th>
          </tr>
        </thead>
        
        <tbody>
            @foreach($product as $pro)
            <tr id="{{$pro->id}}">
                <td>{{$i++}}</td>
                <td>{{$pro->name}}</td>
                <td>{{$pro->quantity}}</td>
                <td>{{$pro->price}}</td>
                <td><button type="button" class="btn btn-primary" onclick="editFunction(this)" >Edit</button> </td>
            </tr>
            @endforeach
        </tbody>
    </table>
<div>

<div id="id01" class="modal" >
  <form class="modal-content animate" method="POST" style="width: 40%">
  	@csrf
  	<div class="imgcontain" style="display: inline-block; ">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      
    </div>
   

    <div class="contain" >
    	<input type="hidden" name="_token" value="{{  csrf_token()  }}">
      <input type="hidden" name="id" id="id">
      <label for="name"><b>Medicine Name</b></label>
      <input type="text" id="name" placeholder="Medicine Name" name="name" required>
      <div style="height: 15px"></div>
      <label for="quantity"><b>Quantity</b></label>
      <input type="number" id="quantity" min="1" step="1"  name="quantity" required>
      <div style=" width:18px;height:auto;display:inline-block;"></div>
      <label for="price"><b>Price</b></label>
      <input type="number" id="price" min="1" step="1"  name="price" required>
        <div style="height: 30px"></div>
      <div align="center">
      	<button type="button" id="edit" style="width: 20%;" class="btn btn-primary">Edit</button>
      <div style=" width:60px;height:auto;display:inline-block;"></div>
      <button type="button" id="delete" style="width: 20%;" class="btn btn-danger">Delete</button>
      </div>
      
    </div>
  </form>
</div>

@endsection

@section('head')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* Full-width input fields */
input[type=text] {
  width: 72%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

thead th {
  position: sticky;
  top:55px;
  background-color: #111;
  color: white;
}

input[type=number] {
padding: 12px 20px;
height: 43px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

label {
	font-size: 21px;
}
/* Set a style for all buttons */


button:hover {
  opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
  align-self: center
}

/* Center the image and position the close button */
.imgcontain {
	align-content: center;
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}




.contain {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 40%; /* Could be more or less, depending on screen size */
  height:300px
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
<script>



function editFunction(but) {
document.getElementById('id01').style.display='block';
var rowId = but.parentNode.parentNode.id;
var row = document.getElementById(rowId);
document.getElementById("id").value = rowId;
document.getElementById("name").value = row.cells[1].innerText;
document.getElementById("quantity").value = row.cells[2].innerText;
document.getElementById("price").value = row.cells[3].innerText;
}


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	var modal = document.getElementById('id01');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}



$(document).on('click', '#edit', function() {
        $.ajax({
            type: 'post',
            url: '/medshop/edit',
            data: {
            	'_token': $('input[name=_token]').val(),
                'id': $("#id").val(),
                'name': $('#name').val(),
                'quantity': $('#quantity').val(),
                'price': $('#price').val()
            },
            success: function(medicine) {
            	var row = document.getElementById(medicine.id).cells[0].innerText;
                $('#' + medicine.id).replaceWith("<tr id="+medicine.id+"><td>"+row+"</td><td>"+medicine.name+"</td><td>"+medicine.quantity+"</td><td>"+medicine.price+"</td><td><button type='button' class='btn btn-primary' onclick='editFunction(this)' >Edit</button></td></tr>");
                document.getElementById('id01').style.display = "none";
            }
        });
    });

$(document).on('click','#delete',function() {
	$.ajax({
		type: 'post',
		url: '/medshop/delete',
		data: {
			'_token': $('input[name=_token]').val(),
			'id': $('#id').val()
		},
		success: function(data) {
			var row = document.getElementById('id').value;
			var emp = document.getElementById(row);
			var change = emp.rowIndex;
			alert(change);
			var table =emp.parentNode;
			for (var i = change ; i < table.rows.length; i++) {
				table.rows[i].cells[0].innerText = parseInt(table.rows[i].cells[0].innerText)-1 ;
			}
			emp.remove();
			document.getElementById('id01').style.display = "none";
		}
	});
});
</script>
@endsection
