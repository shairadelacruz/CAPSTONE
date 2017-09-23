<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Log;
use App\User;
use App\Client;
use App\DocumentType;
use App\Http\Requests;

class AdminLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $logs = Log::all();
        //$date = $log->date_received->toDateString();
        return view('admin.management.logs.index', compact('logs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $documents = DocumentType::all();
        $clients = Client::all();
        $users = User::all();
        return view('admin.management.logs.create', compact('documents', 'clients', 'users'));
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

       /* $this->validate($request, [
            'reference_no' => 'required',
            'client_id' => 'required'
        ]);*/
        $date_received = $request->date_received;
        $client_id = $request->client_id;
        $received_from = $request->received_from;
        $user_id = $request->user_id;


            $input = $request->all(); 
            $images=array();
            if($files=$request->file('document_path')) {
                foreach($files as $key => $v){
                    $file=$request->file('document_path');
                    $name = time() . $file[$key]->getClientOriginalName();
                    $file[$key]->move(public_path().'/images/',$name);
                    $images[]=$name;

                    $logs = new Log([
                            'date_received'=>$date_received,
                            'client_id'=>$client_id,
                            'received_from'=>$received_from,
                            'user_id'=>$user_id,
                            'reference_no'=>$request->reference_no[$key],
                            'document_type_id'=>$request->document_type_id[$key],
                            'document_path'=>$name
                            
                ]);

                $logs->save();
                }   


            }

        //Log::create($input);

       return redirect('/admin/management/logs');
        //return $images;

    }

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
        $log = Log::findOrFail($id);
        $date = $log->date_received->toDateString();
        $documents = DocumentType::lists('name', 'id')->all();
        $clients = Client::lists('company_name', 'id')->all();
        $users = User::lists('name', 'id')->all();
        //$roles = Role::lists('name', 'id')->all();
        return view('admin.management.logs.edit', compact('log','date','documents', 'clients', 'users'));
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
        $this->validate($request, [
            'reference_no' => 'required',
            'client_id' => 'required'
        ]);

        $log = Log::findOrFail($id);

        $input = $request->all();

        if($request->file('document_path')) {

            $file = $request->file('document_path');
            $name = time() . $file->getClientOriginalName();
            //$file = $request->file('document_path');
            //$file->move('images', $name);
            $file->move(public_path().'/images/',$name);
            $input['document_path'] = $name;
        }  

        $log->update($input);
        //return $input;
        return redirect('/admin/management/logs');
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
        $log = Log::findOrFail($id);

        $log->delete();

        Session::flash('deleted_log','The log has been deleted');

        return redirect('/admin/management/logs');
    }
}
