<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 获取表单数据
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    
    // 创建时间戳
    $timestamp = date('Y-m-d H:i:s');
    
    // 构造日志内容
    $logData = "注册时间：{$timestamp}\n姓名：{$name}\n邮箱：{$email}\n\n";
    
    // 写入日志文件（追加模式）
    $logPath = __DIR__ . '/日志.txt';
    
    try {
        if (file_put_contents($logPath, $logData, FILE_APPEND | LOCK_EX)) {
            // 跳转到成功页面
            header('Location: 新建文件夹/ok.html');
            exit();
        }
    } catch (Exception $e) {
        http_response_code(500);
        die("文件写入失败：" . $e->getMessage());
    }
}
?>