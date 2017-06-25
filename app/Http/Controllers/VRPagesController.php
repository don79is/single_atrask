<?php namespace App\Http\Controllers;

use App\Models\VRCategoriesTranslations;
use App\Models\VRPages;
use App\Models\VRPagesTranslations;
use App\Models\VRResources;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Controller;

class VRPagesController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /vrpages
     *
     * @return Response
     */
    public function adminIndex()
    {
        {
            $conf['list'] = VRPages::get()->toArray();

            $conf['new'] = route('app.pages.create');
            $conf['title'] = trans('app.pages');


            $conf['create'] = 'app.pages.create';
            $conf['edit'] = 'app.pages.edit';
            $conf['delete'] = 'app.pages.delete';

            return view('admin.adminList', $conf);
        }
    }

    /**
     * Show the form for creating a new resource.
     * GET /vrpages/create
     *
     * @return Response
     */
    public function adminCreate()
    {
        $conf = $this->getFormData();

        $conf['title'] = trans('app.pages');
        $conf['new'] = route('app.pages.create');
        $conf['back'] = 'app.pages.index';

        return view('admin.adminForm', $conf);
    }

    /**
     * Store a newly created resource in storage.
     * POST /vrpages
     *
     * @return Response
     */
    public function adminStore()
    {
        $data = request()->all();



        $resources = request()->file('file');

        $uploadController = new VRResourcesController();
        $record = $uploadController->upload($resources);

        $data['cover_id'] = $record->id;

        $record = VRPages::create($data);
        $data['record_id'] = $record->id;
        $data['slug'] = str_slug($data['title'], '-');
        VRPagesTranslations::create($data);

        return redirect(route('app.pages.edit', $record->id));

    }


    /**
     * Display the specified resource.
     * GET /vrpages/{id}
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
     * GET /vrpages/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function adminEdit($id)
    {
        $record = VRPages::find($id)->toArray();

        $record['title'] = $record['translation']['title'];
        $record['description_short'] = $record['translation']['description_short'];
        $record['description_long'] = $record['translation']['description_long'];
        $record['slug'] = $record['translation']['slug'];
        $record['path'] = $record['image']['path'];


        $conf = $this->getFormData();
        $conf['record'] = $record;
        $conf['title'] = $id;
        $conf['new'] = route('app.pages.create', $id);
        $conf['back'] = 'app.pages.index';

        return view('admin.adminForm', $conf);
    }

    /**
     * Update the specified resource in storage.
     * PUT /vrpages/{id}
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
     * DELETE /vrpages/{id}
     *
     * @param  int $id
     * @return Response
     */
    public
    function destroy($id)
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
        $language = request('language_code');
        if ($language == null) {
            $language = app()->getLocale();
        }
        $conf['fields'][] = [
            'type' => 'dropdown',
            'key' => 'category_id',
            "options" => VRCategoriesTranslations::where('language_code', $language)->pluck('name', 'record_id')
        ];

        $conf['fields'][] = [
            'type' => 'singleline',
            'key' => 'title',
        ];

        $conf['fields'][] = [
            'type' => 'textarea',
            'key' => 'description_short',
        ];
        $conf['fields'][] = [
            'type' => 'textarea',
            'key' => 'description_long',
        ];
        $conf['fields'][] = [
            'type' => 'singleline',
            'key' => 'slug',
        ];
        $conf['fields'][] = [
            "type" => "file",
            "key" => "image",
            "file" => VRResources::pluck('path', 'id')->toArray()
        ];



        return $conf;

    }
}