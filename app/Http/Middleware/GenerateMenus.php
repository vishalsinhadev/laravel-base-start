<?php 
/** 
 * @author	 : Vishal Kumar Sinha <vishalsinhadev@gmail.com> 
 */
namespace App\Http\Middleware;

use Lavary\Menu\Menu;
use Closure;

class GenerateMenus
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        (new Menu())->make('sideMenuBar', function ($menu) {
            $items = self::getMenu();
            foreach ($items as $key => $item) {
                if (! isset($item['visible']) || $item['visible']) {
                    $subClass = [];
                    if (isset($item['submenu'])) {
                        $subClass = ['class' => 'treeview'];
                    }
                    $result = array_merge([
                        'title' => $item['title']
                    ], $subClass);
                    $menu->add($item['text'], $result)
                        ->append('</span>')
                        ->prepend('<i class="fa ' . $item['icon'] . '"></i> <span>')->link->attr($item['link_attribute']);
                    if (isset($item['submenu'])) {
                        //($menu->{$item['text']} != null) ? $menu->add($item['text'],['class' => 'treeview']) : '';
                        foreach ($item['submenu'] as $submenu) {
                            if (isset($submenu['visible']) && $submenu['visible'] == false) {
                                continue;
                            }
                            $item['text'] = strtolower($item['text']);
                            
                            
                            $menu->{$item['text']}->add($submenu['text'], [
                                'title' => $item['title']
                            ])->append('</span>')
                                ->prepend('<i class="fa ' . $submenu['icon'] . '"></i> <span>')->link->attr($submenu['link_attribute']);
                        }
                    }
                }
            }
        });
        return $next($request);
    }

    static function menu($text, $url, $icon, $visible = true, $submenu = [], $title = null)
    {
        if ($title === null) {
            $title = $text;
        }
        $parent = [
            'icon' => $icon,
            'title' => $title,
            'text' => $text,
            'visible' => $visible,
            'link_attribute' => [
                'href' => $url
            ]
        ];

        if (! empty($submenu)) {
            $child = [];
            foreach ($submenu as $key => $m) {
                if (! isset($m['title'])) {
                    $m['title'] = $m['text'];
                }
                $child[$key] = [
                    'icon' => $m['icon'],
                    'title' => $m['title'],
                    'text' => $m['text'],
                    'link_attribute' => [
                        'href' => $m['link_attribute']['href']
                    ],
                    'visible' => isset($m['visible']) ? $m['visible'] : true
                ];
            }
            $final = [];
            $final['submenu'] = $child;
            $parent = array_merge($parent, $final);
        }
        return $parent;
    }

    static function getMenu()
    {
//         if (auth()->user() == null) {
//             return [];
//         }
        return [
            self::menu('Dashboard', '#', 'fa-dashboard', true, [
                [
                    'text' => 'My Dashboard',
                    'icon' => 'fa-dashboard',
                    'link_attribute' => [
                        'href' => route('dashboard.index')
                    ],
                    'visible' => true
                ]
            ]),
            /* self::menu('User', '#', 'fa-user', true, [
                [
                    'text' => 'Admin',
                    'icon' => 'fa-user',
                    'link_attribute' => [
                        'href' => route('user.admin')
                    ],
                    'visible' => true
                ]
            ]), */
            self::menu('User', route('user.index'), 'fa-book', true)
        ];
    }
}
