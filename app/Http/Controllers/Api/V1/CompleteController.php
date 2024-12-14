<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use Illuminate\Http\Request;

class CompleteController extends Controller
{
    public function __invoke(Request $request, Note $note)
    {
        $note->isComplete = $request->isComplete;

        $note->save();

        return NoteResource::make($note);
    }
}
