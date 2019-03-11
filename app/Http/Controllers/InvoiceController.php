<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;   
use App\Medicine;
use App\Invoice;
use Auth;
use DB;

class InvoiceController extends Controller
{
    protected function validator(array $data)
    {
        // return Validator::make($data, [
        //     'client_name' => ['required', 'string'],
        //     'mob_no.' => ['required', 'integer'],
        //     'medicine' => ['required', 'string', 'max:200'],
        //     'quantity' => ['required', 'integer'],
        //     'price' => ['required', 'integer',],
        // ]);
    }

    function fetch(Request $request)
    {
     if($request->get('query'))
     {
      $query = $request->get('query');
      $data = DB::table('medicine')
        ->where('name', 'LIKE', "%{$query}%")
        ->get();
      $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
      foreach($data as $row)
      {
       $output .= '
       <li><a href="#">'.$row->name.'</a></li>
       ';
      }
      $output .= '</ul>';
      echo $output;
     }
    }

    public function invoiceDetails(Request $request)
    {
        // static $invoice_id = 0;
        $invoice = [];
        $client_name = $request->input('client_name');
        $mob_no = $request->input('mob_no');
        $rows = $request->input('rows');
    		foreach ($rows as $row)
    		{
    			// $this->validator($row)->validate();
    			$stock = Medicine::where([
    			    ['med_id', '=', Auth::guard('medshop')->user()->id],
    			    ['name', '=', $row['name']]
                ])->first();
                $stock->decrement('quantity', $row['quantity']);
    			if (!$stock)
    			{
    			    echo "Error"; 
    			}
    			else
    			{
    		    $invoice = array(
                    'client_name' => $client_name,
                    'mob_no' => $mob_no,
    		        'medicine' => $row['name'],
    		        'quantity' => $row['quantity'],
    		        'price' => $row['price'],
                    'med_id' => Auth::guard('medshop')->user()->id,
                );
                // print_r($invoice);
                }
                Invoice::insert($invoice);
            }
                // }
            
    		// if ($invoice){
            //     // $invoice = ['invoice_id' => $invoice_id + 1];
    		// 	// DB::table('invoice')->insert($invoice);
            //     // echo "Record inserted successfully";    
                

            // }
            return redirect('/medshop/viewdb');
    }
//         foreach($rows as $row){

//             $data=[
//                 'client_name' => 'client_name',
//                 'mob_no' => 'mob_no',
//                 'name' => $row['name'],
//                 'quantity' => $row['quantity'],
//                 'price' => $row['price'],
//                 'med_id' => Auth::guard('medshop')->user()->id,
//             ];
//             array_push($list, $data);  
            
//             if($list){
//                 DB::table('invoice')->insert($list);
//             }
//         }

        
}
