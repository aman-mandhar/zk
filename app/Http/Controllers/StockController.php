<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Stock;
use App\Providers\RouteServiceProvider;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use AuthenticatesUsers;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::all();
        return view('stocks.index', ['stocks' => $stocks]);
    }

    public function create()
    {
        $items = Item::all();
        return view('stocks.create', [
            'items' => $items   
        ]);
    }
    

public function store(Request $request)
{
    // Validate the request data as needed
    $validatedData = $request->validate([
        'selected_items.*' => 'required|exists:items,id',
        'prod_pics.*' => 'required|string',
        'name' => 'required',
        'description' => 'required',
        'type' => 'required',
        'prod_cat' => 'required',
        'measure' => 'nullable|numeric',
        'tot_no_of_items' => 'nullable|integer',
        'pur_value' => 'required|numeric',
        'cgst' => 'nullable|numeric',
        'sgst' => 'nullable|numeric',
        'mrp' => 'required|numeric',
        'sale_price' => 'required|numeric',
        'gst' => 'required',
        'tot_points' => 'required|numeric',
        'pur_bill_no' => 'required|string',
        'merchant' => 'required|string',
        'user_id' => 'required|exists:users,id',
        'qrcode' => 'nullable|string',
        ]);

    // Loop through the submitted items and create a stock record for each
    foreach ($validatedData['selected_items'] as $key => $selectedItemId) {
        Stock::create([
            'item_id' => $selectedItemId,
            'prod_pic' => $validatedData['prod_pics'][$key],
            'name' => 'required',
            'description' => $validatedData['description'][$key],
            'type' => $validatedData['types'][$key],
            'prod_cat' => $validatedData['prod_cat'][$key],
            'measure' => 'nullable|numeric',
            'tot_no_of_items' => 'nullable|integer',
            'pur_value' => 'required|numeric',
            'cgst' => 'nullable|numeric',
            'sgst' => 'nullable|numeric',
            'mrp' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'gst' => $validatedData['gst'][$key],
            'tot_points' => 'required|numeric',
            'pur_bill_no' => 'required|string',
            'merchant' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'qrcode' => 'nullable|string',
            // Add other fields as needed
        ]);
    }

    // Redirect to the index page or show a success message
    return redirect()->route('stocks.create')->with('success', 'Stock created successfully');
}

    
    public function show(Stock $stock)
    {
        
        return view('stocks.show', ['stock' => $stock]);
    }

    public function edit(Stock $stock)
    {
        // You might need to pass some data to the view, e.g., a list of items
        $items = Item::all(); // Assuming you have an Item model
        return view('stocks.edit', ['stock' => $stock, 'items' => $items]);
    }

    public function update(Request $request, Stock $stock)
    {
        // Validate the request data as needed
        $validatedData = $request->validate([
        'selected_items.*' => 'required|exists:items,id',
        'prod_pics.*' => 'required|string',
        'name' => 'required',
        'description' => 'required',
        'type' => 'required',
        'prod_cat' => 'required',
        'measure' => 'nullable|numeric',
        'tot_no_of_items' => 'nullable|integer',
        'pur_value' => 'required|numeric',
        'cgst' => 'nullable|numeric',
        'sgst' => 'nullable|numeric',
        'mrp' => 'required|numeric',
        'sale_price' => 'required|numeric',
        'gst' => 'required',
        'tot_points' => 'required|numeric',
        'pur_bill_no' => 'required|string',
        'merchant' => 'required|string',
        'user_id' => 'required|exists:users,id',
        'qrcode' => 'nullable|string',
            // Add other validation rules for your fields
        ]);

        // Update the stock record
        foreach ($validatedData['selected_items'] as $key => $selectedItemId) {
        $stock->update([
            'item_id' => $selectedItemId,
            'prod_pic' => $validatedData['prod_pics'][$key],
            'name' => 'required',
            'description' => $validatedData['description'][$key],
            'type' => $validatedData['types'][$key],
            'prod_cat' => $validatedData['prod_cat'][$key],
            'measure' => 'nullable|numeric',
            'tot_no_of_items' => 'nullable|integer',
            'pur_value' => 'required|numeric',
            'cgst' => 'nullable|numeric',
            'sgst' => 'nullable|numeric',
            'mrp' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'gst' => $validatedData['gst'][$key],
            'tot_points' => 'required|numeric',
            'pur_bill_no' => 'required|string',
            'merchant' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'qrcode' => 'nullable|string',
            // Add other fields as needed
        ]);}

        // Redirect to the index page or show the updated stock details
        return redirect()->route('stocks.index')->with('success', 'Stock updated successfully');
    }

    public function destroy(Stock $stock)
    {
        // Delete the stock record
        $stock->delete();

        // Redirect to the index page or show a success message
        return redirect()->route('stocks.index')->with('success', 'Stock deleted successfully');
    }
}
