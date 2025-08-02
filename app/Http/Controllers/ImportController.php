<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function users(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        try {
            $file     = $request->file('file');
            $fileName = $file->hashName();
            $filePath = $file->storeAs('excel/', $fileName, 'public');

            Excel::import(new UsersImport(), storage_path('app/public/excel/' . $fileName));
            Storage::delete($filePath);

            return redirect()->back()->with('success', 'Successfully imported data');
        } catch (\Throwable $e) {
            Log::error('IMPORT USERS: ', ['exception' => $e]);
            return redirect()->back()->with('error', 'An error occurred while importing data');
        }
    }
}
