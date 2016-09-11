<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\TicketsFormRequest;
use App\Ticket;
use App\Comment;

class TicketsController extends Controller
{
    //
    public function index()
    {
        $tickets = Ticket::all();
        return view('tickets.index', compact('tickets'));
    }
    public function create()
    {
        return view('tickets.create');
    }

    public function store(TicketsFormRequest $request)
    {

        $slug = uniqid();
        $ticket = new Ticket(array(
            'title'     => $request->get('title'),
            'content'   => $request->get('content'),
            'slug'      => $slug,
            'user_id'   => 0
        ));
        $ticket->save();

        return redirect('/contact')->with('status', 'Your Ticket was submitted! The Unique id '.$slug);
    }

    public function show($slug)
    {
        $ticket = Ticket::whereSlug($slug)->firstOrFail();
        $comments = $ticket->comments()->get();
        return view('tickets.show', compact('ticket','comments'));
    }

    public function edit($slug){
        $ticket = Ticket::whereSlug($slug)->firstOrFail();
        return view('tickets.edit', compact('ticket'));
    }

    public function update($slug, TicketsFormRequest $request){
        $ticket = Ticket::whereSlug($slug)->firstOrFail();
        $ticket->title = $request->get('title');
        $ticket->content = $request->get('content');
        if($request->get('status') != null) {
            $ticket->status = 0;
        } else {
            $ticket->status = 1;
        }
        $ticket->save();
        $msg = 'The ticket '.$slug.' has been updated!';
        return redirect(action('TicketsController@edit', $ticket->slug))->with('status', $msg);
    }

    public function destroy($slug)
    {
        $ticket = Ticket::whereSlug($slug)->firstOrFail();
        $ticket->delete();
        $msg = 'The ticket '.$slug.' has been deleted!';
        return redirect('/tickets')->with('status', $msg);
    }
}
