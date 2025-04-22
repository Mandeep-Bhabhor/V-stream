<x-admin.layout>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Encode</title>
    </head>
    <body>
       <div class = "container mt-5">
         <h1 class = "text-center mb-4"> All Videos</h1>
            <div class ="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach ($videos as  $video)
                <div class="col">
                    <div class="row">
                      Column
                    </div>
                    <div class="row">
                      Column
                    </div>
                    <div class="row">
                      Column
                    </div>
                  </div>
                
                    
                @endforeach
    </body>
    </html>
</x-admin.layout>