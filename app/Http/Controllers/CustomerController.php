<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Models\Customer;
use Illuminate\Http\Request;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all(); // Fetch all customers from the database
        return view('customer.index', compact('customers')); // Pass the customers to the view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerStoreRequest $request)
    {

        $customer = new Customer();
        
        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $image->store('', 'public');
            $filePath = '/uploads/' . $fileName;    
            $customer->image = $filePath; // Store the file path in the database
            
        }
        
        
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->bank_account_number = $request->bank_account_number;
        $customer->about = $request->about;
        $customer->save();

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
