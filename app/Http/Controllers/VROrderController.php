<?php namespace App\Http\Controllers;

use App\Models\VROrder;
use App\Models\VRPages;
use App\Models\VRPagesTranslations;
use App\Models\VRReservations;
use App\Models\VRUsers;
use Carbon\Carbon;
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
     * GET /vrorder/reserved
     *
     * @return Response
     */
    public function reserved()
    {
        $data = request()->all();

        $start = Carbon::parse($data['time'])->startOfDay();
        $end = Carbon::parse($data['time'])->endOfDay();

        return (VRReservations::where('experience_id', $data)->where('time', '>=', $start)->where('time', '<=', $end)->pluck('time')->toArray());


    }

    /**
     * Show the form for creating a new resource.
     * GET /vrorder/create
     *
     * @return Response
     */
    public function adminCreate()
    {


//        dd(VRPages::where('category_id','vr_rooms')->join('vr_pages_translations','vr_pages.id','=','vr_pages_translations.record_id')->get()->toArray());
        $conf = $this->getFormData();
        $pagesData = (new VRPages)->getTable();
dd($pagesData);
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
        $record = VROrder::find($id)->toArray();
        $record ['record'] = $record;


        $conf = $this->getFormData();
        $conf['user_email'] = VRUsers::find(VROrder::find($id)->user_id)->toArray();

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
    private function getVRroomsWithcategory()
    {
        $pagesData = (new VRPages)->getTable();
        $pagesDataTrans = (new VRPagesTranslations)->getTable();
        return (VRPages::where('category_id', 'vr_room')->join($pagesDataTrans, "$pagesDataTrans.record_id", '=' ,"$pagesData.id")
            ->pluck("$pagesDataTrans.title", "$pagesData.id")->toArray());
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

        $language = request('language_code');
        if ($language == null) {
            $language = app()->getLocale();
        }
        $conf['fields'][] = [
            'type' => 'dropdown',
            'key' => 'vr_rooms',
            'options' => $this->getVRroomsWithcategory()
        ];
        $conf['fields'][] = [
            "type" => "user_down",
            "key" => "user_id",
            "options" => VRUsers::pluck('email', 'id')->toArray()
        ];

        $conf['fields'][] = [
            'type' => 'dropdown',
            'key' => 'time',
            'options' => $this->getData(),
        ];
        $conf['fields'][] = [
            "type" => "reservations",
            "key" => "reservations",
        ];
        return $conf;
    }

    public function getData()
    {
        $date = [];
        for ($days = Carbon::createFromDate();
             $days->lte(Carbon::createFromDate()->addDays(14));
             $days->addDay()) {
            $date[$days->format('Y-m-d')] = $days->format('Y-m-d');
        }
        return ($date);
    }

}