<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public $validation = ([
        'title'             => 'required',
        'technology_id'     => 'exists:technologies,id',
        'type_id'           => 'required|exists:types,id',
        'url_image'         => 'nullable',
        'image'             => 'nullable',
        'content'           => 'required',
    ]);

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $projects = Project::paginate(5);

       return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types','technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // salvare l'immagine nella cartella degli uploads
        // prendere il percorso dell'immagine appena salvata
        $imagePath = Storage::put('uploads', $data['image']);
        // dd($imagePath);


        $request->validate($this->validation);


        $newproject                 = new Project();
        $newproject->title          = $data['title'];
        $newproject->slug           = Str::slug($data['title']);
        $newproject->type_id        = $data['type_id'];
        $newproject->technology_id  = $data['technology_id'];
        $newproject->url_image      = $data['url_image'];
        $newproject->image          = $imagePath;
        $newproject->content        = $data['content'];
        $newproject->save();

        //prima salvo post, poi associo i dati
        $newproject->technologies()->sync($data['technologies'] ?? []);

        return to_route('admin.projects.show', ['project' => $newproject]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types','technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        $request->validate($this->validation);

        $data = $request->all();

        if ($data['image']) {
            // salvare l'immagine nuova
            $imagePath = Storage::put('uploads', $data['image']);

            // eliminare l'immagine vecchia
            if ($project->image) {
                Storage::delete($project->image);
            }
            // aggiormare il valore nella colonna con l'indirizzo dell'immagine nuova
            $project->image = $imagePath;
        }
        
        $project->title         = $data['title'];
        $project->url_image     = $data['url_image'];
        $project->content       = $data['content'];
        $project->type_id       = $data['type_id'];
        $project->update();

        $project->technologies()->sync($data['technologies'] ?? []);

        return to_route('admin.projects.show', ['project' => $project]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();

        if ($project->image) {
            Storage::delete($project->image);
        }

        $project->technologies()->detach();

        $project->delete();

        return redirect()->route('admin.projects.index')->with('delete_success', $project);
    }
}
