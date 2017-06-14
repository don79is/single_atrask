<?php namespace App\Http\Controllers;

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
        //
    }

    /**
     * Show the form for creating a new resource.
     * GET /vrmenu/create
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * POST /vrmenu
     *
     * @return Response
     */
    public function store()
    {
        //
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
    public function edit($id)
    {
        //
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
            'key' => 'url',
        ];
        $conf['fields'][] = [
            'type' => 'checkbox',
            'key' => 'new_window',
            'options' => [
                'value' => 'label'
            ]
        ];
        return $conf;
    }

}