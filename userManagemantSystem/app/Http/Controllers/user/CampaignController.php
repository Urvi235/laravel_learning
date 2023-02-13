<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\campaign;
use Illuminate\Http\Request;
use Auth;

class CampaignController extends Controller
{

    public function index()
    {
        $campaign = campaign::latest()->paginate(3);
        // dd($campaign);
        return view('user.home', compact('campaign'))->with('i', (request()->input('page', 1)));
    }


    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = '';
        if ($request->img) {
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('uploads'), $imageName);
        }


        $data = new campaign;
        $data->title = $request->title;
        $data->Description = $request->description;
        $data->img = $imageName;
        $data->user_id = Auth::user()->id;
        do {
            $data->unique_id = random_int(100000, 999999);
        } while (campaign::where("unique_id", "=", $data->unique_id)->first());
        $data->save();

        return redirect()->route('campaign.index')->with('success', 'Campaign has been added successfully.');

    }


    public function show($unique_id)
    {
        $campaign = campaign::where('unique_id',$unique_id)->first();

        return view('user.show', compact('campaign'));


    }

    public function edit(campaign $campaign)
    {

        return view('user.edit', compact('campaign'));
    }

    public function update(Request $request, campaign $campaign)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $imageName = '';
        if ($request->img) {    
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('uploads'), $imageName);
            $campaign->img = $imageName;
        }

        $campaign->title = $request->title;
        $campaign->Description = $request->description;
        $campaign->update();
        return redirect()->route('campaign.index')->with('success', 'Campaign has been updated successfully.');
    }

    public function destroy($id)
    {
        $campaign = campaign::findOrFail($id);
        $campaign->delete();
        return redirect()->route('campaign.index')->with('success', 'Campaign has been deleted successfully.');
    }
}
