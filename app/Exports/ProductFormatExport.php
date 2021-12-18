<?php

namespace App\Exports;




use App\Models\Product;
use App\Models\Product\Category;
use App\Models\Product\Color;
use App\Models\Product\Size;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

use DB;
class ProductFormatExport implements WithHeadings, WithEvents , WithTitle
{
	use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
    	return [
            'Sr No',
            'Product Name(*)',
            'Category(*)',
			'Sub Category(*)',
            'Size(*)',
            'Color(*)' ,
            'Sku Code(*)' ,
            'HSN(*)',
			'GST(*)',
            'Quantity(*)',
            'INR Price(*)',
            'INR Sales Price(*)',
            'USD Price(*)',
            'USD Sales Price(*)',
            'Tax Rate',
            'Description(*)',
            'Product Description',
            'Shipping',
            'Details',
            'Is Exclusive',
            'iS Home',
            'Frontend Image Link(*)'
        ];
    }

	 public function title(): string
    {
        return 'bulkupload';
    }
		
	public function registerEvents(): array
    {

        //$event = $this->getEvent();
        return [
            AfterSheet::class => function (AfterSheet $event) {
               
                /** @var Sheet $sheet */
                $sheet = $event->sheet;

                /**
                 * validation for bulkuploadsheet
                 */
                for($i=2;$i<=100;$i++)
				{
					$category=Category::where('parent_id',0)->get();
					foreach($category as $ct)
					{
						
						$cat[]=$ct->name;
					}
                	$sheet->setCellValue('C'.$i, 'CATEGORY');
					$ct=implode(", ", $cat);
                	$configs = $ct;
	                $objValidation = $sheet->getCell('C'.$i)->getDataValidation();
	                $objValidation->setType(DataValidation::TYPE_LIST);
	                $objValidation->setErrorStyle(DataValidation::STYLE_INFORMATION);
	                $objValidation->setAllowBlank(false);
	                $objValidation->setShowInputMessage(true);
	                $objValidation->setShowErrorMessage(true);
	                $objValidation->setShowDropDown(true);
	                $objValidation->setErrorTitle('Input error');
	                $objValidation->setError('Value is not in list.');
	                $objValidation->setPromptTitle('Pick from list');
	                $objValidation->setPrompt('Please pick a value from the drop-down list.');
	                $objValidation->setFormula1('"'.$ct.'"');
				

					$categorySub=Category::with('scat')->where('parent_id',0)->get();
					
					foreach($categorySub as $st)
					{
						if($st->scat){
							foreach($st->scat as $stss)
							{
								$subCat[]=$stss->name;
							}
						}
						
						
					}
					$sheet->setCellValue('D'.$i, 'Sub Category');
					$st=implode(", ", $subCat);
                	$configs = $subCat;
	                $objValidation = $sheet->getCell('D'.$i)->getDataValidation();
	                $objValidation->setType(DataValidation::TYPE_LIST);
	                $objValidation->setErrorStyle(DataValidation::STYLE_INFORMATION);
	                $objValidation->setAllowBlank(false);
	                $objValidation->setShowInputMessage(true);
	                $objValidation->setShowErrorMessage(true);
	                $objValidation->setShowDropDown(true);
	                $objValidation->setErrorTitle('Input error');
	                $objValidation->setError('Value is not in list.');
	                $objValidation->setPromptTitle('Pick from list');
	                $objValidation->setPrompt('Please pick a value from the drop-down list.');
	                $objValidation->setFormula1('"'.$st.'"');
				
					$brand=Size::get();
					foreach($brand as $bn)
					{
						
						$br[]=$bn->name;
					}
	                $sheet->setCellValue('E'.$i, 'SIZE');
					$brnd=implode(", ", $br);
	                $configs = $ct;
	                $objValidation = $sheet->getCell('E'.$i)->getDataValidation();
	                $objValidation->setType(DataValidation::TYPE_LIST);
	                $objValidation->setErrorStyle(DataValidation::STYLE_INFORMATION);
	                $objValidation->setAllowBlank(false);
	                $objValidation->setShowInputMessage(true);
	                $objValidation->setShowErrorMessage(true);
	                $objValidation->setShowDropDown(true);
	                $objValidation->setErrorTitle('Input error');
	                $objValidation->setError('Value is not in list.');
	                $objValidation->setPromptTitle('Pick from list');
	                $objValidation->setPrompt('Please pick a value from the drop-down list.');
	                $objValidation->setFormula1('"'.$brnd.'"');

				
					$colors=Color::get();
					foreach($colors as $col)
					{
						
						$color[]=$col->name;
					}
					
	                $sheet->setCellValue('F'.$i, 'COLOR');
					$col=implode(", ", $color);
	                $configs = $ct;
	                $objValidation = $sheet->getCell('F'.$i)->getDataValidation();
	                $objValidation->setType(DataValidation::TYPE_LIST);
	                $objValidation->setErrorStyle(DataValidation::STYLE_INFORMATION);
	                $objValidation->setAllowBlank(false);
	                $objValidation->setShowInputMessage(true);
	                $objValidation->setShowErrorMessage(true);
	                $objValidation->setShowDropDown(true);
	                $objValidation->setErrorTitle('Input error');
	                $objValidation->setError('Value is not in list.');
	                $objValidation->setPromptTitle('Pick from list');
	                $objValidation->setPrompt('Please pick a value from the drop-down list.');
	                $objValidation->setFormula1('"'.$col.'"');
				
				 $cat=array();
				$subCat=array();
				$br=array();
				$color=array();
			
				}
              
            }
        ];
    }
}
