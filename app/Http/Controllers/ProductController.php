<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Helmet;

class ProductController extends Controller
{
    function upload(Request $request){    

        $field = $request -> validate ([
            "category" => "required",
            "style" => "required",
            "brand" => "required",
            "name" => "required",
            "details" => "required",
            "price" => "required",
            "quantity" => "required",
            "image" => "nullable|array",
            "image.*" => "image|mimes:jpeg,png,jpg,gif|max:2048",
        ]);

        // Handle multiple image uploads
        $imageUrls = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $new_name = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $new_name);

                // Add the full image URL using Laravel's asset() helper
                $imageUrls[] = secure_url('images/' . $new_name);
            }
        }

        $product = Helmet::create([
            "category" => $field ["category"],
            "style" => $field ["style"],
            "brand" => $field ["brand"],
            "name" => $field ["name"],
            "details" => $field ["details"],
            "price" => $field ["price"],
            "quantity" => $field ["quantity"],
            "image" => implode(',', $imageUrls), // Save the URLs, comma-separated
        ]);

        return response()->json([
            "message"=>"Data Inserted",
            "data"=>$product],
            201, [], JSON_PRETTY_PRINT
        );
    }
    function getProducts (Request $request){
      
        $product = Helmet::all();
        return response()->json(Helmet::all(),200,[], JSON_PRETTY_PRINT);
    }

    function getProduct ($style){
        $product = Helmet::where("style", $style) ->get();
        return response()->json($product, 200, [], JSON_PRETTY_PRINT);
    }

    public function getCategory($category = null)
    {
        $query = Helmet::query(); // Initialize the query builder

        // If style is provided, filter by style
        if ($category) {
            $query->where("category", $category);
        }

        // If no products found for the style, filter by other criteria (brand, price)
        if ($query->count() === 0) {
            // You can use 'brand' or 'price' filters here as fallback
            $query->orWhere("brand", $category)  // Replace with the fallback brand logic
                ->orWhere("style", $category); // Replace with the fallback price logic
        }

        $products = $query->get();

        return response()->json($products, 200, [], JSON_PRETTY_PRINT);
    }
  

    function filterProducted (Request $request){

        $query = Helmet::query();

        if($request->has('style')){
            if ($request->input('style') == 'null'){
                $query->whereNull('style');
            }
            else {
                $query->where('style', $request->input('style'));
            }
        }
        if($request->has('brand')){
            if ($request->input('brand') == 'null'){
                $query->whereNull('brand');
            }
            else {
                $query->where('brand', $request->input('brand'));
            }
        }
        
        $products = $query->get();

        if($products->isEmpty()){
            return response()->json([
                "message"=>"No data found",
                "data"=>$products],
                404, [], JSON_PRETTY_PRINT
            );
        }
        return response()->json($products, 200, [], JSON_PRETTY_PRINT);
    }
    function getDetail (Request $request, $category, $brand, $name){
        
        $product = Helmet::where("category", $category) -> where("brand", $brand) -> where("name", $name) ->get();

        if($product->isEmpty()){
            return response()->json([
                "message"=>"No data found",
                "data"=>$product],
                404, [], JSON_PRETTY_PRINT
            );
        }
        return response()->json($product, 200, [], JSON_PRETTY_PRINT);
    }
   
}
