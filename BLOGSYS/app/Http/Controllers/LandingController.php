<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\BlogViewLog;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class LandingController extends Controller
{

    public function index()
    {
        $featuredMain = BlogPost::release()->latest()->limit(1)->get();
        $featuredSide = BlogPost::release()->latest()->skip(1)->limit(5)->get();
        $slider = BlogPost::release()->latest()->limit(5)->get();
        $allPost = BlogPost::release()->latest()->limit(10)->get();

        $trendingPostIds = BlogViewLog::query()
            ->select('blog_post_id', DB::raw('COUNT(blog_post_id) as view_count'))
            ->where('created_at', '>=', Carbon::now()->subDays(15))
            ->groupBy('blog_post_id')
            ->orderByDesc('view_count')
            ->limit(5)
            ->pluck('blog_post_id');

        if ($trendingPostIds->isNotEmpty()) {
            $trending = BlogPost::query()
                ->whereIn('id', $trendingPostIds)
                ->orderByRaw('FIELD(id, ' . $trendingPostIds->implode(',') . ')')
                ->get();
        } else {
            $trending = new Collection();
        }
        $tag = $this->get_all_tag();

        return view('welcome', [
            'featuredMain' => $featuredMain,
            'featuredSide' => $featuredSide,
            'slider' => $slider,
            'allPost' => $allPost,
            'trending' => $trending,
            'tags' => $tag
        ]);
    }
    public function detail($uniq)
    {
        $blog = BlogPost::release()->where('uniq', $uniq)->first();

        if (!isset($blog->title)) {
            return abort(404);
        }

        $newest = BlogPost::release()->paginate(20);

        // Get tags from current blog (assuming comma-separated)
        $tags = explode(',', $blog->tag);
        $tags = array_map('trim', $tags); // Remove whitespace
        $tags = array_filter($tags); // Remove empty elements

        // Start building the related posts query
        $relatedQuery = BlogPost::release()
            ->where('id', '!=', $blog->id); // Exclude current post

        // If tags exist, find posts that share any tag
        if (!empty($tags)) {
            $relatedQuery->where(function ($query) use ($tags) {
                foreach ($tags as $tag) {
                    $query->orWhere('tag', 'LIKE', "%{$tag}%");
                }
            });
        }

        // Get related posts (limit 8)
        $related = $relatedQuery->latest()->limit(8)->get();

        // If not enough related posts, fill with latest posts
        if ($related->count() < 8) {
            $additionalPosts = BlogPost::release()
                ->where('id', '!=', $blog->id)
                ->whereNotIn('id', $related->pluck('id'))
                ->latest()
                ->limit(8 - $related->count())
                ->get();

            $related = $related->merge($additionalPosts);
        }

        $this->blog_log($blog->id, request()->ip());
        return view('blog-detail', [
            'blog' => $blog,
            'newest' => $newest,
            'related' => $related
        ]);
    }
    public function tag()
    {
        $tag = $this->get_all_tag();
        return view('blog-tag', ['tags' => $tag]);
    }
    public function blogs()
    {
        $blogs = BlogPost::release()->latest()->paginate(20);
        return view('blogs', ['blogs' => $blogs]);
    }
    public function contact()
    {
        return view('contact');
    }
    public function tag_detail($tag)
    {
        $blog = $this->get_blog_with_tag($tag);
        return view('blog-tag-detail', ['blogs' => $blog, 'tag' => $tag]);
    }

    public function get_all_tag()
    {
        $tag = BlogPost::select('tag')->get();
        $new_tag = [];
        foreach ($tag as $tg) {
            foreach (json_decode($tg->tag) as $t) {
                array_push($new_tag, $t);
            }
        }
        return array_count_values($new_tag);
    }

    public function get_blog_with_tag($tag)
    {
        return BlogPost::release()->where('tag', 'LIKE', '%' . $tag . '%')->paginate(15);
    }
    public function sitemap()
    {
        $route = [
            ['index', '1.00'],
        ];
        $blog_list = BlogPost::release()->get();
        $tag = $this->get_all_tag();
        // dd($route);
        return response()->view('sitemap', ['route' => $route, 'blog_list' => $blog_list, 'tag_list' => $tag])->header('Content-Type', 'text/xml');
    }

    public function blog_log($blog_id, $ip_address)
    {
        $log = new BlogViewLog;
        $log->blog_post_id = $blog_id;
        $log->ip_address = $ip_address;
        $log->save();
    }
}
