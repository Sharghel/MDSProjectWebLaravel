<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Flux;
use App\Http\Controllers\FluxController;
use SimplePie;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::where('parent_id', null)->with('children')->where('user_id', auth()->user()->id)->get();
        
        return view('categories.index', compact('categories'));
    }
    
    public function create()
    {
        $categories = Category::where('parent_id', null)->with('children')->where('user_id', auth()->user()->id)->get();
        
        $parent_categories = Category::where('parent_id', null)->get();
        return view('categories.create', compact('categories', 'parent_categories'));
    }
    
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->get('name');
        $category->parent_id = $request->get('parent_id');
        $category->user_id = auth()->user()->id;
        $category->save();
        return redirect()->route('category.index');
    }

    public function edit($id)
    {
        $categories = Category::where('parent_id', null)->with('children')->where('user_id', auth()->user()->id)->get(); // Récupere les categories pour le aside
        $fluxes = Flux::where('category_id', $id)->get(); // Récuperer tous les flux relier à la catégorie
        $activeTab = session('redirection') ? 'flux' : 'modification'; // Cherche d'où on vient pour savoir quel tab on affiche
        session()->forget('redirection');
        
        $category = Category::find($id); // Récupere les infos de la catégorie avec son id
        $parent_categories = Category::where('parent_id', null)->where('user_id', auth()->user()->id)->get(); // Récupere les catégories parents de l'utilisateur
        return view('categories.edit', compact('categories', 'category', 'parent_categories', 'activeTab', 'fluxes'));
    }
    
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->update($request->all());
        return redirect()->route('category.index');
    }
    
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('category.index');
    }
    
    public function show($id)
    {
        $categories = Category::where('parent_id', null)->with('children')->where('user_id', auth()->user()->id)->get();
        $category = Category::with("parent")->where("id", $id)->first();

        $flux_rss = Flux::where('category_id', $category->id)->get();
        $items = [];
        foreach ($flux_rss as $flux) {
            $feed = new SimplePie();
            $feed->set_feed_url($flux->link); // Utilisez l'URL du flux RSS associé
            $feed->enable_cache(false); // Désactiver le cache pour éviter les problèmes de mise en cache
            $feed->init();
            $items = array_merge($items, $feed->get_items()); // Ajoutez les éléments de flux au tableau $items
        }

        return view('categories.show', compact('categories', 'category', 'items'));
        return redirect()->back();
    }
}
