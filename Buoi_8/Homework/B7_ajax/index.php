<!DOCTYPE html>
<html>
<head>
    <title>Ajax Demo</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#load-data-button").click(function() {
                $.ajax({
                    url: "getData.php", // Tên tập tin PHP xử lý dữ liệu
                    type: "GET",
                    dataType: "text",
                    success: function(response) {
                        $("#result").html(response); // Cập nhật div với dữ liệu từ máy chủ
                    },
                    error: function() {
                        alert("Đã xảy ra lỗi trong quá trình tải dữ liệu.");
                    }
                });
            });
        });
    </script>
</head>
<body>
    <button id="load-data-button">Tải dữ liệu</button>
    <div id="result">Kết quả sẽ xuất hiện ở đây</div>
</body>
</html>