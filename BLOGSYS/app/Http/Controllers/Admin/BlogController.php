<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\FunctionController;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;

use App\Models\BlogPost;

class BlogController extends FunctionController
{
    public function index(): View
    {
        $data = BlogPost::get();
        return view('admin.blog.index',['data'=>$data]);
    }
    public function create(): View
    {
        return view('admin.blog.create');
    }
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('BlogStoreRequest', [
            'user_id'=>['required'],
            'tag'=>['required'],
            'thumnail'=>['required','image','mimes:jpg,png,jpeg,gif'],
            'keyword'=>['required'],
            'uniq'=>['required'],
            'title'=>['required'],
            'description'=>['required'],
            'content'=>['required'],
            'publish_date'=>['required']
        ]);
        $request->uniq = $this->remove_special($request->uniq);

if ($this->uniq_blog_check($request->uniq) === true) {

    $file = $request->file('thumnail');
    $fileName = time() . '_' . $file->getClientOriginalName();
    $destinationPath = public_path('/assets/blog');
    $file->move($destinationPath, $fileName);
    $dbPath = 'assets/blog/' . $fileName;

    $blog = BlogPost::create([
        'user_id' => $request->user_id,
        'thumnail' => $dbPath, // 2. Save the returned path to the database
        'keyword' => strtolower($request->keyword),
        'uniq' => $request->uniq,
        'title' => $request->title,
        'description' => $request->description,
        'content' => json_encode($request->content),
        'publish_date' => $request->publish_date,
        'tag' => json_encode(explode(" ", $request->tag)),
    ]);

    return redirect(route('admin.blog.index'))->with('status', 'blog-created');
}

return back()->with('error', 'Create another Title!');
    }
    public function edit($id): View
    {
        $blog = BlogPost::findOrFail($id);
        $tags = "";
        foreach(json_decode($blog->tag) as $tag){ $tags .= $tag.' '; }
        return view('admin.blog.edit',['blog'=>$blog,'tags'=>$tags]);
    }
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('BlogUpdateRequest', [
            'id'=>['required'],
            'user_id'=>['required'],
            'tag'=>['required'],
            'old_thumnail'=>['required'],
            'thumnail'=>['sometimes','image','mimes:jpg,png,jpeg,gif'],
            'keyword'=>['required'],
            'uniq'=>['required'],
            'title'=>['required'],
            'description'=>['required'],
            'content'=>['required'],
            'publish_date'=>['required']
        ]);
        $thumbnailPath = $request->old_thumnail;

// 2. Check if a new thumbnail has been uploaded
if ($request->hasFile('thumnail')) {

    // 3. Delete the old image file to save space
    if (File::exists(public_path($request->old_thumnail))) {
        File::delete(public_path($request->old_thumnail));
    }

    // 4. Save the new image (same logic as the create method)
    $file = $request->file('thumnail');
    $fileName = time() . '_' . $file->getClientOriginalName();
    $destinationPath = public_path('/assets/blog');
    $file->move($destinationPath, $fileName);

    // 5. Update the path variable with the new image's path
    $thumbnailPath = 'assets/blog/' . $fileName;
}
        $blog = BlogPost::whereId($request->id)->update([
            'user_id'=>$request->user_id,
            'thumnail'=>$thumbnailPath,
            'keyword'=>strtolower($request->keyword),
            'uniq'=>$request->uniq,
            'title'=>$request->title,
            'description'=>$request->description,
            'content'=>json_encode($request->content),
            'publish_date'=>$request->publish_date,
            'tag'=> json_encode(explode(" ",strtolower($request->tag))),
        ]);
        return redirect(route('admin.blog.index'))->with('status','blog-updated');
    }
    public function destroy(Request $request): RedirectResponse
{
    $blog = BlogPost::findOrFail($request->blog_id);
    $imagePath = public_path($blog->thumnail);

    if (File::exists($imagePath)) {
        File::delete($imagePath);
    }

    if ($blog->delete()) {
        return redirect(route('admin.blog.index'))->with('status', 'blog-deleted');
    }

    return redirect(route('admin.blog.index'))->with('status', 'blog-unsuccess-delete');
}


}
