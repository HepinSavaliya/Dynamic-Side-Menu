<?php

namespace Player\Sidemenu\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $casts = [];
    protected $table;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('sidemenu.table_name');

        // Retrieve required and extra columns from the configuration
        $require_columns = config('sidemenu.menu_columns', []);
        $extra_columns = config('sidemenu.extra_field', []);

        // Merge required and extra columns
        $columns = array_merge($require_columns, $extra_columns);

        // Set fillable attributes
        $this->fillable = array_keys($columns);

        // Set casts dynamically based on column types
        foreach ($columns as $column => $type) {
            $this->casts[$column] = $this->resolveCastType($type); 
        }
    }

    /**
     * Resolve the appropriate cast type for a given column type.
     *
     * @param string $type
     * @return string
     */
    protected function resolveCastType(string $type): string
    {
        switch ($type) {
            case 'json':
            case 'array':
                return 'array';
            case 'object':
                return 'object';
            case 'collection':
                return 'collection';
            case 'integer':
                return 'integer';
            case 'float':
                return 'float';
            case 'boolean':
                return 'boolean';
            case 'date':
                return 'date';
            case 'datetime':
                return 'datetime';
            case 'timestamp':
                return 'timestamp';
            case 'encrypted':
                return 'encrypted';
            case 'string':
            default:
                return 'string';
        }
    }

    public function getMenuTree()
    {
        $menus = static::all()->toArray();

        return $this->buildTree($menus);
    }

    private function buildTree($menus, $parentId = null)
    {
        $branch = [];

        foreach ($menus as $menu) {
            if ($menu['parent_menu_id'] == $parentId) {
                $children = $this->buildTree($menus, $menu['menu_id']);
                if ($children) {
                    $menu['children'] = $children;
                }
                $branch[] = $menu;
            }
        }

        return $branch;
    }
}
