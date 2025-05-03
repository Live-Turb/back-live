<?php

namespace App\Http\Controllers;

use App\Models\BroadCastThumbnail;
use App\Models\VideoDetail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ViewStatistic;
use Torann\GeoIP\Facades\GeoIP;

class VideoController extends Controller
{
    public function edit($uuid)
    {
        $video = VideoDetail::with('videoThumbnail', 'videoComment')->where('uuid', $uuid)->first();
        $myvideos = VideoDetail::with('videoThumbnail')->where('user_id', auth()->id())->get();
        if ($video) {
            return view('videoDetailsEidt', compact('video','myvideos'));
        }
        return redirect()->back();
    }


    public function update(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:1000',
        'channel_name' => 'required|string|max:255',
        'channel_avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    $thumbnail = BroadCastThumbnail::find($id);
    if ($thumbnail) {
        $thumbnail->title = $request->title;
        $thumbnail->description = $request->description;
        $thumbnail->channel_name = $request->channel_name;

        if ($request->hasFile('image')) {
            if ($thumbnail->img_name && Storage::disk('public')->exists($thumbnail->img_name)) {
                Storage::disk('public')->delete($thumbnail->img_name);
            }
            $filename = now()->timestamp . '_random.jpg';
            $filePath = 'videothumbnails/' . $filename;
            $request->file('image')->storeAs('videothumbnails', $filename, 'public');
            $thumbnail->img_name = $filePath;
        }

        if ($request->hasFile('channel_avatar')) {
            if ($thumbnail->channel_avatar && Storage::disk('public')->exists($thumbnail->channel_avatar)) {
                Storage::disk('public')->delete($thumbnail->channel_avatar);
            }
            $avatarFilename = now()->timestamp . '_avatar.jpg';
            $avatarPath = 'channelavatars/' . $avatarFilename;
            $request->file('channel_avatar')->storeAs('channelavatars', $avatarFilename, 'public');
            $thumbnail->channel_avatar = $avatarPath;
        }

        $thumbnail->save();

        return response()->json([
            'success' => true,
            'image_url' => $thumbnail->img_name ? asset('storage/' . $thumbnail->img_name) : null,
            'channel_avatar_url' => $thumbnail->channel_avatar ? asset('storage/' . $thumbnail->channel_avatar) : null,
        ]);
    } else {
        return response()->json(['success' => false, 'message' => 'Thumbnail not found']);
    }
}

    public function show($uuid)
    {
        $video = VideoDetail::where('uuid', $uuid)->firstOrFail();
        
        // Registra a visualização
        $this->recordView($video, request());
        
        return view('video.show', compact('video'));
    }

    private function detectDeviceType($userAgent)
    {
        $userAgent = strtolower($userAgent);
        
        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', $userAgent)) {
            return 'tablet';
        }
        
        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', $userAgent)
            || preg_match('/mobile/i', $userAgent)) {
            return 'mobile';
        }
        
        return 'desktop';
    }

    private function recordView(VideoDetail $video, Request $request)
    {
        $userAgent = $request->header('User-Agent');
        $ip = $request->ip();
        $session = $request->session()->getId();
        
        // Verifica se já existe uma visualização única para esta sessão
        $existingView = ViewStatistic::where('template_id', $video->id)
            ->where('viewer_session', $session)
            ->where('created_at', '>=', now()->subHours(24))
            ->first();
            
        $viewData = [
            'template_id' => $video->id,
            'user_id' => $video->user_id,
            'viewer_ip' => $ip,
            'viewer_session' => $session,
            'device_type' => $this->detectDeviceType($userAgent),
            'browser' => $this->getBrowser($userAgent),
            'os' => $this->getOS($userAgent),
            'referrer_domain' => parse_url($request->header('referer'), PHP_URL_HOST) ?? null,
            'referrer_url' => $request->header('referer'),
            'utm_source' => $request->get('utm_source'),
            'utm_medium' => $request->get('utm_medium'),
            'utm_campaign' => $request->get('utm_campaign'),
            'is_unique' => !$existingView
        ];
        
        // Tenta obter a localização do IP
        try {
            $location = GeoIP::getLocation($ip);
            $viewData['country'] = $location->iso_code;
            $viewData['city'] = $location->city;
        } catch (\Exception $e) {
            // Se falhar, continua sem os dados de localização
        }
        
        ViewStatistic::create($viewData);
    }

    private function getBrowser($userAgent)
    {
        $browser_array = [
            '/msie/i'      => 'Internet Explorer',
            '/firefox/i'   => 'Firefox',
            '/safari/i'    => 'Safari',
            '/chrome/i'    => 'Chrome',
            '/edge/i'      => 'Edge',
            '/opera/i'     => 'Opera',
            '/mobile/i'    => 'Mobile Browser'
        ];

        foreach ($browser_array as $regex => $value) {
            if (preg_match($regex, $userAgent)) {
                return $value;
            }
        }

        return 'Unknown';
    }

    private function getOS($userAgent)
    {
        $os_array = [
            '/windows/i'          => 'Windows',
            '/macintosh|mac os x/i' => 'Mac OS X',
            '/mac_powerpc/i'      => 'Mac OS 9',
            '/linux/i'            => 'Linux',
            '/ubuntu/i'           => 'Ubuntu',
            '/iphone/i'           => 'iPhone',
            '/ipod/i'             => 'iPod',
            '/ipad/i'             => 'iPad',
            '/android/i'          => 'Android',
            '/webos/i'            => 'Mobile'
        ];

        foreach ($os_array as $regex => $value) {
            if (preg_match($regex, $userAgent)) {
                return $value;
            }
        }

        return 'Unknown';
    }
}
