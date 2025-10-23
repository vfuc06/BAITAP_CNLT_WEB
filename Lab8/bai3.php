<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Gửi Mass Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #74b9ff, #a29bfe);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .card {
            width: 520px;
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            background: #fff;
        }
        .card-header {
            background: #0984e3;
            color: white;
            font-size: 1.4rem;
            font-weight: 600;
            text-align: center;
            border-radius: 15px 15px 0 0;
            letter-spacing: 0.5px;
        }
        .btn-primary {
            background: #0984e3;
            border: none;
        }
        .btn-primary:hover {
            background: #74b9ff;
        }
        label {
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-header">
         Gửi Email Hàng Loạt
    </div>
    <div class="card-body p-4">
        <form action="mail3.php" enctype="multipart/form-data" method="POST">
            <div class="mb-3">
                <label for="tieude" class="form-label">Tiêu đề Email</label>
                <input type="text" class="form-control" name="tieude" placeholder="Nhập tiêu đề email" required>
            </div>

            <div class="mb-3">
                <l for="editor" class="form-label">Nội dung Email</l    abel>
                <textarea name="content" id="editor" class="form-control" rows="6"></textarea>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Tệp đính kèm (nếu có)</label>
                <input type="file" class="form-control" name="file">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary px-4 py-2">📨 Gửi Email Hàng Loạt</button>
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
