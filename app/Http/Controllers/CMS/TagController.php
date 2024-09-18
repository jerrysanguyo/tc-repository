<?php

namespace App\Http\Controllers\CMS;

use App\{
    Http\Controllers\Controller,
    Http\Requests\CMS\TagRequest,
    Services\CMS\TagService,
    DataTables\UniversalDataTable,
    Models\Tag,
    Models\UserDetail
};

use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    protected $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function index(UniversalDataTable $dataTable)
    {
        $department = Auth::user()->detail->department_id;
        $data = Tag::tagsDepartment($department)->get();
        $pageTitle = 'Tag';
        $columns = ['Name', 'Remarks', 'Created by', 'Updated by', 'Action'];

        return $dataTable->render('cms.universal.index', compact(
            'data',
            'pageTitle',
            'columns',
        ));
    }

    public function store(TagRequest $request)
    {
        $userRole = Auth::user()->role;
        $this->tagService->store($request->validated());

        return redirect()->route($userRole . '.Tag.index')->with('success', 'Tag added successfully!');
    }
    
    public function edit(Tag $Tag)
    {
        $pageTitle = 'Tag';
        $$pageTitle = $Tag;

        return view('cms.universal.edit', compact(
            $pageTitle,
            'pageTitle'
        ));
    }
    
    public function update(TagRequest $request, Tag $Tag)
    {
        $userRole = Auth::user()->role;
        $this->tagService->update($Tag, $request->validated());

        return redirect()->route($userRole . '.Tag.edit', $Tag)->with('success', 'Tag updated successfully!');
    }
    
    public function destroy(Tag $Tag)
    {
        $userRole = Auth::user()->role;
        $this->tagService->destroy($Tag);

        return redirect()->route($userRole . '.Tag.index')->with('success', 'Tag deleted successfully!');
    }
}
