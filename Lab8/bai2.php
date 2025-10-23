<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Gửi Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #558dc4ff, #a29bfe);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            width: 500px;
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            background: #fff;
        }
        .card-header {
            background: #487aa0ff;
            color: white;
            font-size: 1.3rem;
            font-weight: 600;
            text-align: center;
            border-radius: 15px 15px 0 0;
        }
        .btn-primary {
            background: #79a7caff;
            border: none;
        }
        .btn-primary:hover {
            background: #5784b1ff;
        }
        label {
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-header">
        ✉️ Gửi Email
    </div>
    <div class="card-body p-4">
        <form action="mail2.php" enctype="multipart/form-data" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Địa chỉ Email</label>
                <input type="email" class="form-control" name="email" placeholder="Nhập email người nhận" required>
            </div>

            <div class="mb-3">
                <label for="tieude" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control" name="tieude" placeholder="Nhập tiêu đề email" required>
            </div>

            <div class="mb-3">
                <label for="editor" class="form-label">Nội dung</label>
                <textarea name="content" id="editor" class="form-control" rows="6"></textarea>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Tệp đính kèm (nếu có)</label>
                <input type="file" class="form-control" name="file">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary px-4 py-2">📨 Gửi Email</button>
            </div>
        </form>
    </div>
</div>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            console.log('CKEditor đã khởi tạo!');
        })
        .catch(error => {
            console.error(error);
        });
</script>

</body>
</html>
