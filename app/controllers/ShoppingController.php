<?php

class ShoppingController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = Item::all();
        return $items;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $input = Input::get('name');

        $item = new Item;
        $item->name = $input;
        $item->save();

        if($item) {
            return $item->id;
        } else {
            return 0;
        }
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
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::get('is_done');

    	$item = Item::find($id);

    	if(!$item) return false;

    	$item->is_done = filter_var($input, FILTER_VALIDATE_BOOLEAN);
    	$item->save();
         
    	if($item) {
        	return $item->id;
        } else {
        	return 0;
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$item = Item::find($id);

        if(!$item) return false;

        $item->delete();
	}

}
