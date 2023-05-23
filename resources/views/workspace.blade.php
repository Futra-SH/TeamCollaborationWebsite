<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bootstrap 5 Side Bar Navigation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"/>
    <style>
        li{
            list-style: none;
            margin: 20px 0 20px 0;
        }
    
        a{
            text-decoration: none;
        }
    
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            margin-left: -300px;
            transition: 0.4s;
        }
    
        .active-main-content {
            margin-left: 250px;
        }
    
        .active-sidebar {
            margin-left: 0;
        }
    
        #main-content {
            transition: 0.4s;
        }
    </style>
</head>
<body>
    <div>
        @include('templates.sidebar')
        </div>
        <div class="p-4" id="main-content">
            <button class="btn btn-primary" id="button-toggle">
                <i class="bi bi-list"></i>
            </button>
            <div class="card mt-5">
            <div class="card-body">
                <h5><i class="bi bi-plus-square"> </i> Add new Workspace</h5>
            </div>
        </div>

        <script>
            document.getElementById("button-toggle").addEventListener("click", () => {
                document.getElementById("sidebar").classList.toggle("active-sidebar");
                document.getElementById("main-content").classList.toggle("active-main-content");
            });
        </script>
    </body>
</html>