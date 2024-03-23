<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Flux;

class FluxController extends Controller
{
    public function store(Request $request)
    {
        Flux::create($request->all());
        if($request->redirection == "show") {
            return redirect()->route('category.show', $request->get('category_id'));
        } else {
            return redirect()->route('category.edit', $request->get('category_id'))->with('redirection', true);
        }
    }

    public function update(Request $request, $id)
    {
        $flux = Flux::find($id);
        $flux->update($request->all());
        return redirect()->route('category.edit', $request->get('category_id'))->with('redirection', true);
    }
    
    public function destroy(Request $request, $id)
    {   
        $flux = Flux::find($id);
        $flux->delete();
        return redirect()->route('category.edit', $request->get('category_id'))->with('redirection', true);
    }
}
