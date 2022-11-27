<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //   $contacts    = DB::table('contacts')->orderBy( 'id', 'desc' )->paginate(3);
      $contacts = Contact::orderBy( 'id', 'desc' )->paginate( 5 );
        return view( 'contacts.index', compact( 'contacts' ) );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view( 'contacts.create' );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        
        Contact::create($request->post());

        return redirect()->route('contacts.index')->with('success','Company has been created successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
     public function show(Contact $company)
    {
        return view('contacts.show',compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return view( 'contacts.edit', compact( 'contact' ) );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
   {
    $request->validate( [
        'name'    => 'required',
        'email'   => 'required',
        'address' => 'required',
    ] );

    $contact->fill( $request->post() )->save();

    return redirect()->route( 'contacts.index' )->with( 'success', 'Contact Has Been updated successfully' );
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
return redirect()->route( 'contacts.index' )->with( 'success', 'Company has been deleted successfully' );

    }
}
