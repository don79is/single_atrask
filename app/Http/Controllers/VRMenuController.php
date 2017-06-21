<?php namespace App\Http\Controllers;

use App\Models\VRMenu;
use App\Models\VRMenuTranslations;
use Illuminate\Routing\Controller;

class VRMenuController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /vrmenu
     *
     * @return Response
     */
    public function adminIndex()
    {
        $conf ['list'] = VRMenu::get()->toArray();
        $conf ['new'] = route('app.menu.create');
        $conf ['title'] = trans('app.menu');
        $conf['create'] = 'app.menu.create';
        $conf['edit'] = 'app.menu.edit';
        $conf['delete'] = 'app.menu.delete';

        return view('admin.adminList', $conf);
    }

    /**
     * Show the form for creating a new resource.
     * GET /vrmenu/create
     *
     * @return Response
     */
    public function adminCreate()
    {
        $conf = $this->getFormData();

        $conf['title'] = trans('app.menu');
        $conf['new'] = route('app.menu.create');
        $conf['back'] = 'app.menu.index';

        return view('admin.adminForm', $conf);
    }

    /**
     * Store a newly created resource in storage.
     * POST /vrmenu
     *
     * @return Response
     */
    public function adminStore()
    {
        $data = request()->all();
        $record = VRMenu::create($data);
        $data['record_id'] = $record->id;
        VRMenuTranslations::create($data);

        return redirect()->route('app.menu.edit', [$record->id]);
    }

    /**
     * Display the specified resource.
     * GET /vrmenu/{id}
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
     * GET /vrmenu/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function adminEdit($id)
    {
        $record = VRMenu::find($id)->toArray();
        $record['url'] = $record['translation']['url'];
        $record['name'] = $record['translation']['name'];
        $record['language_code'] = $record['translation']['language_code'];
//
        $conf = $this->getFormData();
        $conf['title'] = $id;
        $conf['new'] = route('app.menu.create', $id);
        $conf['back'] = 'app.menu.index';
        return view('admin.adminForm', $conf);
    }

    /**
     * Update the specified resource in storage.
     * PUT /vrmenu/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /vrmenu/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
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

        $conf['fields'][] = [
            'type' => 'singleline',
            'key' => 'url',
        ];
        $conf['fields'][] = [
            'type' => 'singleline',
            'key' => 'sequence',
        ];

        $language = request('language_code');
        if ($language == null) {
            $language = app()->getLocale();
        }
        $conf['fields'][] = [
            'type' => 'dropdown',
            'key' => 'vr_parent_id',
            'options' => VRMenuTranslations::where('language_code', '=', $language)->pluck('name', 'record_id')
        ];
        $conf['fields'][] =
            [
                'type' => 'checkbox',
                'key' => 'new-window',
                'options' =>
                    [
                        [
                            'name' => 'new_window',
                            'value' => 1,
                            'title' => trans('app.yes'),
                        ],
                    ]
            ];

        return $conf;
    }

}