<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CreatorController extends Controller
{
    //
    public function creatordash()
    {
        return view('creatorview.dashboard');
    }

    public function upload()
    {
        return view('creatorview.upload');
    }

    public function uploadvideo(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'video' => 'required|file|mimes:mp4,mov,avi,wmv|max:51200', // Max 50MB
        ]);
    
        // Upload video
        $path = 'uploads/video/';
        $filename = time() . '.' . $request->file('video')->getClientOriginalExtension();
        $request->file('video')->move(public_path($path), $filename);
    
        $videoPath = public_path($path . $filename);
        
    
        // Get resolution and duration
        $details = $this->getVideoResolutionAndDuration($videoPath);
    
        // Check if details are valid
        if (!$details) {
            // Delete invalid uploaded file
            unlink($videoPath);
            return back()->withErrors(['video' => 'Could not determine video resolution or duration.'])->withInput();
        }
    
        // Example conditions
        if ($details['height'] < 240) {
            unlink($videoPath);
            return back()->withErrors(['video' => 'Video resolution must be at least 240p.'])->withInput();
        }
        
       
        echo $details['label'];
       Video::create([
            'title' => $validated['title'],
            'video'=> $path ? $path . $filename : null,
            'resolution' => $details['label'],
            'uploader_id' => Auth::id(), // Assuming the user is logged in
            'description' => $validated['description'],
            'duration' => $details['duration'],
        ]);
    
        // All good, save or process further...
        return redirect()->back()->with('success', 'Video uploaded successfully!');
    }
    
    
   
    

    private function getVideoResolutionAndDuration($videoPath)
{
  //  $ffprobePath = 'C:/Users/mande/ffmpeg-2025-04-14-git-3b2a9410ef-full_build/ffmpeg-2025-04-14-git-3b2a9410ef-full_build/bin/ffprobe.exe'; // Full path to ffprobe
  $ffprobePath = 'C:/Users/Student/ffmpeg-2025-04-14-git-3b2a9410ef-full_build/bin/ffprobe.exe'; // Full path to ffprobe
    
    // Command to get both resolution (width, height) and duration
    $command = "$ffprobePath -v error -select_streams v:0 -show_entries stream=width,height,duration -of csv=p=0:s=x " . escapeshellarg($videoPath);
    
    // Debugging the command
    \Log::info('ffprobe command: ' . $command);
    
    // Execute the command
    $output = shell_exec($command);
    
    if ($output) {
        // Split the output into resolution and duration
        list($width, $height, $duration) = explode('x', trim($output));

        // Clean the duration value to remove any extra spaces
        $duration = trim($duration);
        
        // Return resolution and duration as an associative array
        return [
            'width' => (int) $width,
            'height' => (int) $height,
            'label' => "{$height}p",
            'duration' => round($duration, 2) // Rounding the duration to 2 decimal places
        ];
    }

    return null;
}

    public function myvideos()
    {
        $videos = Video::where('uploader_id', Auth::id())->get();
        return view('creatorview.myvideos', compact('videos'));
    }
    
    public function delete($id)
{
    $video = Video::find($id);

    if ($video) {
        $videoPath = public_path($video->video);

        // Delete original video
        if (file_exists($videoPath)) {
            unlink($videoPath);
        }

        // Delete encoded folder
        $filename = pathinfo($videoPath, PATHINFO_FILENAME);
        $encodedFolder = public_path("uploads/encoded/{$filename}");

        if (is_dir($encodedFolder)) {
            foreach (glob($encodedFolder . '/*') as $file) {
                if (is_file($file)) {
                    unlink($file);
                } elseif (is_dir($file)) {
                    foreach (glob($file . '/*') as $subfile) {
                        unlink($subfile);
                    }
                    rmdir($file);
                }
            }
            rmdir($encodedFolder);
        }

        $video->delete();

        return redirect()->back()->with('success', 'Video deleted successfully!');
    }

    return redirect()->back()->with('error', 'Video not found.');
}

    

    
    
}

  