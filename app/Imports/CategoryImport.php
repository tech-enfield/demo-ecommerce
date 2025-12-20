<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\CategoryRelation;
use App\Models\Color;
use PhpParser\Node\Expr\FuncCall;
use Spatie\SimpleExcel\SimpleExcelReader;

class CategoryImport
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected AttributeImport $attributeImport, protected BannerImport $bannerImport, protected ProductImport $productImport)
    {
        $this->attributeImport = $attributeImport;
        $this->bannerImport = $bannerImport;
        $this->productImport = $productImport;
    }

    public function import($path)
    {
        $this->category($path);
        $this->categoryRelation($path);
        $this->attributeImport->attributeGroup($path);
        $this->attributeImport->attribute($path);
        $this->attributeImport->attributeValue($path);

        $this->productImport->products($path);
        $this->productImport->variants($path);

        $this->bannerImport->import($path);
        $this->bannerImport->ratings($path);

        $this->colors($path);
        $this->productCategoryRelation($path);
    }

    public function category($path)
    {
        $rows = SimpleExcelReader::create($path)->fromSheetName('Category')->getRows();

        $rows->each(function ($row) {
            Category::updateOrCreate($row);
        });
    }

    public function categoryRelation($path)
    {
        $rows = SimpleExcelReader::create($path)->fromSheetName('Category Relation')->getRows();

        $rows->each(function ($row) {
            CategoryRelation::updateOrCreate($row);
        });
    }

    public function colors($path)
    {
        $rows = SimpleExcelReader::create($path)->fromSheetName('Colors')->getRows();

        $rows->each(function ($row) {
            Color::updateOrCreate($row);
        });
    }

    public function productCategoryRelation($path){
        $rows = SimpleExcelReader::create($path)->fromSheetName('Category Product Relation')->getRows();

        $rows->each(function ($row) {
            CategoryProduct::updateOrCreate($row);
        });
    }
}
