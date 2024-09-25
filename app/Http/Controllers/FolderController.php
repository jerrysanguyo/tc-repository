<?php

namespace App\Http\Controllers;

use App\{
    Models\Folder,
    DataTables\UniversalDataTable,
};
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function index(UniversalDataTable $dataTable)
    {
        return $dataTable->render('folder.index');
    }
    
    public function create()
    {
        //
    }
    
    public function store(Request $request)
    {
        //
    }
    
    public function show(Folder $folder)
    {
        //
    }
    
    public function edit(Folder $folder)
    {
        //
    }
    
    public function update(Request $request, Folder $folder)
    {
        //
    }
    
    public function destroy(Folder $folder)
    {
        //
    }
}
