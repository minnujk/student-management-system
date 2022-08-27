<?php

namespace App\Repositories;

use App\Models\Mark;

class MarkRepository
{
    public function getAllmarks() 
    {
        return Mark::with('student')->get();
    }

    public function createMark(array $markDetails) 
    {
        $mark = new Mark($markDetails);
        return $mark->save();
    }

    public function getMarkById($markId) 
    {
        return Mark::findOrFail($markId);
    }

    public function deletemark($markId) 
    {
        $mark = Mark::find($markId);
        return $mark->delete();
    }

    public function updatemark($markId, array $newDetails) 
    {
        return Mark::whereId($markId)->update($newDetails);
    }

}