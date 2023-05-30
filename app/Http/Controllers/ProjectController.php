<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
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
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->validated();  //validated : restituisce un array associativo
        $form_data['slug'] = Str::slug($form_data['title'], '-');

        $checkPost = Project::where('slug', $form_data['slug'])->first();
        if ($checkPost) {
            return back()->withInput()->withErrors(['slug' => 'Impossibile creare lo slug per questo post, cambia il titolo']);
        }

        if($request->hasFile('cover_img')){
            $path = Storage::put('cover', $request->cover_img);
            $form_data['cover_img'] = $path;
        }

        $newProject = Project::create($form_data);  //la create 1_stanzia il nuovo oggetto,2_fà sia la fill che 3_la save

        if($request->has('technologies')){
            $newProject->technologies()->attach($request->technologies);
        }
        //dd($request);
        return redirect()->route('admin.projects.show', ['project'=> $newProject->slug])->with('status', 'Progetto creato con successo!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {

        $form_data = $request->validated();
        $form_data['slug'] = Str::slug($request->title, '-');

        $checkPost = Project::where('slug', $form_data['slug'])->where('id', '<>', $project->id)->first();

        if ($checkPost) {
            return back()->withInput()->withErrors(['slug' => 'Impossibile creare lo slug']);
        }

        //SE nei dati in arrivo dal form c'è un dato per cover_img (allora entro nell'if)
        if($request->hasFile('cover_img')){

            //SE esiste già un valore nel Database per cover_img
            if($project->cover_img){
                //ALLORA cancello il valore di cover_img dal Database
                Storage::delete($project->cover_img);
            }

            //alla variabile $path dò come valore la path dell'immagine
            $path = Storage::put('cover', $request->cover_img);
            //al valore di cover_img dei dati del form dò il valore di $path
            $form_data['cover_img'] = $path;

        }

        $project->technologies()->sync($request->technologies);
        $project->update($form_data);

        return redirect()->route('admin.projects.show', ['project'=> $project->slug])->with('status', 'Progetto modificato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index');
    }
}
