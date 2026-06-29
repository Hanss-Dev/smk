<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

/**
 * Controller bersama untuk tiga halaman:
 *   - Podcast        (page_key = 'podcast')
 *   - Lab Komputer   (page_key = 'lab-komputer')
 *   - Safety Riding  (page_key = 'safety-riding')
 *
 * Routes yang dibutuhkan (letakkan di routes/web.php):
 *
 *   Route::get('/admin/podcast',         [PageSectionController::class, 'indexPodcast'])->name('admin.podcast.index');
 *   Route::get('/admin/podcast/create',  [PageSectionController::class, 'createPodcast'])->name('admin.podcast.create');
 *   Route::post('/admin/podcast',        [PageSectionController::class, 'storePodcast'])->name('admin.podcast.store');
 *   Route::get('/admin/podcast/edit',    [PageSectionController::class, 'editPodcast'])->name('admin.podcast.edit');
 *   Route::put('/admin/podcast',         [PageSectionController::class, 'updatePodcast'])->name('admin.podcast.update');
 *
 *   // Begitu pula untuk lab dan safety-riding (ganti prefix)
 *   Route::get('/admin/lab',             [PageSectionController::class, 'indexLab'])->name('admin.lab.index');
 *   ...dst
 *
 *   // Delete satu elemen (AJAX/form submit)
 *   Route::delete('/admin/page-section/{key}/section/{sIdx}/element/{eIdx}',
 *       [PageSectionController::class, 'deleteElement'])->name('admin.pagesection.deleteElement');
 *   Route::delete('/admin/page-section/{key}/section/{sIdx}',
 *       [PageSectionController::class, 'deleteSection'])->name('admin.pagesection.deleteSection');
 */
class PageSectionController extends Controller
{
    // ═══════════════════════════════════════════════════════════════════════
    //  INDEX
    // ═══════════════════════════════════════════════════════════════════════

    public function indexPodcast()
    {
        return $this->indexPage(PageSection::KEY_PODCAST, 'admin.podcast.index', 'Podcast');
    }

    public function indexLab()
    {
        return $this->indexPage(PageSection::KEY_LAB, 'admin.lab.index', 'Lab Komputer');
    }

    public function indexSafetyRiding()
    {
        return $this->indexPage(PageSection::KEY_SAFETY_RIDING, 'admin.safety-riding.index', 'Safety Riding');
    }

    private function indexPage(string $key, string $routeName, string $title)
    {
        $page = PageSection::forPage($key);
        $viewKey = str_replace('-', '_', $key); // misal: safety_riding
        return view("admin.{$this->viewFolder($key)}.index", compact('page', 'title'));
    }

    // ═══════════════════════════════════════════════════════════════════════
    //  CREATE
    // ═══════════════════════════════════════════════════════════════════════

    public function createPodcast()      { return $this->createPage(PageSection::KEY_PODCAST,       'Podcast'); }
    public function createLab()          { return $this->createPage(PageSection::KEY_LAB,           'Lab Komputer'); }
    public function createSafetyRiding() { return $this->createPage(PageSection::KEY_SAFETY_RIDING, 'Safety Riding'); }

    private function createPage(string $key, string $title)
    {
        return view("admin.{$this->viewFolder($key)}.create", compact('key', 'title'));
    }

    // ═══════════════════════════════════════════════════════════════════════
    //  STORE  (tambah section baru ke halaman)
    // ═══════════════════════════════════════════════════════════════════════

    public function storePodcast(Request $request)      { return $this->storePage($request, PageSection::KEY_PODCAST,       'admin.podcast.index'); }
    public function storeLab(Request $request)          { return $this->storePage($request, PageSection::KEY_LAB,           'admin.lab.index'); }
    public function storeSafetyRiding(Request $request) { return $this->storePage($request, PageSection::KEY_SAFETY_RIDING, 'admin.safety-riding.index'); }

    private function storePage(Request $request, string $key, string $redirectRoute)
    {
        $request->validate([
            'nama_bagian'      => 'required|string|max:150',
            'elemen_type'      => 'required|array|min:1',
            'elemen_type.*'    => 'required|in:text,image,link',
            'elemen_value.*'   => 'nullable|string',
            'elemen_alt.*'     => 'nullable|string|max:200',
            'elemen_label.*'   => 'nullable|string|max:150',
            'elemen_file.*'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $page    = PageSection::forPage($key);
        $content = $page->content ?? [];
        $folder  = PageSection::uploadFolder($key);

        // Bangun array elemen
        $elemen = [];
        foreach ($request->elemen_type as $i => $type) {
            $el = ['type' => $type];

            if ($type === 'image') {
                // Upload file gambar
                if ($request->hasFile("elemen_file.{$i}")) {
                    $file     = $request->file("elemen_file.{$i}");
                    $fileName = time() . "-{$i}-" . basename($file->getClientOriginalName());
                    $file->move(public_path($folder), $fileName);
                    $el['value'] = $fileName;
                } else {
                    continue; // skip elemen image tanpa file
                }
                $el['alt'] = $request->input("elemen_alt.{$i}", '');
            } elseif ($type === 'link') {
                $el['value'] = $request->input("elemen_value.{$i}", '');
                $el['label'] = $request->input("elemen_label.{$i}", $el['value']);
            } else {
                // text
                $value = $request->input("elemen_value.{$i}", '');
                if ($value === '' || $value === null) continue;
                $el['value'] = $value;
            }

            $elemen[] = $el;
        }

        $content[] = [
            'type'  => 'section',
            'nama'  => $request->nama_bagian,
            'elemen'=> $elemen,
        ];

        $page->update(['content' => $content]);

        return redirect()->route($redirectRoute)
            ->with('success', 'Bagian berhasil ditambahkan.');
    }

    // ═══════════════════════════════════════════════════════════════════════
    //  EDIT
    // ═══════════════════════════════════════════════════════════════════════

    public function editPodcast()      { return $this->editPage(PageSection::KEY_PODCAST,       'Podcast'); }
    public function editLab()          { return $this->editPage(PageSection::KEY_LAB,           'Lab Komputer'); }
    public function editSafetyRiding() { return $this->editPage(PageSection::KEY_SAFETY_RIDING, 'Safety Riding'); }

    private function editPage(string $key, string $title)
    {
        $page = PageSection::forPage($key);
        return view("admin.{$this->viewFolder($key)}.edit", compact('page', 'key', 'title'));
    }

    // ═══════════════════════════════════════════════════════════════════════
    //  UPDATE  (edit satu elemen)
    // ═══════════════════════════════════════════════════════════════════════

    public function updatePodcast(Request $request)      { return $this->updatePage($request, PageSection::KEY_PODCAST,       'admin.podcast.index'); }
    public function updateLab(Request $request)          { return $this->updatePage($request, PageSection::KEY_LAB,           'admin.lab.index'); }
    public function updateSafetyRiding(Request $request) { return $this->updatePage($request, PageSection::KEY_SAFETY_RIDING, 'admin.safety-riding.index'); }

    private function updatePage(Request $request, string $key, string $redirectRoute)
    {
        $request->validate([
            'section_index'    => 'required|integer|min:0',
            'nama_bagian'      => 'required|string|max:150',
            'elemen_type'      => 'required|array',
            'elemen_type.*'    => 'required|in:text,image,link',
            'elemen_value.*'   => 'nullable|string',
            'elemen_alt.*'     => 'nullable|string|max:200',
            'elemen_label.*'   => 'nullable|string|max:150',
            'elemen_file.*'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'elemen_existing.*'=> 'nullable|string',
        ]);

        $page    = PageSection::forPage($key);
        $content = $page->content ?? [];
        $sIdx    = (int) $request->section_index;
        $folder  = PageSection::uploadFolder($key);

        if (!isset($content[$sIdx])) {
            return back()->withErrors(['section' => 'Bagian tidak ditemukan.']);
        }

        $content[$sIdx]['nama'] = $request->nama_bagian;

        $elemen = [];
        foreach ($request->elemen_type as $i => $type) {
            $el = ['type' => $type];

            if ($type === 'image') {
                if ($request->hasFile("elemen_file.{$i}")) {
                    // Hapus gambar lama jika ada
                    $oldFile = $request->input("elemen_existing.{$i}", '');
                    if ($oldFile) {
                        $oldPath = public_path("{$folder}/{$oldFile}");
                        if (File::exists($oldPath)) File::delete($oldPath);
                    }
                    $file     = $request->file("elemen_file.{$i}");
                    $fileName = time() . "-{$i}-" . basename($file->getClientOriginalName());
                    $file->move(public_path($folder), $fileName);
                    $el['value'] = $fileName;
                } else {
                    // Tetap pakai gambar lama
                    $el['value'] = $request->input("elemen_existing.{$i}", '');
                    if (!$el['value']) continue;
                }
                $el['alt'] = $request->input("elemen_alt.{$i}", '');
            } elseif ($type === 'link') {
                $el['value'] = $request->input("elemen_value.{$i}", '');
                $el['label'] = $request->input("elemen_label.{$i}", $el['value']);
            } else {
                $value = $request->input("elemen_value.{$i}", '');
                if ($value === '' || $value === null) continue;
                $el['value'] = $value;
            }

            $elemen[] = $el;
        }

        $content[$sIdx]['elemen'] = $elemen;
        $page->update(['content' => $content]);

        return redirect()->route($redirectRoute)
            ->with('success', 'Bagian berhasil diperbarui.');
    }

    // ═══════════════════════════════════════════════════════════════════════
    //  DELETE ELEMENT  (hapus satu elemen dalam sebuah section)
    // ═══════════════════════════════════════════════════════════════════════

    public function deleteElement(Request $request, string $key, int $sIdx, int $eIdx)
    {
        $page    = PageSection::forPage($key);
        $content = $page->content ?? [];
        $folder  = PageSection::uploadFolder($key);

        if (!isset($content[$sIdx]['elemen'][$eIdx])) {
            return back()->withErrors(['msg' => 'Elemen tidak ditemukan.']);
        }

        $el = $content[$sIdx]['elemen'][$eIdx];

        // Hapus file dari storage jika elemen adalah gambar
        if ($el['type'] === 'image' && !empty($el['value'])) {
            $path = public_path("{$folder}/{$el['value']}");
            if (File::exists($path)) File::delete($path);
        }

        array_splice($content[$sIdx]['elemen'], $eIdx, 1);
        $page->update(['content' => $content]);

        return back()->with('success', 'Elemen berhasil dihapus.');
    }

    // ═══════════════════════════════════════════════════════════════════════
    //  DELETE SECTION  (hapus satu section beserta semua elemennya)
    // ═══════════════════════════════════════════════════════════════════════

    public function deleteSection(Request $request, string $key, int $sIdx)
    {
        $page    = PageSection::forPage($key);
        $content = $page->content ?? [];
        $folder  = PageSection::uploadFolder($key);

        if (!isset($content[$sIdx])) {
            return back()->withErrors(['msg' => 'Bagian tidak ditemukan.']);
        }

        // Hapus semua gambar dalam section ini
        foreach ($content[$sIdx]['elemen'] ?? [] as $el) {
            if ($el['type'] === 'image' && !empty($el['value'])) {
                $path = public_path("{$folder}/{$el['value']}");
                if (File::exists($path)) File::delete($path);
            }
        }

        array_splice($content, $sIdx, 1);
        $page->update(['content' => $content]);

        return back()->with('success', 'Bagian berhasil dihapus.');
    }

    // ─── Private helper ────────────────────────────────────────────────────

    private function viewFolder(string $key): string
    {
        // 'podcast' → 'podcast', 'lab-komputer' → 'lab', 'safety-riding' → 'safety-riding'
        $map = [
            PageSection::KEY_PODCAST       => 'podcast',
            PageSection::KEY_LAB           => 'lab',
            PageSection::KEY_SAFETY_RIDING => 'safety-riding',
        ];
        return $map[$key] ?? $key;
    }
}
