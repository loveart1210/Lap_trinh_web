<?php if (empty($errors) && $_SERVER['REQUEST_METHOD'] === 'POST'): ?>
    <div class="display-section">
        <h2>Thông tin đã gửi</h2>
        <p><strong>Tên:</strong> <?php echo htmlspecialchars($firstName . ' ' . $lastName); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        <p><strong>Mã hóa đơn:</strong> <?php echo htmlspecialchars($invoice); ?></p>
        <p><strong>Thanh toán cho:</strong> <?php echo htmlspecialchars(implode(', ', $payFor)); ?></p>
        <p><strong>Thông tin bổ sung:</strong> <?php echo nl2br(htmlspecialchars($additional)); ?></p>
        <?php if ($uploadedFile): ?>
            <p><strong>Biên lai đã tải lên:</strong></p>
            <img src="<?php echo $uploadedFile; ?>" alt="Uploaded Receipt">
        <?php endif; ?>
    </div>
<?php endif; ?>