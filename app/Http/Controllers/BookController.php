<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Exception;

class BookController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $books = Book::query();

            // Debugging: Log nilai yang diterima
            Log::info('Received filters:', $request->all());

            // Filter berdasarkan penulis
            if ($request->filled('penulis')) {
                $penulisList = is_array($request->penulis) ? $request->penulis : [$request->penulis];
                $books->whereIn('penulis', $penulisList);
            }

            // Filter berdasarkan tahun
            if ($request->filled('tahun')) {
                $tahunList = is_array($request->tahun) ? $request->tahun : [$request->tahun];
                $books->whereIn('tahun', $tahunList);
            }

            // Debugging: Log query yang dihasilkan
            Log::info('Generated query:', ['sql' => $books->toSql(), 'bindings' => $books->getBindings()]);

            return DataTables::of($books)
                ->addIndexColumn()
                ->addColumn('action', function ($book) {
                    return '<div class="d-flex gap-2">
                            <button type="button" class="btn btn-warning btn-sm btn-edit"
                                data-bs-toggle="modal"
                                data-bs-target="#modalUbah"
                                data-id="' . $book->id . '"
                                data-judul="' . $book->judul . '"
                                data-penulis="' . $book->penulis . '"
                                data-tahun="' . $book->tahun . '">
                                Ubah
                            </button>
                            <form action="' . route('book.destroy', $book->id) . '" method="POST" class="d-inline">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete(event)">
                                    Hapus
                                </button>
                            </form>
                        </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $penulis = Book::select('penulis')->distinct()->pluck('penulis');
        $tahun = Book::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        return view('book.index', compact('penulis', 'tahun'));
    }

    public function create()
    {
        return view('book.create');
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            'judul'  => 'required|string',
            'penulis' => 'required|string',
            'tahun' => 'required|integer',
        ]);

        Book::create($validasi);
        return redirect()->route('book.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return response()->json($book);
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'judul' => 'required|string|max:255',
                'penulis' => 'required|string|max:255',
                'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            ]);

            $book = Book::findOrFail($id);
            $book->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Buku berhasil diperbarui',
                'data' => $book
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan'
            ], 404);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui buku',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $book = Book::findOrFail($id);
            $book->delete();
            return redirect()->route('book.index')->with('success', 'Buku berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->route('book.index')->with('error', 'Gagal menghapus buku.');
        }
    }
}
