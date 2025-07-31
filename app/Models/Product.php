<?php

namespace App\Models;

use App\Helper\FileHelper;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    const STATE_PENDING = 0;

    const STATE_DONE = 1;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product';

    protected $primaryKey = 'id';

    protected $fillable = [
        'ProductId',
        'Name',
        'producervenueid',
        'maincatid',
        'catid',
        'Region',
        'ABV',
        'Description',
        'ibu',
        'state_id',
        'ProductLogo',
        'AddedOn',
        'url',
        'SKU',
        'slug',
        'is_image_optimized'
    ];

    public function getAvailabilityAttribute()
    {
        return 'in stock'; // calculate
    }

    public function getGmPriceAttribute()
    {
        return [
            'value' => '4.50',
            'currency' => 'USD'
        ];
    }

    static public function createLookupProduct($datas, $rating = null)
    {
        $product = new self();
        foreach ($datas as $key => $a) {
            $product->{$key} = $a;
        }
        $product->save();
        if ($rating !== null) {
            $product->createRatings($rating);
        }
        $product->createUpdateSlug();
    }

    public function availableProductFormat($venueId)
    {
        if ($venueId == null) {
            $venueId = [];
        }
        $pfIds = VenueProduct::select([
            'productformatid'
        ])->where([
            'ProductId' => $this->ProductId,
            'noWebSales' => 0
        ])
            ->whereIn('VenueId', $venueId)
            ->distinct('productformatid')
            ->pluck('productformatid');
        return ($pfIds != null) ? ProductFormat::whereIn('pfID', $pfIds->toArray())->get() : [];
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class, 'producervenueid', 'VenueId');
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, 'MainCatId', 'catid');
    }

    public function getFormatAndPrice()
    {
        $data = [];
        $venueProduct = VenueProduct::where([
            'ProductId' => $this->ProductId
        ])->first();
        if (null != $venueProduct) {
            $data['format'] = $venueProduct->getFormat->format;
            $data['price'] = $venueProduct->Price;
        } else {
            $data['format'] = $this->productformat()->first()->format;
        }
        return $data;
    }

    /**
     *
     * @param array $array
     * @return \App\Models\Product
     */
    static public function createProduct($array = [])
    {
        $product = new self();
        foreach ($array as $key => $a) {
            $product->$key = $a;
        }
        $product->save();
        $product = self::where('ProductId', $array['ProductId'])->first();

        return $product;
    }

    /**
     *
     * @param string $format
     * @return \App\Models\ProductFormat
     */
    public function createProductFormat($format)
    {
        $model = ProductFormat::where('format', $format)->where('productid', $this->ProductId)->first();
        if ($model == null) {
            $model = new ProductFormat();
            $model->productid = $this->ProductId;
            $model->format = $format;
            $model->save();
        }
        return $model;
    }

    function parseRatingValue($rating)
    {
        if (strpos($rating, '/') !== false) {
            $rating = $this->replaceText($rating, '/\s\/\s[0-9]\.[0-9]/');
        }
        return $rating;
    }


    public function updateRelated()
    {
        $this->createProductFormat($this->VenueImportModel->Format);
        $this->createVenueProduct($this->VenueImportModel, $this->DataLookupReport);
        $this->createCheckIn();
    }

    public function uploadFileToS3($fileName, $file)
    {
        return FileHelper::uploadFileToS3($fileName, $file);
    }

    public function getNewModifyFormat()
    {
        $newformat = preg_replace('/[\/\\. ,:-]/', '-', $this->format);
        return $newformat;
    }

    public function createUpdateSlug()
    {
        $string = $this->Name . ' ' . $this->venue->Name;
        $slug = Str::slug("{$string}", "-");
        $this->update([
            'slug' => $slug
        ]);
    }
}
