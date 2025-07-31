<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helper\FileHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Helper\CategoryTree;

class Category extends Model
{

    public static $wantChild = false;

    public static $wantCustomChild = false;

    public static $childIds = [];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    protected $primaryKey = 'MainCatId';

    protected $fillable = [
        'MainCatName',
        'parent_id',
        'image_file',
        'slug',
        'order_by_id',
        'is_image_optimized',
        'image_ico',
        'bg_image'
    ];

    public function childs()
    {
        return $this->hasMany(Category::class, 'parent_id', 'MainCatId')->orderBy('order_by_id', 'asc');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'MainCatId')->orderBy('order_by_id', 'asc');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }

    public static $childIdList = [];

    static public function getChildList($parentId)
    {
        $models = self::where('parent_id', $parentId)->get();
        if ($models != null) {
            foreach ($models as $model) {
                array_push(self::$childIdList, $model->MainCatId);
                self::getChildList($model->MainCatId);
            }
        }
        return self::$childIdList;
    }

    static public function getChildByIds($id)
    {
        if (! is_array($id)) {
            $id = [
                $id
            ];
        }
        $models = self::whereIn('MainCatId', $id)->get();
        if ($models !== null) {
            $ids = array();
            foreach ($models as $model) {
                $ids[] = $model->MainCatId;
                $temp = self::getChildList($model->MainCatId, $ids);
                $ids = array_merge($ids, $temp);
            }
            return $ids;
        }
    }

    static public function getCategoryMenus($parentId = 0)
    {
        if ($parentId == 0) {
            $categories = self::where([
                'parent_id' => $parentId
            ])->orderBy('MainCatId', 'asc')->get();
        } else {
            $categories = self::where([
                'parent_id' => $parentId
            ])->orderBy('MainCatName', 'asc')->get();
        }

        $menus = [];
        foreach ($categories as $category) {
            $menus[$category->MainCatName . '*.*' . $category->MainCatId] = $category->getSubCategory();
        }
        return $menus;
    }

    function getSubCategory()
    {
        $categories = self::where([
            'parent_id' => $this->MainCatId
        ])->orderBy('MainCatName', 'asc')->get();
        $menus = [];
        foreach ($categories as $category) {
            $subCat = $category->getSubCategory();
            $menus[$category->MainCatName . '*.*' . $category->MainCatId] = $subCat;
        }
        return $menus;
    }

    static public function getParseData($data, $type = 1)
    {
        $data = explode('*.*', $data);
        if ($type == 2) {
            return $data[1];
        }
        return $data[0];
    }

    static public function getMainCategory()
    {
        return self::where([
            'parent_id' => 0
        ])->orderBy('MainCatId', 'asc')->get();
    }

    public function getCategoryImageUrl()
    {
        if ($this->image_file == null) {
            return asset('/assets/images') . '/beer.jpg';
        }
        return FileHelper::url("Category/{$this->image_file}");
    }

    public function getFirstLevelCategory($id)
    {
        $model = self::where([
            'MainCatId' => $id
        ])->first();
        if ($model != null) {
            if ($model->parent_id != 0) {
                $this->getFirstLevelCategory($model->parent_id);
            }
            return $model;
        }
        return null;
    }
}
