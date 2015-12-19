<?php

class productcontroller extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() // main page show all products 
	{
		$products=Product::where('id' ,'>' , 0) -> paginate(2); //this pagination . get 2 rows from database at once 
		return View::make('product.index')->with('products',$products); //go to product/index.blade.php with two rows of database
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('product.create'); //form to create new product 
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() // store data after user click on save button
	{
		//
		// create the validation rules ------------------------

	    $rules = array(
	        'name'             => 'required',                        // just a normal required validation
	        'descrption'       => 'required'     // required 
	        
	    );
	    $validator = Validator::make(Input::all(), $rules);
	    if ($validator->fails()) {

        // get the error messages from the validator
        $messages = $validator->messages();

        // redirect our user back to the form with the errors from the validator
        return Redirect::route('product.create')->withErrors($validator);

    } else {
    	if (Input::hasFile('image')) {
    		foreach (Input::file('image') as $image) {
				$imagename=time().$image->getClientOriginalName();
				$uploadflag=$image->move('uploads',$imagename);
				if($uploadflag){
					$uploadedimages[]=$imagename;
				}
			}
			$name=Input::get('name') ;
			$description=Input::get('descrption');
			
			$product =new Product;
			$product->name=$name;
			$product->productdes=$description ;
			$product->images=json_encode($uploadedimages);
			$product->save();
			return Redirect::route('product.index');
                          
    	}
    	else{
    		return Redirect::route('product.create')->withErrors('product image needed');
    	}
		
	   }//end else
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) //edit product
	{
		
		$product = Product::find($id);
		return View::make('product.edit')->with('product',$product);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$product = Product::find($id); //get id of product 
		if (Input::hasFile('image')) { // if user add new image will remove all images and set new one 
    		foreach (Input::file('image') as $image) {
				$imagename=time().$image->getClientOriginalName();
				$uploadflag=$image->move('uploads',$imagename); //upload image in new path 
				if($uploadflag){
					$uploadedimages[]=$imagename; //store new name of image in array 
				}
			}
			$name=Input::get('name') ;
			$description=Input::get('descrption');
			$product->name=$name;
			$product->productdes=$description ;
			$product->images=json_encode($uploadedimages);
			$product->save();
			return Redirect::to('product/'.$id.'/edit');  // after save data in database will redirect to index page
                          
    	}
    	else{
    		$product->name= Input::get('name');
		    $product->productdes=Input::get('descrption');
		    $images=Input::get('image');
		    $product->save();
		    return Redirect::to('product');
    	}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) //delete product from database 
	{

        $product = Product::findOrFail($id);
        $product->delete();
		return Redirect::route('product.index'); // redirect to index after delete it
	}


}
