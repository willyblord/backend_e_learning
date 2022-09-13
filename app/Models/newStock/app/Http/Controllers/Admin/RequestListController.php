<?php
namespace App\Http\Controllers\Admin;
use App\Asset;
use App\Http\Controllers\Controller;
use App\RequestItem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestListController extends Controller
{
    //
    public function index()
    {
        return view('admin.requestsList.index');
    }
    public function edit($id)
    {
        return RequestItem::find($id);
    }
    public function update(Request $request, $id)
    {
        $cat = RequestItem::find($id);
        $cat->status = $request->status;
        $cat->save();
        return 'ok';
    }

    public function create()
    {
        //abort_if(Gate::denies('request_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request = Request::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.requests.create');
    }
    public function store(Request $request)
{
    $post = new RequestItem;
        $post->requested_by = $request->requested_by;
        $post->item_name = $request->item_name;
        $post->number_items = $request->namber_items;
        $post->reason = $request->reason;
        $post->save();
        return response()->json([
        'message' => 'New Request created'
        ]);
}

    // public function store(StoreStockRequest $request)
    // {
    //     $stock = Stock::create($request->all());

    //     return redirect()->route('admin.stocks.index');

    // }


    public function show(Asset $asset){
        $data = RequestItem::all();
        return response()->json(['data'=>$data], 200);            
}

    // public function show( $stock)
    // {
    //     // $data = Request::all();
    //     // return response()->json(['data'=>$data], 200);     
    //     // abort_if(Gate::denies('stock_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     // $stock->load('asset.transactions.user.team');

    //     // return view('admin.stocks.show', compact('stock'));
    // }

    public function destroy(Stock $stock)
    {
        abort_if(Gate::denies('stock_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stock->delete();

        return back();

    }

    public function massDestroy(MassDestroyStockRequest $request)
    {
        Stock::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
