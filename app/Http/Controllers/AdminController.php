<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Audit;

class AdminController extends Controller
{
    public function admindash()
    {
        
    $totalUsers = User::count();
    $creators = User::where('usertype', 'creator')->count();
    $viewers = User::where('usertype', 'viewer')->count();

    return view('adminview.dashboard', compact('totalUsers', 'creators', 'viewers'));
      
    }

    public function encode()
    {
        $videos = Video::where('status', 'pending')->get();
        return view('adminview.encode', compact('videos'));
        
    }

    public function encodevideo(Request $request)
    {
        $video = Video::find($request->id);
    
        if (!$video) {
            return redirect()->back()->with('error', 'Video not found.');
        }
    
        $originalPath = public_path($video->video);
        $filename = pathinfo($originalPath, PATHINFO_FILENAME);
        $outputDir = public_path("uploads/encoded/{$filename}");
    
        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0777, true);
        }
    
        // Get the original resolution height
        $originalResolution = (int) filter_var($video->resolution, FILTER_SANITIZE_NUMBER_INT);
    
        // Define resolution profiles
        $resolutions = [
            '240p' => ['width' => 426,  'height' => 240,  'bandwidth' => 400000],
            '360p' => ['width' => 640,  'height' => 360,  'bandwidth' => 800000],
            '480p' => ['width' => 854,  'height' => 480,  'bandwidth' => 1200000],
            '720p' => ['width' => 1280, 'height' => 720,  'bandwidth' => 2500000],
            '1080p' => ['width' => 1920,'height' => 1080, 'bandwidth' => 5000000],
        ];
    
        $playlistEntries = "";
    
        foreach ($resolutions as $label => $data) {
            if ($originalResolution < $data['height']) {
                continue; // Skip encoding higher than original
            }
    
            $width = $data['width'];
            $height = $data['height'];
            $bandwidth = $data['bandwidth'];
    
            $outputSubdir = "{$outputDir}/{$label}";
            if (!file_exists($outputSubdir)) {
                mkdir($outputSubdir, 0777, true);
            }
    
            $hlsPath = "{$outputSubdir}/index.m3u8";
            $segmentPath = "{$outputSubdir}/%03d.ts";
    
            $cmd = "ffmpeg -i \"{$originalPath}\" -vf \"scale=w={$width}:h={$height}:force_original_aspect_ratio=decrease,pad={$width}:{$height}:(ow-iw)/2:(oh-ih)/2\" -c:a aac -ar 48000 -b:a 128k -c:v h264 -profile:v baseline -b:v {$bandwidth} -maxrate {$bandwidth} -bufsize " . ($bandwidth * 2) . " -hls_time 10 -hls_playlist_type vod -hls_segment_filename \"{$segmentPath}\" -f hls \"{$hlsPath}\"";
    
            shell_exec($cmd);
    
            $relativePath = "{$label}/index.m3u8";
            $playlistEntries .= "#EXT-X-STREAM-INF:BANDWIDTH={$bandwidth},RESOLUTION={$width}x{$height}\n{$relativePath}\n";
        }
     

        $video->status = 'encoded';
        $video->save(); // don't forget to save it to database
        
        // Save master playlist
        $masterPlaylist = "#EXTM3U\n{$playlistEntries}";
        file_put_contents("{$outputDir}/master.m3u8", $masterPlaylist);
    
        return redirect()->back()->with('success', 'Video encoded successfully.');
    }
    
 

    public function audit()
{
    $audits = Audit::with('user')->latest()->get(); // eager load user info
    return view('adminview.audit', compact('audits'));
}
   

public function showCreatorVideos()
{
    $videos = \App\Models\Video::with(['uploader', 'likes'])
                ->whereHas('uploader', function ($query) {
                    $query->where('usertype', 'creator');
                })
                ->orderBy('created_at', 'desc')
                ->get();

    return view('adminview.videos', compact('videos'));
}

}
