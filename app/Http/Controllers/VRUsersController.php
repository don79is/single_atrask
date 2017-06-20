<?php namespace App\Http\Controllers;

use App\Models\VRConnectionsUsersRoles;
use App\Models\VRRoles;
use App\Models\VRUsers;
use Illuminate\Routing\Controller;
use Ramsey\Uuid\Uuid;

class VRUsersController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /vrusers
     *
     * @return Response
     */
    public function adminIndex()
    {
        $conf['title'] = trans('app.users');
        $conf['list'] = VRUsers::get()->toArray();

        $conf['new'] = route('app.users.create');
        $conf['edit'] = 'app.users.edit';
        $conf['delete'] = 'app.users.delete';


        return view('admin.adminList', $conf);
    }


    /**
     * Show the form for creating a new resource.
     * GET /vrusers/create
     *
     * @return Response
     */
    public function adminCreate()
    {
        $conf = $this->getFormData();
        $conf['title'] = trans('app.users');
        $conf['new'] = route('app.users.create');
        $conf['back'] = 'app.users.index';
        return view('admin.adminForm', $conf);
    }

    /**
     * Store a newly created resource in storage.
     * POST /vrusers
     *
     * @return Response
     */
    public function adminStore()
    {
        $data = request()->all();
        $data['id'] = Uuid::uuid4();
        $data['password'] = bcrypt($data['password']);
        $record = VRUsers::create($data);
        $data['user_id'] = $record->id;
        VRConnectionsUsersRoles::create($data);
//dd($record->toArray());
        return redirect()->route('app.users.edit', $record->id);
    }

    /**
     * Display the specified resource.
     * GET /vrusers/{id}
     *
     * @param  int $id
     * @return Response
     */
    public
    function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /vrusers/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public
    function adminEdit($id)
    {
        $record = VRUsers::find($id)->toArray();

        $record['role_id'] = $record['role']['role_id'];

        $conf = $this->getFormData();
        $conf['record'] = $record;
        $conf['title'] = trans('app.users');
        $conf['new'] = route('app.users.create');
        $conf['back'] = 'app.users.index';
        return view('admin.adminForm', $conf);
    }

    /**
     * Update the specified resource in storage.
     * PUT /vrusers/{id}
     *
     * @param  int $id
     * @return Response
     */
    public
    function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /vrusers/{id}
     *
     * @param  int $id
     * @return Response
     */
    public
    function adminDestroy($id)
    {
       VRConnectionsUsersRoles::where('user_id', $id)->delete();
        VRUsers::destroy($id);
        return json_encode(["success" => true, "id" => $id]);
    }

    public function getFormData()
    {
        $config['fields'][] = [
            'type' => 'singleline',
            'key' => 'name',
        ];
        $config['fields'][] = [
            'type' => 'singleline',
            'key' => 'email',
        ];
        $config['fields'][] = [
            'type' => 'singleline',
            'key' => 'password',
        ];
        $config['fields'][] = [
            'type' => 'singleline',
            'key' => 'phone',
        ];
        $config['fields'][] = [
            'type' => 'dropdown',
            'key' => 'role_id',
            'options' => VRRoles::pluck('name', 'id')
        ];
        return $config;
    }

}