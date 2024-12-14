<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;

use App\Models\Note;


use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Http\Resources\NoteResource;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

class NoteController extends Controller
{   
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::all();

        return NoteResource::collection($notes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StoreNoteRequest $request)
    {
        $newNote = Note::create($request->validated());

        return NoteResource::make($newNote);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        return NoteResource::make($note);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        $note -> update($request->validate());

        return NoteResource::make($note);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note -> delete();

        return response() -> noContent();
    }
}
