
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/technician/technician-add-new-post.css">
    <title>Technician Community</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add New Post</title>
</head>

<body>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add New Post</h5>
            <span class="btn-close" onclick="closeModal()">&times;</span>
        </div>
        <div class="modal-body">
            <img src="img/post.jpg" class="post-image">
            <form method="POST" action="submit_post.php" enctype="multipart/form-data">
                <div class="my-3">
                    <input class="form-control" type="file" name="postImage" id="formFile">
                </div>
                <div class="mb-3">
                    <label for="postText" class="form-label">Say Something</label>
                    <textarea class="form-control" id="postText" name="postText" rows="1"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Post</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="script.js"></script>
</body>

</html>


</body>
</html>