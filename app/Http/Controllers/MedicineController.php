<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Medicine;
use Auth;
use DB;
class MedicineController extends Controller
{
	protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:200'],
            'quantity' => ['required', 'integer'],
            'price' => ['required', 'integer',],
        ]);
    }

	

    public function addStock(Request $request)
    {
    	$rows = $request->input('rows');
    		foreach ($rows as $row)
    		{
    			$this->validator($row)->validate();
    			$stock = Medicine::where([
    			    ['med_id', '=', Auth::guard('medshop')->user()->id],
    			    ['name', '=', $row['name']]
    			])->first();
    			if ($stock)
    			{
    			    $stock->increment('quantity', $row['quantity']);
    			}
    			else
    			{
    		    $medicines[] = [
    		        'name' => $row['name'],
    		        'quantity' => $row['quantity'],
    		        'price' => $row['price'],
    		        'med_id' => Auth::guard('medshop')->user()->id,
    		    ];
    			}
    		}
    		if ($medicines){
    			Medicine::insert($medicines);
    }
    	
    	return redirect('/medshop/viewdb');
    }

    public function index()
	{
     $product = DB::table('medicine')->where('med_id',Auth::guard('medshop')->user()->id)->get();
     return view('medshop.viewdb',compact('product'))->with('success', 'Stock has been added');
    }


    public function edit(Request $request)
    {
    	$medicine = Medicine::find($request->id);
    	$medicine->name = $request->name;
    	$medicine->quantity = $request->quantity;
    	$medicine->price = $request->price;
    	$medicine->save();
    	return response()->json($medicine);
    }

    public function delete(Request $request)
    {
    	$medicine = Medicine::find($request->id)->delete();
    	return response()->json();
    }

}
