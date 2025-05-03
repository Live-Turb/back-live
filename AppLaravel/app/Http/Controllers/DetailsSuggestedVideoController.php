<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\VideoDetail;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Models\BroadCastThumbnail;
use function Laravel\Prompts\alert;
use Illuminate\Support\Facades\Storage;

class DetailsSuggestedVideoController extends Controller
{
 public function storefile(Request $request)
{
    // $request->validate([
    //     'title' => 'required|string|max:100',
    //     'description' => 'required|string',
    //     'inputimg' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     'channel_name' => 'required|string|max:255',
    //     'channel_avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    // ]);

    // Handle the thumbnail image
    $thumbnailFile = $request->file('inputimg');
    $thumbnailFilename = now()->timestamp . '_thumbnail.jpg';
    $thumbnailFile->storeAs('videothumbnails', $thumbnailFilename, 'public');

    // Handle the channel avatar
    $avatarFile = $request->file('channel_avatar');
    $avatarFilename = now()->timestamp . '_avatar.jpg';
    $avatarFile->storeAs('channelavatars', $avatarFilename, 'public');

    $thump = BroadCastThumbnail::create([
        'user_id' => auth()->id(),
        'title' => $request->title,
        'description' => $request->description,
        'img_name' => 'videothumbnails/' . $thumbnailFilename,
        'channel_name' => $request->channel_name,
        'channel_avatar' => 'channelavatars/' . $avatarFilename,
    ]);

    return response()->json(['data' => $thump]);
}



    // details suggested video store into database
    public function storeVideo(Request $request)
    {
      
        // $subscription = Subscription::with('paypalPlan')->where('user_id', auth()->id())->first();
        $plan = auth()->user()->subscriptions->paypalPlan;
        $videos = VideoDetail::where('user_id', auth()->id())->get();
        // dd($plan->limit < count($videos));
        if ($plan->limit <= count($videos)) {

            $mypendingstatus = BroadCastThumbnail::where('user_id', auth()->id())->where('status', 'pending')->get();

            foreach ($mypendingstatus as $thumbImg) {


                if (Storage::disk('public')->exists($thumbImg->img_name)) {
                    Storage::disk('public')->delete($thumbImg->img_name);
                    $thumbImg->delete();
                }
            }
           return redirect()->route('myBroadcasts')->with(['error' => __('dashboard.screen_limit_reached')]);

        }
        // store video details into database
        // $inputData=$request->all();
        // dd($request->all());
        $request->validate([
            'details_video_title' => 'required',
            'details_video_description' => 'required',
            'details_video_shortcode' => 'required',
            'details_video_minimum' => 'required',
            'details_video_maximum' => 'required',
            'selected_template' => 'required|in:youtube,instagram',
        ]);

        $videocreate = VideoDetail::create([
            'uuid' => \Str::uuid(),
            'user_id' => auth()->id(),
            'details_video_title' => $request->details_video_title,
            'details_video_description' => $request->details_video_description,
            'details_video_shortcode' => $request->details_video_shortcode,
            'details_video_minnum' => $request->details_video_minimum,
            'details_video_maxnum' => $request->details_video_maximum,
            'template_type' => $request->selected_template,
        ]);


        $mythumps = BroadCastThumbnail::where('user_id', auth()->id())->whereIn('id', $request->imgdata)->get();
        foreach ($mythumps as $key => $mythump) {
            $data = BroadCastThumbnail::find($mythump->id);
            $data->status = 'complete';
            $data->video_detail_id = $videocreate->id;
            $data->save();
        }

        // $mypendingstatus = BroadCastThumbnail::where('user_id', auth()->id())->where('status', 'pending')->delete();
        $mypendingstatus = BroadCastThumbnail::where('user_id', auth()->id())->where('status', 'pending')->get();

        foreach ($mypendingstatus as $thumbImg) {


            if (Storage::disk('public')->exists($thumbImg->img_name)) {
                Storage::disk('public')->delete($thumbImg->img_name);
                $thumbImg->delete();
            }
        }
        // $title=$request->details_video_title;
        // return view('my-broadcasts',compact('title'));
        return redirect()->route('myBroadcasts')->with('success', __('dashboard.videos_added_successfully'));

    }


    // Show thumbnail video detail
    public function showThumbnailVideo()
    {
        $auth = auth()->user();
        $showThumbnails = BroadCastThumbnail::where("user_id", $auth->id)->get();
        // dd($showThumbnail->user_id);

        return view('my-broadcasts', compact('showThumbnails'));
    }

    // Delete thubnail video
    public function deleteThumbnail($id)
    {
        $delete = BroadCastThumbnail::find($id);
        // Storage::disk('public')->delete('videothumbnails/' . $$delete);

        $delete->delete();
        return back();
    }



    public function update(Request $request , $uuid)
    {
        
     
        $request->validate([
            'details_video_title' => 'required',
            'details_video_description' => 'required',
            'details_video_shortcode' => 'required',
            'details_video_minimum' => 'required',
            'details_video_maximum' => 'required',
        ]);

        $videocreate = VideoDetail::where('uuid', $uuid)->update([
            'details_video_title' => $request->details_video_title,
            'details_video_description' => $request->details_video_description,
            'details_video_shortcode' => $request->details_video_shortcode,
            'details_video_minnum' => $request->details_video_minimum,
            'details_video_maxnum' => $request->details_video_maximum,
        ]);


      
       return redirect()->back()->with('success', __('dashboard.videos_updated_successfully'));


    }


}
