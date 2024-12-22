<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;

use App\Models\Note;


use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Http\Resources\NoteResource;

class NoteController extends Controller
{   
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $notes = Note::all();

            return NoteResource::collection($notes);
        }
        catch (\Exception $err) {
            return response() -> json([
                'message' => 'Ошибка сервера',
                'error' => $err->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request)
    {
        try {
            $newNote = Note::create($request->validated());

            return response() -> json([
                'message' => 'Заметка успешно создана',
                'data' => NoteResource::make($newNote)
            ], 200);
        }
        catch (\Exception $err) {
            return response() -> json([
                'message' => 'Ошибка сервера',
                'error' => $err->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $note = Note::find($id);

            if (!$note) {
                return response() -> json([
                    'message' => 'Заметка не найдена'
                ], 404);
            }
    
            return NoteResource::make($note);
        }
        catch (\Exception $err) {
            return response() -> json([
                'message' => 'Ошибка сервера',
                'error' => $err->getMessage()
            ], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, $id)
    {
        try {
            $note = Note::find($id);

            if (!$note) {
                return response() -> json([
                    'message' => 'Заметка не найдена'
                ], 404);
            } 
    
            $note -> update($request->validated());
    
            return response() -> json([
                'message' => 'Заметка обновлена',
                'data' => NoteResource::make($note)
            ], 200);
        }
        catch (\Exception $err) {
            return response() -> json([
                'message' => 'Ошибка сервера',
                'error' => $err->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $note = Note::find($id);

            if (!$note) {
                return response() -> json([
                    'message' => 'Заметка не найдена'
                ], 404);
            }
    
            $note -> delete();
    
            return response() -> json([
                'message' => 'Заметка удалена',
            ], 200);
        }
        catch (\Exception $err) {
            return response() -> json([
                'message' => 'Ошибка сервера',
                'error' => $err->getMessage()
            ], 500);
        }
    }
}
