<?php

namespace App\Http\Controllers\Admin;

use App\OrderTransaction;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = OrderTransaction::all();
        $data['page_title'] = 'All Tranasactions';
        $data['transactions'] = $transactions;
        return view('admin.transactions',$data);
    }

    public function refund($id) {
        $transaction = OrderTransaction::find($id);

        if(!strstr($transaction->transaction_id,'FREE-') ) {
            $result = \Braintree_Transaction::refund($transaction->transaction_id);
            $transaction->update([
                'order_status' => OrderTransaction::STATE_REFUND
            ]);

            if($result->success == 1) {
                return redirect()->back()->with('status', 'Successfully Refunded');
            }

        }
        return redirect()->back()->with('error', 'Something went wrong');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
