<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use File;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        // Retrieve all customers from the database
        $search = request()->query('search');
        $sort = request()->query('sort', 'desc'); // Default to 'desc'
    
        $customers = Customer::query()
            ->when($search, function ($query, $search) {
                $query->where('first_name', 'LIKE', "%{$search}%")
                    ->orWhere('last_name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->orWhere('bank_account_number', 'LIKE', "%{$search}%");
            })
            ->orderBy('created_at', $sort)
            ->get();
    
        return view('customer.index', compact('customers'));
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

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');;

    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $customer = Customer::withTrashed()-> findOrFail(($id));
        return view('customer.show', compact('customer')); // Pass the customer to the show view
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::findOrFail($id);
        return view ('customer.edit', compact('customer')); // Pass the customer to the edit view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerStoreRequest $request, string $id)
    {
        
        $customer = Customer::findOrFail($id);
        
        // Handle image upload if provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            File::delete(public_path($customer->image));
            // handle file upload
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

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);

        // Do NOT delete the image file here for soft delete
        $customer->delete(); // Delete the customer record from the database

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.'); // Redirect back to the index page with a success message
    }
    
    function trashIndex(Request $request){
        // Retrieve all customers from the database
        $search = request()->query('search');
        $sort = request()->query('sort', 'desc'); // Default to 'desc'

        $customers = Customer::onlyTrashed()
            ->when($search, function ($query, $search) {
                $query->where('first_name', 'LIKE', "%{$search}%")
                    ->orWhere('last_name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->orWhere('bank_account_number', 'LIKE', "%{$search}%");
            })
            ->orderBy('created_at', $sort)
            ->get();
    

        return view('customer.trash', compact('customers')); // Return the view with the customers data
    }

    public function restore($id)
    {
        $customer = Customer::onlyTrashed()->findOrFail($id);
        $customer->restore();

        return redirect()->route('customers.trash')->with('success', 'Customer restored successfully.');
    }


    public function forceDelete($id)
    {
        $customer = Customer::onlyTrashed()->findOrFail($id);

        // Now delete the image file
        if ($customer->image) {
            File::delete(public_path($customer->image));
        }

        $customer->forceDelete();

        return redirect()->route('customers.trash')->with('success', 'Customer permanently deleted.');
    }
    
}
