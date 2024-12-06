<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class DocumentController extends Controller
{
    public function document()
    {
        $documents = Document::all();
        return view("internal.document.index", compact('documents'));
    }

    public function documentAdd()
    {
        return view("internal.document.add");
    }
    public function documentStore(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            if (Storage::disk("public")->exists("files/" . $fileName)) {
                return redirect()->back()->with('danger', 'File đã tồn tại');
            };
            $path = $file->storeAs('files', $fileName, 'public');
            Document::create(
                [...$request->all(), 'link' => $path]
            );
            return redirect()->route('internal.document')->with('success', 'Thêm thành công');
        }
        return redirect()->route('internal.document');
    }
    public function documentEdit(Document $document)
    {
        return view("internal.document.edit", compact("document"));
    }
    public function documentUpdate(Document $document, Request $request)
    {

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            if (Storage::disk("public")->exists("files/" . $fileName)) {
                return redirect()->back()->with('danger', 'File đã tồn tại');
            };
            if ($document->link) {
                Storage::disk('public')->delete($document->link);
            }
            $path = $file->storeAs('files', $fileName, 'public');
            $document->update([...$request->all(), 'link' => $path]);
            return redirect()->route('internal.document')->with('success', 'Cập nhật thành công.');
        }
        $document->update($request->all());
        return redirect()->route('internal.document')->with('success', 'Cập nhật thành công.');
    }

    public function documentDownload(Document $document)
    {
        return Response::download(public_path("storage/" . $document->link));
    }
    public function  documentDelete(Document $document)
    {
        if ($document->link) {
            Storage::disk('public')->delete($document->link);
        }
        $document->delete();
        return redirect()->route('internal.document')->with('success', "Xóa thành công.");
    }
}
