<form action="{{ route('photo.save') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="photo">
    <button type="submit">Upload Photo</button>
</form>