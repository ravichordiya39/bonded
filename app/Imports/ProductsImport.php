<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Product\ProductDetail;
use Maatwebsite\Excel\Concerns\ToModel;
use DB;
use Illuminate\Support\Facades\Auth;
use Str;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductsImport implements ToCollection, WithStartRow
{

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
    public function headingRow(): int
    {
        return 1;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            if($row[1]!='' && $row[2]!='')
            {
                $product = Product::create([
                    'user_id'=>Auth::id(),
                    'cat_id' => $row[2] ? $this->getval('categories','slug',$row[2],'id'): '',
                    'scat_id' => $row[3] ? $this->getval('categories','slug',$row[3],'id'): '',
                    'name' =>$row[1],
                    'slug' =>Str::slug($row[1]),
                    //'size' => $row[4]?$row[4]:'OS',
                    //'color'  => $row[6] ? $row[6] : '',
                    'sku' =>$row[6] ? $row[6] : '',
                    'hsn_code' =>$row[7] ? $row[7] : '',
                    'gst' => $row[8]?$row[8]:'',
                    //'quantity' =>$row[9] ? $row[9] : '',
                    'price' =>$row[10]?$row[10]:0,
                    'description' =>$row[15]?$row[15]:'',
                    'p_description' =>$row[16]?$row[16]:'',
                    'shipping' =>$row[17]?$row[17]:'',
                    'details' =>$row[18]?$row[18]:'',
                    'image' =>$row[21]?$row[21]:'',
                    'is_exclusive' =>$row[19]?'1':'0',
                    'is_home' =>$row[20]?'1':'0',
                ]);
                ProductDetail::create([
                    'product_id' => $product->id,
                    'color' => $row[5] ? $this->getval('config_color','slug',$row[5],'id'): '',
                    'size' => $row[4] ? $this->getval('config_size','slug',$row[4],'id'): 'OS',
                    'quantity' => $row[9] ? $row[9] : '',
                    'inr_price' => $row[10]?$row[10]:0,
                    'inr_sell_price' => $row[11]?$row[11]:0,
                    'usd_price' => $row[12]?$row[12]:0,
                    'usd_sell_price' => $row[13]?$row[13]:0,
                ]);
            }
           return;
        }
    }
    public function getval($table,$id,$val,$what)
    {
        #$slug = strtolower(implode("-",explode(" ",$val)));
        $slug = Str::slug($val);
        $query = DB::table($table)->where($id,$slug)->first();
        return $query?$query->id:'';
    }
}
