<?php namespace App\Http\Controllers;

use App\Models\VRMenu;
use App\Models\VRPages;
use App\Models\VRPagesTranslations;
use Illuminate\Routing\Controller;

class FrontEndController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /frontend
     *
     * @return Response
     */
    public function index()
    {

        return view('front-end.front-endCore');
    }

    /**
     * Show the form for creating a new resource.
     * GET /frontend/create
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * POST /frontend
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     * GET /frontend/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show()
    {
        $conf = VRPagesTranslations::where('slug')->where('language_code')->first();


return view('app.menu.show',$conf);

	}

    /**
     * Show the form for editing the specified resource.
     * GET /frontend/{id}/edit
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
     * PUT /frontend/{id}
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
     * DELETE /frontend/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}