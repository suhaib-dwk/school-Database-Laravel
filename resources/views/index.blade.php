<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">path</th>

            </tr>
        </thead>
        <tbody>
            @foreach($images as $image)
            <tr>
                <th scope="row">{{$image->id}}</th>
                <td><img src="{{asset('storage/'.$image->path)}}" width="70px" height="70px" /></td>

            </tr>
            @endforeach
        </tbody>
    </table>

</body>


</html>
