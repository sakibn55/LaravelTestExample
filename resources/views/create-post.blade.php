<form action="/store-post" method="post">
    @csrf
    <input type="text" name="title">
    <input type="text" name="body">
    <button type="submit">Save Post</button>
</form>
