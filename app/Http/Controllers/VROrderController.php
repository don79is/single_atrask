<?php namespace App\Http\Controllers;

use App\Models\VROrder;
use App\Models\VRUsers;
use Illuminate\Routing\Controller;

class VROrderController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /vrorder
	 *
	 * @return Response
	 */
    public function adminIndex()
    {
        $conf['title'] = trans('app.orders');
        $conf['list'] = VROrder::get()->toArray();

        $conf['new'] = route('app.order.create');
        $conf['edit'] = 'app.order.edit';
        $conf['delete'] = 'app.order.delete';


        return view('admin.adminList', $conf);
    }

	/**
	 * Show the form for creating a new resource.
	 * GET /vrorder/create
	 *
	 * @return Response
	 */
    public function adminCreate()
    {
        $conf = $this->getFormData();
        $conf['title'] = trans('app.orders');
        $conf['new'] = route('app.order.create');
        $conf['back'] = 'app.order.index';
        return view('admin.adminForm', $conf);
    }

	/**
	 * Store a newly created resource in storage.
	 * POST /vrorder
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /vrorder/{id}
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
	 * GET /vrorder/{id}/edit
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
	 * PUT /vrorder/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /vrorder/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
    public function getFormData()
    {
        $config['fields'][] = [
            'type' => 'dropdown',
            'key' => 'status',
            'options' => [
                'pending' => 'pending',
                'canceled' => 'canceled',
                'approved' => 'approved'
            ]
        ];
//                    [
//                        'name' => 'pending',
//                        'value' => 'pending'
//                    ],                    [
//                        'name' => 'canceled',
//                        'value' => 'canceled',
//                    ],                    [
//                        'name' => 'approved',
//                        'value' => 'approved',
//                    ]
        $config['fields'][] = [
            'type' => 'dropdown',
            'key' => 'user_id',
            'options' => VRUsers::where('id', '=', 'user_id')->pluck('name', 'id'),
        ];
        return $config;
    }

}