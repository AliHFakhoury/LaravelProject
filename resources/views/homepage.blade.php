<html>
    <head>
        <style>
            #videoList > div {
                margin-bottom: 3%;
            }
        </style>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#searchForm').on('submit', function(e) {
                    e.preventDefault();
                    searchVideos();
                    
                });
            });

            function searchVideos(){
                const videoTitle = document.getElementById('videoTitle').value;
                    const dataToSend = {
                        "videoTitle":videoTitle
                    };
                    console.log('Form submitted!');

                    $.ajax({
                        url: 'http://localhost:8000/api/youtubeAPI/search',
                        type: 'GET',
                        data: dataToSend,
                        success: function(response) {
                            loadVideosOnPage(response);
                        },
                        error: function(error) {
                            console.error('Error:', error);
                        }
                });
            }

            function loadVideosOnPage(response){
                const videoListDiv = document.getElementById('videoList');
                const videos = response.items;
                
                const h2 = document.createElement('h2');
                h2.textContent = "Videos Loaded";

                videoListDiv.appendChild(h2);

                videos.forEach(video => {
                    const div = document.createElement('div');
                    
                    const h3 = document.createElement('h3');
                    h3.textContent = video.snippet.channelTitle;

                    const p = document.createElement('p');
                    p.textContent = video.snippet.title;
                    
                    const link = document.createElement('a');
                    
                    link.href = 'https://www.youtube.com/watch?v='+video.id.videoId;
                    link.textContent = 'Check out on YouTube!';
                    link.target = '_blank';

                    div.appendChild(h3);
                    div.appendChild(p);
                    div.appendChild(link);

                    videoListDiv.appendChild(div);
                    console.log(video);
                });
            }


        </script>
    </head>
    <body>
        <h2>Homepage</h2>

        @auth
            <h3>You are logged in!</h3>

            <h3>Search YouTube</h3>
            
            <form id="searchForm">
                <input id="videoTitle" type="text" placeholder="Video Title"></input>
                <button>Search</button>
            </form>

            <br>
            <br>
            
            <div id="videoList">

            </div>


            
            <form action="/logout" method="POST">
                @csrf
                <button>Logout</button>
            </form>

            
        @else
            <h3>
                Please <a href="/login"> login </a>.
            </h3>
        @endauth
    </body>
</html>