<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
// use Doctrine\DBAL\Schema\View;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\Part;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

use function PHPUnit\Framework\isEmpty;

class PartsExport implements FromView,  ShouldAutoSize , WithDrawings
{
    private $firstRange;
    private $secondRange;
    private $category = NULL;
    private $categoryMaterial = NULL;
    private $location = NULL;

    public function __construct($firstRange, $secondRange, $category, $categoryMaterial , $location)
    {
        $this->firstRange = $firstRange;
        $this->secondRange = $secondRange;
        $this->category = $category;
        $this->categoryMaterial = $categoryMaterial;
        $this->location = $location;
    }

    public function view(): View
    {
        if (isset($this->categoryMaterial) && isset($this->location)) {
            $parts = Part::with('flowInPart', 'flowOutPart')
                    ->where('kategoriPart', '=', $this->category)
                    ->where('kategoriMaterial', '=', $this->categoryMaterial)
                    ->where('lokasiPart', '=', $this->location)
                    ->get();
            foreach ($parts as $i => $part) {
                $parts[$i]->stockAwal = $part->getStock($this->firstRange);
                $parts[$i]->stockAkhir = $part->getStock($this->secondRange);
            }
            return view('ReportPages.tablesAll', [
                'list' => $parts,
                'firstRange' => $this->firstRange,
                'secondRange' => $this->secondRange,
                'category' => $this->category,
                'material' => $this->categoryMaterial,
                'lokasiPart' => $this->location
            ]);

        }
        if(isset($this->categoryMaterial)){
            $parts = Part::with('flowInPart', 'flowOutPart')
            ->where('kategoriPart', '=', $this->category)
            ->where('kategoriMaterial', '=', $this->categoryMaterial)
            ->get();
            
            foreach ($parts as $i => $part) {
                $parts[$i]->stockAwal = $part->getStock($this->firstRange);
                $parts[$i]->stockAkhir = $part->getStock($this->secondRange);
            }
            return view('ReportPages.tablesMaterial', [
                'list' => $parts,
                'firstRange' => $this->firstRange,
                'secondRange' => $this->secondRange,
                'category' => $this->category,
                'material' => $this->categoryMaterial,
            ]);
        }
        if (isset($this->location)) {
            $parts = Part::with('flowInPart', 'flowOutPart')
                    ->where('kategoriPart', '=', $this->category)
                    ->where('lokasiPart', '=', $this->location)
                    ->get();

            foreach ($parts as $i => $part) {
                $parts[$i]->stockAwal = $part->getStock($this->firstRange);
                $parts[$i]->stockAkhir = $part->getStock($this->secondRange);
            }
            return view('ReportPages.tablesLocation', [
                'list' => $parts,
                'firstRange' => $this->firstRange,
                'secondRange' => $this->secondRange,
                'category' => $this->category,
                'lokasiPart' => $this->location
            ]);
        }
        else
        {
            $parts = Part::with('flowInPart', 'flowOutPart')
            ->where('kategoriPart', '=', $this->category)
            ->get();
            foreach ($parts as $i => $part) {
                $parts[$i]->stockAwal = $part->getStock($this->firstRange);
                $parts[$i]->stockAkhir = $part->getStock($this->secondRange);
            }
            return view('ReportPages.tables', [
                'list' => $parts,
                'firstRange'=>$this->firstRange,
                'secondRange'=>$this->secondRange,
                'category' => $this->category
            ]);
        }


    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('nr.png'));
        $drawing->setHeight(60);
        $drawing->setCoordinates('A1');
        return $drawing;
    }

}
