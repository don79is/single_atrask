<?php namespace App\Http\Controllers;

use App\Models\VROrder;
use App\Models\VRUsers;
use Illuminate\Routing\Controller;

class VROrderController extends Controller
{

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
    public function adminStore()
    {
        $data = request()->all();
        VROrder::create($data);

        return redirect(route('app.order.index'));
    }

    /**
     * Display the specified resource.
     * GET /vrorder/{id}
     *
     * @param  int $id
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
     * @param  int $id
     * @return Response
     */
    public function adminEdit($id)
    {
        $record = VrOrder::find($id)->toArray();
        $record ['record'] = $record;


        $conf = $this->getFormData();
        $conf['title'] = $id;
        $conf['new'] = route('app.order.edit', $id);
        $conf['back'] = 'app.order.index';

        return view('admin.adminCreate', $conf);
    }

    /**
     * Update the specified resource in storage.
     * PUT /vrorder/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function adminUpdate($id)
    {
        $data = request()->all();
        $record = VROrder::find($id);
        $record->update($data);

        return redirect(route('app.order.index'));
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /vrorder/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        VROrder::destroy($id);

        return ["success" => true, "id" => $id];
    }

    public function getFormData()
    {
        $conf['fields'][] = [
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
        $conf['fields'][] = [
            'type' => 'dropdown',
            'key' => 'user_id',
            'options' => VRUsers::pluck('email', 'id')->toArray(),
        ];
        return $conf;
    }

}