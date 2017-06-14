<?php namespace App\Http\Controllers;

use App\Models\VRCategories;
use App\Models\VRCategoriesTranslations;
use Illuminate\Routing\Controller;

class VRCategoriesController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /vrcategories
	 *
	 * @return Response
	 */
	public function adminIndex()
	{
        $conf ['title'] =trans('app.categories');
        $conf ['list'] = VRCategories::get()->toArray();
        $conf ['new'] = route('app.categories.create');
        $conf ['create'] = 'app.categories.create';
        $conf ['edit'] = 'app.categories.edit';
        $conf ['delete'] = 'app.categories.delete';


        return view('admin.adminList', $conf);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /vrcategories/create
	 *
	 * @return Response
	 */
	public function adminCreate()
	{
        $conf = $this->getFormData();
        $conf['title'] = trans('app.categories');
        $conf['new'] = route('app.categories.create');
        $conf['back'] = 'app.categories.index';

        return view('admin.adminForm', $conf);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /vrcategories
	 *
	 * @return Response
	 */
	public function adminStore()
	{
		$data = request()->all();
		$record = VRCategories::create();
		$data['record_id']= $record->id;
		VRCategoriesTranslations::create($data);

		return redirect()->route('app.categories.edit' , [$record->id]);
	}

	/**
	 * Display the specified resource.
	 * GET /vrcategories/{id}
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
	 * GET /vrcategories/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function adminEdit($id)
	{
        $record = VrCategories::find($id)->toArray();
//        dd($record);
        $conf = $this->getFormData();
        $conf['title'] = $id;
        $conf['new'] = route('app.categories.create', $id);
        $conf['back'] = 'app.categories.index';
        return view('admin.adminForm', $conf);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /vrcategories/{id}
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
	 * DELETE /vrcategories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function adminDestroy($id)
	{
        VRCategoriesTranslations::destroy(VRCategoriesTranslations::where('record_id', $id)->pluck('id')->toArray());
        VRCategories::destroy($id);

        return ["success" => true, "id" => $id];
	}

    public function getFormData()
    {
        $conf['fields'][] = [
            'type' => 'dropdown',
            'key' => 'language_code',
            'options' => getActiveLanguages()
        ];
        $conf['fields'][] = [
            'type' => 'singleline',
            'key' => 'name',
        ];
        return $conf;
    }
}