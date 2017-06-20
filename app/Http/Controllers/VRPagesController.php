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
            $conf['title'] = trans('app.pages');
            $conf['new'] = route('app.pages.create');

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
//        dd($data);
        $vr_resource = request()->file('file');

        $resource = $this->uploadFile($vr_resource);

        $record = VRPages::create(array(
            'category_id' => $data['category_id'],
            'cover_id' => $resource->id
        ));

        VRPagesTranslations::create(array(
            'record_id' => $record->id,
            'language_code' => $data['language_code'],
            'title' => $data['title'],
            'description_short' => $data['description_short'],
            'description_long' => $data['description_long'],
            'slug' => $data['slug']

        ));

        return redirect('/admin/pages/')->with('message', 'Puslapis sėkmingai sukurtas!');

    }

    public function uploadFile(UploadedFile $file)
    {
        $data =
            [
                "size" => $file->getsize(),
                "mime_type" => $file->getMimetype(),
            ];
        $path = 'upload/' . date("Y/m/d/". '/');
        $fileName = Carbon::now()->timestamp . '-' . $file->getClientOriginalName();
        $file->move(public_path($path), $fileName);
        $data["path"] = $path . $fileName;
        return VRResources::create($data);
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
    public
    function edit($id)
    {
        //
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

    public
    function getFormData()
    {
        $language = request('language_code');
        if ($language == null) {
            $language = app()->getLocale();

        $conf['fields'][] = [
            'type' => 'dropdown',
            'key' => 'language_code',
            'options' => getActiveLanguages()
        ];



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
                "key" => "cover_id",
                "file" => VRResources::pluck('path', 'id')->toArray()
            ];


            return $conf;
        }
    }
}