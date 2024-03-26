<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Flux;
use SimplePie;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::where('parent_id', null)->with('children')->where('user_id', auth()->user()->id)->get();
        $items = [];
        foreach($categories as $category) {
            foreach($category->children as $child) {
                $flux_rss = Flux::where('category_id', $child->id)->get();
                foreach ($flux_rss as $flux) {
                    $feed = new SimplePie();
                    $feed->set_feed_url($flux->link); // Utilisez l'URL du flux RSS associé
                    $feed->enable_cache(false); // Désactiver le cache pour éviter les problèmes de mise en cache
                    $feed->init();

                    // $items = array_merge($items, $feed->get_items()); // Ajoutez les éléments de flux au tableau $items
                    foreach ($feed->get_items() as $item) {
                        $item->color = $flux->color; // Assuming $flux->color is a valid property
                        $items[] = $item;
                    }
                }
            }
        }
        return view('dashboard', compact('categories', 'items'));
    }
}
