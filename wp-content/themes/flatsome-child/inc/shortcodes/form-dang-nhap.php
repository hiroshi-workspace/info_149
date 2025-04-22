<?php
// Thêm shortcode để hiển thị form đăng nhập
function custom_login_form_unique() {
    ob_start();
    custom_login_function_unique();
    return ob_get_clean();
}
add_shortcode('custom_login', 'custom_login_form_unique');

// Hiển thị form đăng nhập
function custom_login_function_unique() {
    $errors = new WP_Error();

    // Kiểm tra nếu người dùng đã đăng nhập
    if (is_user_logged_in()) {
        echo '<script>window.location.href = "' . home_url() . '";</script>';
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['loginBtn'])) {
        // Xử lý đăng nhập
        $username = sanitize_user($_POST['username']);
        $password = $_POST['password'];
        $remember = isset($_POST['remember']) ? true : false;

        // Kiểm tra các trường bắt buộc
        if (empty($username)) {
            $errors->add('empty_username', 'Vui lòng nhập tên đăng nhập hoặc email');
        }
        if (empty($password)) {
            $errors->add('empty_password', 'Vui lòng nhập mật khẩu');
        }

        // Nếu không có lỗi, thực hiện đăng nhập
        if ($errors->get_error_codes() === array()) {
            // Kiểm tra xem username là email hay username
            $user = (is_email($username)) ? get_user_by('email', $username) : get_user_by('login', $username);

            if ($user) {
                $credentials = array(
                    'user_login' => $user->user_login,
                    'user_password' => $password,
                    'remember' => $remember
                );

                $user_verify = wp_signon($credentials);

                if (!is_wp_error($user_verify)) {
                    wp_set_current_user($user_verify->ID);
                    wp_set_auth_cookie($user_verify->ID, $remember);
                    
                    // Sử dụng JavaScript để hiển thị toast và chuyển hướng
                    ?>
                    <script>
                        // Hiển thị toast message
                        showToast('Đăng nhập thành công!', 'success');
                        // Chuyển hướng sau 2 giây
                        setTimeout(function() {
                            window.location.href = '<?php echo home_url(); ?>';
                        }, 2000);
                    </script>
                    <?php
                    exit;
                } else {
                    $errors->add('invalid_credentials', 'Tên đăng nhập hoặc mật khẩu không đúng');
                }
            } else {
                $errors->add('invalid_credentials', 'Tên đăng nhập hoặc mật khẩu không đúng');
            }
        }
    }

    // Hiển thị form
    ?>
    <!-- Toast container -->
    <div id="toast-container"></div>

    <section class="container m-auto mt-80 dk container-login">
        <?php
        // Hiển thị thông báo lỗi
        if ($errors->get_error_codes()) {
            echo '<div class="login-errors">';
            foreach ($errors->get_error_messages() as $error) {
                echo '<div class="error-message">' . esc_html($error) . '</div>';
            }
            echo '</div>';
        }
        ?>

        <div class="txt-center">
            <p class="uppercase almendra em3 pt-80 mb-15">đăng nhập</p>
        </div>

        <form method="post" id="loginForm" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>">
            <?php wp_nonce_field('custom_login_nonce'); ?>
            <div class="d-flex login-form justify-center">
                <div class="w-50">
                    <div class="input-container d-flex justify-center align-center mt-30">
                        <div class="gradient-border border-width-2 p-5 d-inline-block">
                            <input class="gradient-border border-width-1 p-15 w-300" type="text" name="username" id="usernameInput" placeholder="Tên đăng nhập hoặc Email" value="<?php echo isset($_POST['username']) ? esc_attr($_POST['username']) : ''; ?>" required>
                        </div>
                    </div>
                    <div class="input-container d-flex justify-center align-center mt-30">
                        <div class="gradient-border border-width-2 p-5 d-inline-block">
                            <input class="gradient-border border-width-1 p-15 w-300" type="password" name="password" id="passwordInput" placeholder="Mật khẩu" required>
                        </div>
                    </div>
                    <div class="input-container d-flex justify-center align-center mt-20">
                        <label class="remember-me">
                            <input type="checkbox" name="remember" id="rememberInput">
                            Ghi nhớ đăng nhập
                        </label>
                    </div>
                    <div class="input-container d-flex justify-center align-center mt-20">
                        <a href="<?php echo wp_lostpassword_url(); ?>" class="forgot-password">
                            Quên mật khẩu?
                        </a>
                    </div>
                </div>
            </div>
            <div class="input-container d-flex justify-center align-center mt-50 p0-30">
                <div class="gradient-border border-width-2 p-5 d-inline-block">
                    <button type="submit" class="gradient-bg p-15 w-400 almendra uppercase em1-3 d-table-cell txt-center black" id="loginBtn" name="loginBtn">
                        đăng nhập
                    </button>
                </div>
            </div>
        </form>
    </section>

    <style>
    .login-errors {
        max-width: 300px;
        margin: 0 auto;
        padding: 10px;
        background-color: #ffebee;
        border: 1px solid #ef5350;
        border-radius: 4px;
        margin-bottom: 20px;
    }
    
    .error-message {
        color: #c62828;
        text-align: center;
        margin: 5px 0;
    }

    /* Toast styles */
    #toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
    }

    .toast {
        padding: 15px 25px;
        margin-bottom: 10px;
        border-radius: 4px;
        color: white;
        font-weight: bold;
        opacity: 0;
        transition: opacity 0.3s ease-in;
    }

    .toast.success {
        background-color: #4caf50;
    }

    .toast.error {
        background-color: #f44336;
    }

    .toast.show {
        opacity: 1;
    }
    </style>

    <script>
    function showToast(message, type = 'success') {
        const toastContainer = document.getElementById('toast-container');
        
        // Tạo toast element
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.textContent = message;
        
        // Thêm toast vào container
        toastContainer.appendChild(toast);
        
        // Hiển thị toast
        setTimeout(() => {
            toast.classList.add('show');
        }, 100);
        
        // Xóa toast sau 2 giây
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => {
                toastContainer.removeChild(toast);
            }, 300);
        }, 2000);
    }
    </script>
    <?php
}

// Xử lý logout
add_action('wp_logout', function() {
    wp_redirect(home_url('/dang-nhap'));
    exit;
});