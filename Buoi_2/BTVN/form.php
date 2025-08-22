<h1>Payment Receipt Upload Form</h1>

<form method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label>Họ và Tên đệm</label>
        <div class="name-group">
            <div><input type="text" name="first_name" placeholder="Họ và Tên đệm" value="<?php echo htmlspecialchars($firstName); ?>"></div>
            <div class="name">
            <label>Tên</label>
            <div><input type="text" name="last_name" placeholder="Tên" value="<?php echo htmlspecialchars($lastName); ?>"></div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="name-group">
            <div>
                <label>Email</label>
                <input type="email" name="email" placeholder="example@example.com" value="<?php echo htmlspecialchars($email); ?>">
            </div>
            <div>
                <label>Mã hóa đơn</label>
                <input type="text" name="invoice" value="<?php echo htmlspecialchars($invoice); ?>">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Thanh toán cho</label>
        <div class="pay-for">
            <div>
                <input type="checkbox" name="pay_for[]" value="15K Category" <?php echo in_array('15K Category', $payFor) ? 'checked' : ''; ?>> 15K Category<br>
                <input type="checkbox" name="pay_for[]" value="35K Category" <?php echo in_array('35K Category', $payFor) ? 'checked' : ''; ?>> 35K Category<br>
                <input type="checkbox" name="pay_for[]" value="55K Category" <?php echo in_array('55K Category', $payFor) ? 'checked' : ''; ?>> 55K Category<br>
                <input type="checkbox" name="pay_for[]" value="75K Category" <?php echo in_array('75K Category', $payFor) ? 'checked' : ''; ?>> 75K Category<br>
                <input type="checkbox" name="pay_for[]" value="116K Category" <?php echo in_array('116K Category', $payFor) ? 'checked' : ''; ?>> 116K Category<br>
                <input type="checkbox" name="pay_for[]" value="Shuttle One Way" <?php echo in_array('Shuttle One Way', $payFor) ? 'checked' : ''; ?>> Shuttle One Way<br>
            </div>
            <div>
                <input type="checkbox" name="pay_for[]" value="Shuttle Two Ways" <?php echo in_array('Shuttle Two Ways', $payFor) ? 'checked' : ''; ?>> Shuttle Two Ways<br>
                <input type="checkbox" name="pay_for[]" value="Training Cap Merchandise" <?php echo in_array('Training Cap Merchandise', $payFor) ? 'checked' : ''; ?>> Training Cap Merchandise<br>
                <input type="checkbox" name="pay_for[]" value="Compressport T-Shirt Merchandise" <?php echo in_array('Compressport T-Shirt Merchandise', $payFor) ? 'checked' : ''; ?>> Compressport T-Shirt Merchandise<br>
                <input type="checkbox" name="pay_for[]" value="Buf Merchandise" <?php echo in_array('Buf Merchandise', $payFor) ? 'checked' : ''; ?>> Buf Merchandise<br>
                <input type="checkbox" name="pay_for[]" value="Other" <?php echo in_array('Other', $payFor) ? 'checked' : ''; ?>> Other<br>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Vui lòng tải lên biên lai thanh toán.</label>
        <div class="upload-area">
            <input type="file" name="receipt" accept=".png,.jpg,.jpeg,.gif">
            <p>Kéo và thả file vào đây hoặc duyệt file. (.jpg, .jpeg, .png, .gif)</p>
        </div>
    </div>

    <div class="form-group">
        <label>Thông tin bổ sung</label>
        <textarea name="additional" rows="5"><?php echo htmlspecialchars($additional); ?></textarea>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <ul><?php foreach ($errors as $error): ?><li><?php echo $error; ?></li><?php endforeach; ?></ul>
        </div>
    <?php endif; ?>

    <button type="submit">Gửi</button>
</form>