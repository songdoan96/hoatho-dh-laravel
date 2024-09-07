<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Response;
use Storage;

class DocumentController extends Controller
{
    public function document()
    {
        $documents = Document::orderby('bophan')->get();
        return view("internal.document.index", compact('documents'));
    }
    public function documentEdit(Document $document)
    {
        return view("internal.document.edit", compact("document"));
    }
    public function documentUpdate(Document $document, Request $request)
    {

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($document->link);
            $file = $request->file('file');
            $path = $file->store('files', 'public');
            $document->update([...$request->all(), 'link' => $path]);
            return redirect()->route('internal.document')->with('success', 'Cập nhật thành công.');
        }
        $document->update($request->all());
        return redirect()->route('internal.document')->with('success', 'Cập nhật thành công.');
    }
    public function documentAdd()
    {
        return view("internal.document.add");
    }
    public function documentStore(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('files', 'public');
            Document::create(
                [...$request->all(), 'link' => $path]
            );
            return redirect()->route('internal.document')->with('success', 'Thêm thành công');
        }
        return redirect()->route('internal.document');
    }
    public function documentDownload(Document $document)
    {
        return Response::download(public_path("storage/" . $document->link));
    }
    public function  documentDelete(Document $document)
    {
        Storage::disk('public')->delete($document->link);
        $document->delete();
        return redirect()->route('internal.document')->with('success', "Xóa thành công.");
    }
}
